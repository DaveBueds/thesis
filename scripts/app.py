#!/usr/bin/env python3

import sys, os
import pickle
import numpy as np
import pandas as pd

from collections import OrderedDict


weer = sys.argv[1]
banden = sys.argv[2]
typeEvent = sys.argv[3]
toespoor = int(sys.argv[4])
camber = float(sys.argv[5])
bandendruk = float(sys.argv[6])
hoogte = int(sys.argv[7])

if weer == 'Clear':
	weer = 1
else:
	weer = 2

if banden == 'C17 slick':
	banden = 1
else:
	banden = 2

if typeEvent == 'Acceleratie':
	typeEvent = 1
else:
	typeEvent = 2


#print('Type', toespoor)

new_data = OrderedDict([
    ('main', weer),
    ('banden', banden),
    ('typeEvent', typeEvent),
    ('toespoor', toespoor),
    ('camber', camber),
    ('bandendruk', bandendruk),
    ('hoogte', hoogte)]
)
new_data = pd.Series(new_data).values.reshape(1,-1)

path=os.getcwd()+'/scripts/reg_tree.pkl'
pkl_file = open(path, 'rb')
reg_tree = pickle.load(pkl_file)
#prediction = logmodel.predict(cat_vector)
d = reg_tree.predict(new_data)


print(d[0], "s")

