"""
N개의 수가 주어졌을 때, 이를 오름차순으로 정렬하는 프로그램을 작성하시오.
"""
n=int(input())
L=[int(input()) for _ in range(n)]
L.sort()
for i in L:
    print(i)
