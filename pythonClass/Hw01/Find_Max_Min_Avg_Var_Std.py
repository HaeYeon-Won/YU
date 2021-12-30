"""
Project : Hw1.2
Procedure Find_Max_Min_Avg_Var_Std
Author : Hae-Yeon-Won
Date of last update : 2021.09.04.
input args : int dataArray[0..9];
array of data with N(=10) elements
output result: the maximum, minimum, average values, variance and standard deviation
"""
import math
int index = 0; # define and initialize index
int max, min
sum = 0.0
avg = 0.0
var = 0.0
std = 0.0
dev = 0.0
dev_sum = 0.0
max = dataArray[index]
min = dataArray[index]
while (index < N)
    if (dataArray[index] > max)
       max = dataArray[index]
    if (dataArray[index] < min)
       min = dataArray[index]
    sum = sum + dataArray[index]
    index = index + 1
# end while
avg = sum / N
index = 0
while (index < N) 
    dev = avg – dataArray[index]
    dev_sum += dev * dev
    index = index + 1
# end while
var = dev_sum / N
std = math.sqrt (var)
printout max, min, avg, var, std
#end
