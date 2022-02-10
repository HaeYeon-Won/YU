"""
자연수 \(N\)과 정수 \(K\)가 주어졌을 때 이항 계수
\(\binom{N}{K}\)를 10,007로 나눈 나머지를 구하는 프로그램을 작성하시오.
"""
from sys import setrecursionlimit
setrecursionlimit(150000)
def fac(a):
    if a<=1: return 1
    else: return a*fac(a-1)
def solution():
    return (fac(N)//(fac(K)*fac(N-K)))%10007

N,K = map(int, input().split())
print(solution())
