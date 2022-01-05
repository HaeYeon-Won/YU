"""
동빈이는 N * M 크기의 직사각형 형태의 미로에 갇혀 있다. 미로에는 여러 마리의 괴물이 있어 이를피해 탈출해야 한다.
동빈이의 위치는 (1,1) 이고 미로의 출구는 (N, M)의 위치에 존재하며 한번에 한 칸 씩 이동할 수 있다.
이때 괴물이 있는 부분은 0으로 괴물이 없는 부분은 1로 표시되어 있다.
미로는 반드시 탈출할 수 있는 형태로 제시된다.
이때 동빈이가 탈출하기 위해 움직여애 하는 최소 칸의 개수를 구하시오.
단, 칸을 셀 때는 시작 칸과 마지막 칸을 모두 포함해서 계산한다.
"""
from collections import deque
from sys import stdin
def solution(mtrx):
    direction=[(1,0),(0,1),(-1,0),(0,-1)]
    queue=deque()
    queue.append((0,0))
    while queue:
        v=queue.popleft()
        r, c= v[0], v[1]
        for dx, dy in direction:
            x, y= r+dx, c+dy
            if (0<=x<=n-1) and (0<=y<=m-1):
                if (mtrx[x][y]==1) and (x,y)!=(0,0):
                    mtrx[x][y]+=mtrx[r][c]
                    queue.append((x,y))
    return mtrx[n-1][m-1]

if __name__ == '__main__':
    n, m = map(int, stdin.readline().split())
    mtrx=[]
    for _ in range(n):
        temp=stdin.readline().rstrip()
        mtrx.append([int(temp[i]) for i in range(len(temp))])
    print(solution(mtrx))
    print(mtrx)
