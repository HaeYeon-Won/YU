"""
Project : Hw2.1
-0 ~ 255의 값을 10진수, 16진수, 8진수, 2진수로 각각 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.07.
"""
for num in range(256): print("{:5} = {:5} = {:5} = {:5}".format(num, hex(num), oct(num), bin(num)))
