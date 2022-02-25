"""
Project : Hw3.2
-시간을 나타내는 시(hour), 분(minute), 초(second)의 3개 정수를 입력 받고,
오늘 자정 (24:00:00) 까지 몇 초가 남았는지 계산하여 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.19.
"""

def isVildTime(h,m,s):
  if h>-1 and h<24 and m>-1 and m<60 and s>-1 and s<60:
    return True
  else:
    return False

while True:
  hour, min, sec = map(int, input("input hour min second : ").split())
  if isVildTime(hour, min, sec):
    print("Elapse second from last midnight = ", hour*3600+min*60+sec)
    print("Elapse second from next midnight = ", (24*3600)-(hour*3600+min*60+sec))
  else:
    print("input wrong Time!")
  break
