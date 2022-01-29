"""
정렬되어있는 두 배열 A와 B가 주어진다. 두 배열을 합친 다음 정렬해서 출력하는 프로그램을 작성하시오.
"""
from sys import stdin, stdout
n,m=map(int,stdin.readline().split())
A=list(map(int, stdin.readline().split()))
B=list(map(int, stdin.readline().split()))
C=A+B
C.sort()
for i in C: print(i, end=" ")
