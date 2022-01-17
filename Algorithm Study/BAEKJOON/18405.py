from collections import deque
from sys import stdin
def solution():
    q=deque()
    temp=deque()
    for i in range(1, len(virus)):
        for j in range(len(virus[i])):
            temp.append(virus[i][j])
    for i in range(S):
        q=temp
        temp=deque()
        while q:
            r,c,t =q.popleft()
            for dx,dy in direction:
                x, y = r+dx, c+dy
                if 0<=x<n and 0<=y<n:
                    if lab[x][y]==0:
                        lab[x][y]=t
                        temp.append([x,y,t])
    return lab[X-1][Y-1]

direction=[(1,0),(0,1),(-1,0),(0,-1)]
n,m=map(int, input().split())
lab=[list(map(int, stdin.readline().split())) for _ in range(n)]
virus = [[] for _ in range(m+1)]
for i in range(n):
    for j in range(n):
        val=lab[i][j]
        if val!=0: virus[val].append((i,j,val))
S,X,Y = map(int, input().split())
print(solution())
