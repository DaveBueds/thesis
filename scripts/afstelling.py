#!/usr/bin/env python3

import sys, os
import pickle
import numpy as np
import pandas as pd

from collections import OrderedDict

mainInput = sys.argv[1]
soortbandenInput = sys.argv[2]
typeEventInput = sys.argv[3]
toeInput = int(sys.argv[4])
camberInput = float(sys.argv[5])
bandendrukInput = float(sys.argv[6])
hoogteInput = int(sys.argv[7])

if mainInput == 'Clear':
	mainInput = 1
else:
	mainInput = 2

if soortbandenInput == 'C17 slick':
	soortbandenInput = 1
else:
	soortbandenInput = 2

if typeEventInput == 'Acceleratie':
	typeEventInput = 1
else:
	typeEventInput = 2


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
        

path=os.getcwd()+'/scripts/reg_tree.pkl'
pkl_file = open(path, 'rb')
reg_tree = pickle.load(pkl_file)

for toe in rangebuilder(toeInput, toeMin, toeMax):
    #print(toe)
    for camber in rangearray(camberInput, camberArray):
        #print("  ", camber)
        for bandendruk in rangearray(bandendrukInput, bandenArray):
            #print("      ", bandendruk)    
            for hoogte in rangebuilder(hoogteInput, hoogteMin, hoogteMax):
                #print("             ", hoogte)
    
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
         
print(bestpred[0], "s", besttoe, bestcamber, bestbanden, besthoogte, "")
