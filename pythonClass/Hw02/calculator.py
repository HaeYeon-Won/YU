"""
Project : Hw2.2
-2개의 정수형 데이터 a와 b를 입력받아 a+b, a-b, a*b, a/b, a//b,
a%b를 각각 계산하여 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.07.
"""
a, b=map(int,input("input two integers : ").split())
print("{} + {} = {}" .format(a, b, a+b))
print("{} - {} = {}" .format(a, b, a-b))
print("{} * {} = {}" .format(a, b, a*b))
print("{} / {} = {:.2f}" .format(a, b, a/b))
print("{} // {} = {}" .format(a, b, a//b))
print("{} % {} = {}" .format(a, b, a%b))

