"""
인체에 치명적인 바이러스를 연구하던 연구소에서 바이러스가 유출되었다. 다행히 바이러스는 아직 퍼지지 않았고, 바이러스의 확산을 막기 위해서 연구소에 벽을 세우려고 한다.

연구소는 크기가 N×M인 직사각형으로 나타낼 수 있으며, 직사각형은 1×1 크기의 정사각형으로 나누어져 있다. 연구소는 빈 칸, 벽으로 이루어져 있으며, 벽은 칸 하나를 가득 차지한다.

일부 칸은 바이러스가 존재하며, 이 바이러스는 상하좌우로 인접한 빈 칸으로 모두 퍼져나갈 수 있다. 새로 세울 수 있는 벽의 개수는 3개이며, 꼭 3개를 세워야 한다.

예를 들어, 아래와 같이 연구소가 생긴 경우를 살펴보자.
"""
import itertools
from collections import deque
from copy import deepcopy
from sys import stdin
def solution(row, col):
    q=deque()
    q.append([row, col])
    while q:
        r,c=q.popleft()
        for dx,dy in direction:
            x, y = r+dx, c+dy
            if 0<=x<n and 0<=y<m:
                if temp[x][y]==0:
                    temp[x][y]=2
                    q.append([x,y])

n,m=map(int, input().split())
lab=[list(map(int, stdin.readline().split())) for _ in range(n)]
zeros=[]
for i in range(n):
    for j in range(m):
        if lab[i][j]==0: zeros.append((i,j))
max_val=0
direction=[(1,0),(0,1),(-1,0),(0,-1)]

for k in list(itertools.combinations(zeros, 3)):
    temp = deepcopy(lab)
    for location in k:
        temp[location[0]][location[1]]=1
    for i in range(n):
        for j in range(m):
            if temp[i][j]==2:
                val=solution(i,j)
    val=0
    for a in range(n):
        for b in range(m):
            if temp[a][b] == 0: val += 1
    max_val=max(max_val, val)
print(max_val)

