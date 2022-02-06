"""
눈금의 간격이 1인 M×N(M,N≤100)크기의 모눈종이가 있다. 이 모눈종이 위에 눈금에 맞추어 K개의 직사각형을 그릴 때,
이들 K개의 직사각형의 내부를 제외한 나머지 부분이 몇 개의 분리된 영역으로 나누어진다.
예를 들어 M=5, N=7 인 모눈종이 위에 <그림 1>과 같이 직사각형 3개를 그렸다면, 그 나머지 영역은 <그림 2>와 같이 3개의 분리된 영역으로 나누어지게 된다.

<그림 2>와 같이 분리된 세 영역의 넓이는 각각 1, 7, 13이 된다.

M, N과 K 그리고 K개의 직사각형의 좌표가 주어질 때, K개의 직사각형 내부를 제외한 나머지 부분이 몇 개의 분리된 영역으로 나누어지는지,
그리고 분리된 각 영역의 넓이가 얼마인지를 구하여 이를 출력하는 프로그램을 작성하시오.
"""
from sys import stdin
from collections import deque
def init():
    for d in data:
        for r in range(d[1], d[3]):
            for c in range(d[0], d[2]):
                maps[r][c]=1
def BFS(row, col):
    val = 1
    direction = ((1,0),(-1,0),(0,1),(0,-1))
    q= deque()
    q.append((row,col))
    maps[row][col]=1
    while q:
        r,c = q.popleft()
        for dx, dy in direction:
            x,y = r+dx, c+dy
            if 0<=x<M and 0<=y<N:
                if maps[x][y]==0:
                    q.append((x,y))
                    val+=1
                    maps[x][y] = val
    return val

def solution():
    result = 0
    vals = []
    for i in range(M):
        for j in range(N):
            if maps[i][j]==0:
                vals.append(BFS(i,j))
                result+=1
    vals.sort()
    print(result)
    for i in vals:print(i, end = " ")


M, N, K  = map(int, stdin.readline().split())
data = [list(map(int, stdin.readline().split())) for _ in range(K)]
maps = [[0 for _ in range(N)] for _ in range(M)]
init()
solution()
