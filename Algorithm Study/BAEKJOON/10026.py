"""
적록색약은 빨간색과 초록색의 차이를 거의 느끼지 못한다. 따라서, 적록색약인 사람이 보는 그림은 아닌 사람이 보는 그림과는 좀 다를 수 있다.
크기가 N×N인 그리드의 각 칸에 R(빨강), G(초록), B(파랑) 중 하나를 색칠한 그림이 있다. 그림은 몇 개의 구역으로 나뉘어져 있는데, 구역은 같은 색으로 이루어져 있다.
또, 같은 색상이 상하좌우로 인접해 있는 경우에 두 글자는 같은 구역에 속한다. (색상의 차이를 거의 느끼지 못하는 경우도 같은 색상이라 한다)
예를 들어, 그림이 아래와 같은 경우에
RRRBB
GGBBB
BBBRR
BBRRR
RRRRR
적록색약이 아닌 사람이 봤을 때 구역의 수는 총 4개이다. (빨강 2, 파랑 1, 초록 1) 하지만, 적록색약인 사람은 구역을 3개 볼 수 있다. (빨강-초록 2, 파랑 1)
그림이 입력으로 주어졌을 때, 적록색약인 사람이 봤을 때와 아닌 사람이 봤을 때 구역의 수를 구하는 프로그램을 작성하시오.
"""
from sys import stdin
from collections import deque
from copy import deepcopy
def solution(data, start, target):
    direction=[(1,0),(0,1),(-1,0),(0,-1)]
    q= deque()
    q.append(start)
    while q:
        nowr, nowc = q.pop()
        data[nowr][nowc]=-1
        for dx, dy in direction:
            x,y=dx+nowr, dy+nowc
            if 0<=x<line and 0<=y<len(data):
                if data[x][y]==target:
                    q.append((x, y))
def printmtrx(mtrx):
    for i in mtrx:
        print(i)
    print()


line=int(stdin.readline())
data=[stdin.readline().rstrip() for _ in range(line)]
L=[]
for d in data:
    temp=[]
    for c in d:
        temp.append(c)
    L.append(temp)
result=[]
count=0
case1 = deepcopy(L)
for r in range(line):
    for c in range(len(case1[r])):
        if case1[r][c]!=-1:
            solution(case1, (r,c), case1[r][c])
            count+=1
result.append(count)
count=0
data=[]
for i in L:
    temp=[]
    for j in i:
        if j=='G': temp.append('R')
        else: temp.append(j)
    data.append(temp)
for r in range(line):
    for c in range(len(data[r])):
        if data[r][c]!=-1:
            solution(data, (r,c), data[r][c])
            count+=1

result.append(count)
for i in result: print(i, end = " ")


