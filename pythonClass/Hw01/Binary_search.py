"""
Procedure Binary_search
Project : Hw1.4
Author : Hae-Yeon-Won
Date of last updte : 2021.09.04
input argument: int dataArray[0..N-1], int target_numger
array of data with N elements
output result: searched data index of the given data array
"""
# function binary_search
def binary_search(dataArray, target_number, start, end):
    while start <= end:
        mid = (start + end) // 2
        if (dataArray[mid] == target_number):
            return mid
        elif (dataArray[mid] > target_number):
            end=mid-1
        else:
            start=mid+1
    return -1 # can't find target_number

#main
result = binary_search (dataArray, target_number, 0, N - 1)
if (result == -1):
    printout ("not in dataArray")
else:
    printout (result)
#end
