"""
Project : Hw3.1
-날짜를 나타내는 연(year), 월(month), 일(day)의 3개 정수를 입력 받고, 이
날이 서기 1년 1월 1일부터 몇 번째 날짜인지를 계산하며, 이 날이 무슨 요
일인지 계산하여 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.19.
"""

def is_Leap_Year(y):
    if ((y % 4 == 0) and (y % 100 != 0)) or (y % 400 == 0):
        return True
    else:
        return False
def isVildDay(y,m,d):
    dayOfMonth=[0,31,28,31,30,31,30,31,31,30,31,30,31]
    if is_Leap_Year(y):
        dayOfMonth[2]=29
    if y>0 and m>0 and m<13 and d>0 and d<=dayOfMonth[m]:
        return True
    else:
        return False
def elapse(y,m,d):
    elps=0
    dayOfMonth=[0,31,28,31,30,31,30,31,31,30,31,30,31]
    if is_Leap_Year(y):
        dayOfMonth[2]=29
    for i in range(1, y):
        if is_Leap_Year(i):
            elps+=366
        else:
            elps+=365
   
    for j in range(1, m):
        elps+=dayOfMonth[j]
  
    elps+=d
 
    return elps

weekDay=['SUN', 'MON', 'TUE', "WED", 'THR', "FRI", "SAT"]

while True:
    year, month, day=map(int, input("input year, month, day = ").split())
    if isVildDay(year, month, day):
        e=elapse(year, month, day)
        wDay=weekDay[e%7]
        print("Elapsed {} days from Jan01AD01, week day = {}".format(e, wDay))
    else:
        print("input wrong Date!!!")
        break
