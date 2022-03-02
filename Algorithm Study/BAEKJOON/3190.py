"""
 'Dummy' 라는 도스게임이 있다. 이 게임에는 뱀이 나와서 기어다니는데, 사과를 먹으면 뱀 길이가 늘어난다.
 뱀이 이리저리 기어다니다가 벽 또는 자기자신의 몸과 부딪히면 게임이 끝난다.

게임은 NxN 정사각 보드위에서 진행되고, 몇몇 칸에는 사과가 놓여져 있다. 보드의 상하좌우 끝에 벽이 있다.
게임이 시작할때 뱀은 맨위 맨좌측에 위치하고 뱀의 길이는 1 이다. 뱀은 처음에 오른쪽을 향한다.

뱀은 매 초마다 이동을 하는데 다음과 같은 규칙을 따른다.

먼저 뱀은 몸길이를 늘려 머리를 다음칸에 위치시킨다.
만약 이동한 칸에 사과가 있다면, 그 칸에 있던 사과가 없어지고 꼬리는 움직이지 않는다.
만약 이동한 칸에 사과가 없다면, 몸길이를 줄여서 꼬리가 위치한 칸을 비워준다. 즉, 몸길이는 변하지 않는다.
사과의 위치와 뱀의 이동경로가 주어질 때 이 게임이 몇 초에 끝나는지 계산하라.
"""
from collections import deque
def solution():
    d = 0 #0:동, 1:남, 2:서, 3:북
    direction=((0,1),(1,0),(0,-1),(-1,0))
    time=0
    q=deque()
    body =deque()
    body.append([0,0])
    q.append((0,0))
    while q:
        r,c = q.popleft()
        time+=1
        nowR, nowC = r+direction[d][0], c+direction[d][1]
        if time in mData:
            if mData[time]=='D':
                d = (d+1)%4
            else:
                d=(d-1)%4
        if 0<=nowR<n and 0<=nowC<n:
            if (nowR, nowC) in body: break
            if pData[nowR][nowC]==1:
                pData[nowR][nowC] = 0
                q.append((nowR, nowC))
                body.append((nowR, nowC))
            else:
                body.append((nowR, nowC))
                body.popleft()
                q.append((nowR, nowC))
        else: break
    return time

if __name__=="__main__":
    #L : 왼쪽, D : 오른쪽
    n=int(input())
    k=int(input())
    pData=[[0] * n for _ in range(n)]
    for _ in range(k):
        r,c = map(int, input().split())
        pData[r-1][c-1]=1
    l=int(input())
    mData = {}
    for _ in range(l):
        t, d = input().split()
        mData[int(t)]=d
    print(solution())
