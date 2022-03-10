"""
자연수 N과 M이 주어졌을 때, 아래 조건을 만족하는 길이가 M인 수열을 모두 구하는 프로그램을 작성하시오.

1부터 N까지 자연수 중에서 M개를 고른 수열
같은 수를 여러 번 골라도 된다.
고른 수열은 비내림차순이어야 한다.
길이가 K인 수열 A가 A1 ≤ A2 ≤ ... ≤ AK-1 ≤ AK를 만족하면, 비내림차순이라고 한다.
"""
from collections import deque
def solution(start):
    if len(q)==m:
        print(" ".join(map(str, q)))
        return
    for i in range(start, n+1):
        q.append(i)
        solution(i)
        q.pop()

if __name__ =="__main__":
    n,m = map(int, input().split())
    q = deque()
    solution(1)
    
"""
처음 작성할때는 (1,4) 다음 (2,1)이와서 어떻게 해야할지 몰랐다.
따라서 한번 진행할때마다 loop의 시작점을 정해주어 해결하였다.
"""
