#Copyright (c) 2007–2018 The scikit-learn developers.
#All rights reserved.
#License: BSD 3 clause
"""
 * Author:    David Bueds
 * Created:   2017-2018
 * Subject:   Masterproef 
"""
# Importeren van externe bibliotheken
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import graphviz
import sklearn
import pandas_ml as pdml

get_ipython().run_line_magic('matplotlib', 'inline')

#uitlezen van csv in dataframe mbv pandas, 
#splitsen op ;, gebruik 0e rij als kolomnaam
df = pd.read_csv('data/thesis.csv',sep=';', header=0)

#tonen van het ingeladen dataframe (default 5 rijen)
df.head()

# ### Preprocessing
# Kwalitatieve variabelen omzetten naar numerieke labels.
#1) C17 slick / C17 wet --> 1 / 2
df['banden'][df['banden'] == 'C17 slick'] = 1
df['banden'][df['banden'] == 'C17 wet'] = 2
#4) Acceleratie / SkidPad --> 1 / 2
df['typeEvent'][df['typeEvent'] == 'Acceleratie'] = 1
df['typeEvent'][df['typeEvent'] == 'SkidPad'] = 2
#5) Clear / Rain --> 1 / 2
df['main'][df['main'] == 'Clear'] = 1
df['main'][df['main'] == 'Rain'] = 2

df = df.infer_objects()
df.head(400)


# ### Afhandelen van missende waardes
df = df.dropna()

# ### Normalisatie
df.toespoor_orig = df['toespoor'].copy()
df.hoogte_orig = df['hoogte'].copy()
df.bandendruk_orig = df['bandendruk'].copy()

df['toespoor'] = (df['toespoor'] - df['toespoor'].min())/(df['toespoor'].max() - df['toespoor'].min())
df['hoogte'] = (df['hoogte'] - df['hoogte'].min())/(df['hoogte'].max() - df['hoogte'].min())
df['bandendruk'] = (df['bandendruk'] - df['bandendruk'].min())/(df['bandendruk'].max() - df['bandendruk'].min())

df.head()


# ### Pandas-ML
df_car = pdml.ModelFrame(df.copy(), target='totaalTijd')
df_car['toespoor'] = df.toespoor_orig    ## herstel toespoor
df_car['hoogte'] = df.hoogte_orig    ## herstel toespoor
df_car['bandendruk'] = df.bandendruk_orig    ## herstel toespoor
df_car.head()

#df_car.describe()   #toon alle statistieken van data
df_stats = pd.DataFrame(columns=df_car.columns)
df_stats.loc['aantal'] = df_car.count()
df_stats.loc['gemiddelde'] = df_car.mean()
df_stats.loc['standaarddeviatie'] = df_car.var()
df_stats.loc['minimum'] = df_car.min()
df_stats.loc['maximum'] = df_car.max()
df_stats.loc['1ste kwartiel'] = df_car.quantile(0.25)
df_stats.loc['2de kwartiel'] = df_car.quantile(0.50)
df_stats.loc['3de kwartiel'] = df_car.quantile(0.75)
df_stats.loc['skew'] = df_car.skew()
df_stats.loc['kurtosis'] = df_car.kurtosis()
df_stats


# ### Visualtisatie dataset
#boxplot die spreiding van data weergeeft van alle feature kolommen
fig, ax = plt.subplots(figsize=(10, 7))
sns.boxplot(data=df, ax=ax)

# ### Scatter plot
#Het verband tussen type event, toespoor, weer en totaaltijd
sns.catplot(x="toespoor", y="totaalTijd", hue="typeEvent", col="main",kind="swarm", data=df_car);
#Het verband tussen type event, camber, weer en totaaltijd
sns.catplot(x="camber", y="totaalTijd", hue="typeEvent", col="main",kind="swarm", data=df_car);
#Het verband tussen type event, bandendruk, weer en totaaltijd
sns.catplot(x="bandendruk", y="totaalTijd", hue="typeEvent", col="main",kind="swarm", data=df_car);
#Het verband tussen type event, hoogte, weer en totaaltijd
sns.catplot(x="hoogte", y="totaalTijd", hue="typeEvent", col="main",kind="swarm", data=df_car);

dt = pd.read_csv('data/thesis_tijden.csv',sep=';', header=0)
#dt['main'][dt['main'] == 'Clear'] = 1
#dt['main'][dt['main'] == 'Rain'] = 2

dt_tijden = pdml.ModelFrame(dt.copy(), target='totaalTijd')
#dt_hoogte = dt_tijden.loc[dt_tijden['main'] == 1]
sns.lmplot(x="hoogte", y="hoogteTijd", hue="main",data=dt_tijden)


# ## Machine Learning
# ### Training-validatie splitsing
# create training and testing vars
X = df.drop('totaalTijd', axis=1)
y = df['totaalTijd']  
train_car, test_car = df_car.model_selection.train_test_split(train_size=0.7, test_size=0.3)

from sklearn.model_selection import train_test_split  
X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=0.7, test_size=0.3, random_state=0)  

# ### Regressie boom
#from sklearn import tree
reg_tree = train_car.tree.DecisionTreeRegressor()
train_car.fit(reg_tree)
names = list(df_car.columns.values[:7])
print(names)

# teken boom
from sklearn import tree
with open("boom.dot", "w") as f:
    f=train_car.tree.export_graphviz(reg_tree, out_file=f, feature_names=df_car.columns.values[:7])

tree_fig=train_car.tree.export_graphviz(reg_tree, out_file=None, feature_names=df_car.columns.values[:7])
graph=graphviz.Source(tree_fig)
graph

#from graphviz import Source
#graph = Source( train_car.tree.export_graphviz(reg_tree, out_file=None, feature_names=df_car.columns.values[:7], max_depth=2))
#graph.format = 'png'
#graph.render('boomstructuur',view=True)

#y_pred = reg_tree.predict(test_car[:7])
y_pred = reg_tree.predict(X_test)  

df=pd.DataFrame({'Actual':y_test, 'Predicted':y_pred})  
#df

from sklearn import metrics 
print('Mean Absolute Error:', metrics.mean_absolute_error(y_test, y_pred)*100)  
print('Mean Squared Error:', metrics.mean_squared_error(y_test, y_pred)*100)  
print('Root Mean Squared Error:', np.sqrt(metrics.mean_squared_error(y_test, y_pred))*100)
#beste score is 100
print('R2 score: ', metrics.r2_score(y_test, y_pred)*100)
print('Explained Variance Score:', metrics.explained_variance_score(y_test, y_pred)*100)


fig, ax = plt.subplots()
ax.scatter(y_test, y_pred)
ax.plot(y_test, y_test, color='red')
ax.set_xlabel('Actual test target values')
ax.set_ylabel('Predicted target values')


# ### Maken van voorspellingen
from collections import OrderedDict
new_data = OrderedDict([
    ('main', 2.0),
    ('banden', 2.0),
    ('typeEvent', 2.0),
    ('toespoor', 1004.0),
    ('camber', -0.80),
    ('bandendruk', 0.70),
    ('hoogte', 28.0)]
)
new_data = pd.Series(new_data).values.reshape(1,-1)
d = reg_tree.predict(new_data)
print('Voor de gegeven input features is de voorspelde tijd: ', d[0])

bestpred = 100.0
besttoe = 100.0
bestcamber = 100.0
bestbanden = 100.0
besthoogte = 100.0

hoogteMin = 20
hoogteMax = 40
toeMin = 995
toeMax = 1005

camberArray = [0.0, -0.1, -0.2, -0.3, -0.4, -0.5, -0.6, -0.7, -0.8, -0.9, -1.0]
bandenArray = [0.6, 0.7, 0.8]

#mainInput
#soortbandenInput
#typeEventInput
toeInput = 0
camberInput = 0
bandendrukInput = 0
hoogteInput = 0

def rangebuilder(ingevuld, rangemin, rangemax):
    if ingevuld != 0:
        var = range(ingevuld, ingevuld+1, 1)
    else:
        var = range(rangemin,rangemax+1, 1) 
    return var

def rangearray(ingevuld, array):
    if ingevuld != 0: #als waarde is ingevuld
        var = [ingevuld]
    else:
        var = array #anders is var gelijk aan standaar array
    return var
        
for toe in rangebuilder(toeInput, toeMin, toeMax):
    for camber in rangearray(camberInput, camberArray):
        for bandendruk in rangearray(bandendrukInput, bandenArray):
            for hoogte in rangebuilder(hoogteInput, hoogteMin, hoogteMax):
    
                new_data = OrderedDict([
                ('main', 2.0),
                ('banden', 2.0),
                ('typeEvent', 2.0),
                ('toespoor', toe),
                ('camber', camber),
                ('bandendruk', bandendruk),
                ('hoogte', hoogte)])
                new_data = pd.Series(new_data).values.reshape(1,-1)
                d = reg_tree.predict(new_data)
                if bestpred >= d:
                    bestpred = d
                    besttoe = toe
                    bestcamber = camber
                    bestbanden = bandendruk
                    besthoogte = hoogte
                    
                else:
                    pass
                
print('Voor de gegeven input features is de beste tijd: ', bestpred[0], besttoe, bestcamber, bestbanden, besthoogte)


# ### Model opslaan met Pickle
import pickle

with open('reg_tree.pkl', 'wb') as fid:
    pickle.dump(reg_tree, fid,2)
    
cat = df_car.drop('totaalTijd',axis=1)
index_dict = dict(zip(cat.columns,range(cat.shape[1])))

#Save the index_dict into disk
with open('cat', 'wb') as fid:
    pickle.dump(index_dict, fid,2)


# ### Support Vector Regressor

# In[22]:


from sklearn import svm
reg_svm = train_car.svm.SVR()
train_car.fit(reg_svm)


# ### Multilayer perceptron
from sklearn.neural_network import MLPRegressor
reg_mlp = MLPRegressor(hidden_layer_sizes=(20,15,10,5), solver="lbfgs", max_iter=20000)
train_car.fit(reg_mlp)

aantal_weights = 0
for i in range (0,len(reg_mlp.coefs_)):
    aantal_weights += len(reg_mlp.coefs_[i])
    print("layer",i,"heeft",len(reg_mlp.coefs_[i]),"weights")
print("totaal aantal weights",aantal_weights)

# ### Cross validatie
# ShuffleSplit
from sklearn.model_selection import ShuffleSplit
cv = train_car.model_selection.ShuffleSplit(n_splits=10, test_size=0.3)

# cross validation score
#data.values
from sklearn.model_selection import cross_val_score
tree_score = train_car.model_selection.cross_val_score(reg_tree,cv=cv)
svm_score = train_car.model_selection.cross_val_score(reg_svm,cv=cv)
mlp_score = train_car.model_selection.cross_val_score(reg_mlp,cv=cv)

print("gem. tree_score",sum(tree_score)/len(tree_score)*100)
print("gem. svm_score",sum(svm_score)/len(svm_score)*100)
print("gem. mlp_score",sum(mlp_score)/len(mlp_score)*100)

