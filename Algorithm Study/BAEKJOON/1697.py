"""
수빈이는 동생과 숨바꼭질을 하고 있다. 수빈이는 현재 점 N(0 ≤ N ≤ 100,000)에 있고, 동생은 점 K(0 ≤ K ≤ 100,000)에 있다.
수빈이는 걷거나 순간이동을 할 수 있다. 만약, 수빈이의 위치가 X일 때 걷는다면 1초 후에 X-1 또는 X+1로 이동하게 된다.
순간이동을 하는 경우에는 1초 후에 2*X의 위치로 이동하게 된다.
수빈이와 동생의 위치가 주어졌을 때, 수빈이가 동생을 찾을 수 있는 가장 빠른 시간이 몇 초 후인지 구하는 프로그램을 작성하시오.
"""
from collections import deque

def bfs():
   q=deque()
   q.append(n)
   while q:
     now=q.popleft()
     if now==k:
       return
     for i in (now-1,now+1,now*2):
       if 0<=i<100001 and dp[i]==0:
         dp[i]=dp[now]+1
         q.append(i)

n,k=map(int,input().split())
dp=[0]*100001

bfs()
print(dp[k])
