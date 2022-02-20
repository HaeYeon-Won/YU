"""
Project : Hw2.3
-표준입력장치 (키보드)로부터 원의 반지름(radius)을 입력 받고,
그 원의 넓이(area)와 원둘레(circumference)를 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.07.
"""
import math
while True:
    radius=float(input("radius of a circle (in float, -1 to quit) = "))
    if radius==-1:
        break
    print("Circle of radius({}) : area ({:.2f}), circumference({:.2f})".format(radius, math.pi*radius*radius, 2*math.pi*radius))
