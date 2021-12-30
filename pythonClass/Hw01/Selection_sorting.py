""“
Procedure Selection_sorting
Project : Hw1.3
Author : Hae-Yeon-Won
Date of last update : 2021.09.04.
input argument: int dataArray[0..N-1]
array of data with N elements
output result: sorted list of the given data array
"""
dataArray=[9,8,7,6,5,4,3,2,1]
for i in range(N):   
    min_index = i
    min_data = dataArray[i]
    for j in range(i+1, N):
      if (min_data > dataArray[j]):
         min_data = dataArray[j]
         min_index = j
    if min_index != i:
      temp = dataArray[i]
      dataArray[i] = dataArray[min_index]
      dataArray[min_index] = temp
#end for
printout dataArray
#end
