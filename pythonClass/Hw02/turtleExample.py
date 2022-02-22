
"""
Project : Hw2.5
-4개 꼭지점의 좌표를 튜플 리스트로 설정한 직사각형을 파이선
터틀 그래픽으로 그리는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.07.
"""
import turtle as t
from time import sleep
coordinates = [(-100, -100), (100, -100), (100, 100), (-100, 100)]
t.penup()
for pos in coordinates:
    x, y=pos[0], pos[1]
    t.goto(x,y)
    t.pendown()
t.goto(coordinates[0][0], coordinates[0][1])
t.done()
