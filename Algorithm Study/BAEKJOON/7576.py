"""
철수의 토마토 농장에서는 토마토를 보관하는 큰 창고를 가지고 있다. 토마토는 아래의 그림과 같이 격자 모양 상자의 칸에 하나씩 넣어서 창고에 보관한다.

창고에 보관되는 토마토들 중에는 잘 익은 것도 있지만, 아직 익지 않은 토마토들도 있을 수 있다. 보관 후 하루가 지나면,
익은 토마토들의 인접한 곳에 있는 익지 않은 토마토들은 익은 토마토의 영향을 받아 익게 된다.
하나의 토마토의 인접한 곳은 왼쪽, 오른쪽, 앞, 뒤 네 방향에 있는 토마토를 의미한다.
대각선 방향에 있는 토마토들에게는 영향을 주지 못하며, 토마토가 혼자 저절로 익는 경우는 없다고 가정한다.
철수는 창고에 보관된 토마토들이 며칠이 지나면 다 익게 되는지, 그 최소 일수를 알고 싶어 한다.

토마토를 창고에 보관하는 격자모양의 상자들의 크기와 익은 토마토들과 익지 않은 토마토들의 정보가 주어졌을 때, 며칠이 지나면 토마토들이 모두 익는지,
그 최소 일수를 구하는 프로그램을 작성하라. 단, 상자의 일부 칸에는 토마토가 들어있지 않을 수도 있다.
"""
from collections import deque
def FindTomato(row, col):
    """
    초기상태에서 토마토의 위치를 찾아주는 함수
    """
    q=deque()
    for r in range(row):
        for c in range(col):
            if box[r][c]==1: q.append((r,c)) #토마토 좌표정보와 경과 시간
    return q

def CheckBox(box):
    """
    모든 처리가 끝난 후 상자의 상태를 확인인    """
    for line in box:
        if 0 in line: return False
    return True

def solution(row, col, box):
    direction=((-1,0),(0,1),(1,0),(0,-1)) #북동남서
    q = FindTomato(row, col)
    time = 0 #시작시간

    while q:
        numTomato = len(q)
        for i in range(numTomato):#해당 시점에서 퍼져나갈 수 있는 토마토는 모두 해당 시점에서 처리
            nowR, nowC = q.popleft()
            for dx, dy in direction:
                x, y = nowR+dx, nowC+dy
                if 0<=x<row and 0<=y<col:
                    if box[x][y]==0:
                        box[x][y]=1
                        q.append((x,y))
        time+=1 #한 round가 끝나면 time+1

    if CheckBox(box): return time-1 #더이상 익을 수 있는 토마토가 없는 시점에서도 마지막에 time에 1을 더하므로 다시 빼줌
    else: return -1


if __name__ == "__main__":
    m,n = map(int,input().split()) #가로, 세로
    box = [list(map(int, input().split())) for _ in range(n)] #1: 익은 토마토, 0: 익지않은 토마토, -1:토마토가 들어있지 않음
    print(solution(n,m,box))


"""
사용한 알고리즘
1. BFS
2. 큐
"""
