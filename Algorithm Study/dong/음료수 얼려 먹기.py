"""
N * M 크기의 얼음 틀이 있다. 구멍이 뚫려있는 부분은 0, 칸막이가 존재하는 부분은 1로 표시된다.
구멍이 뚫려있는 부분 끼리 상, 하 ,좌, 우로 붙어있는 경우 서로 연결되어 있는 것으로 간주한다.
이때 얼음 틀의 모양이 주어졌을 때 생성되는 총 아이스크림의 개수를 구하는 프로그램을 작성 하시오.
"""
from collections import deque

def BFS(row, col, mtrx):
    direction=[(1,0),(0,1),(-1,0),(0,-1)]
    queue=deque()
    queue.append((row, col))
    while queue:
        v=queue.popleft()
        mtrx[v[0]][v[1]]=1
        for dx, dy in direction:
            x, y=row+dx, col+dy
            if (0<=x<=n-1) and (0<=y<=m-1):
                if mtrx[x][y]==0:
                    queue.append((x,y))



if __name__ == '__main__':
    n, m = map(int, input().split())
    mtrx=[]
    answer=0
    for i in range(n):
        data=input()
        temp=[]
        for j in range(m):
            temp.append(int(data[j]))
        mtrx.append(temp)
    for r in range(n):
        for c in range(m):
            if mtrx[r][c]==0:
                BFS(r, c, mtrx)
                answer+=1
    print(answer)
    
"""
DFS를 이용하더라도 풀이가능
"""
