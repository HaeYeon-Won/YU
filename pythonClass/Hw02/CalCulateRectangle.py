"""
Project : Hw2.4
-직육면체의 가로 (width), 세로 (height), 높이(height)를 정수 자
료형으로 입력 받아, 표면적 (surface area)과 체적/부피 (volume)
를 계산하여 출력하는 프로그램
Author : Hae-Yeon-Won
Date of last update : 2021.09.07.
"""
w, l, h = map(int, input("width, length, height (in int) = ").split())
print("Hexahedron of width({:.3f}), length({:.3f}, and height({:.3f})".format(w,l,h))
print("surface area ({:.3f}), volume({:.3f})".format(((2*w*l)+(2*w*h)+(2*l*h)), w*l*h))
