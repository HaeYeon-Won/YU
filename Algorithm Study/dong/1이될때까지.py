"""
어떠한 수 N이 1이 될 때까지 다음의 두 과정 중 하나를 반복적으로 선택하여 수행하려고 한다.
단, 두번 째 연산은 N이 K로 나누어 떨어질 때만 선택할 수 있다.
1. N에서 1을 뺀다.
2. N을 K로 나눈다.
N이 1이 될때까지의 1 or 2번의 과정을 수행해야하는 최소 횟수를 구하는 프로그램을 작성하시오
"""
from sys import stdin
def solution(n,m):
    answer=0
    while n!=1:
        if n%m==0: n=n//m
        else: n=n-1
        answer+=1
    return answer

if __name__=='__main__':
    n,m=map(int, stdin.readline().split())
    print(solution(n,m))
