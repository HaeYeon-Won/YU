"""
Project : Hw3.3
-튜플 (year, month, day)로 표현되는 날짜 (date)을 표준 입력장치로 부터
10개 입력하여 날짜 튜플 리스트 (list of date-tuples)에 포함시킨 후, 이 날짜
들을 오름차순으로 정렬하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.19.
"""
from random import *
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

count=0
DAYS=[]
while count!=10:
year=randint(1, 2021)

month=randint(1,12)
day=randint(1,31)
if isVildDay(year, month, day):
DAYS.append((year, month, day))
count+=1

DAYS=sorted(DAYS, key=lambda x:(x[0], x[1], x[2]))
print(DAYS)
