"""
n*m크기의 금광이 있습니다. 금광은 1*1 크기의 칸으로 나누어져 있으며, 각 칸은 특정한 크기의 금이 들어있습니다.
채굴자는 첫 번째 열부터 출발하여 금을 캐기 시작합니다. 맨 처음에는 첫 번째 열의 어느 행에서든 출발 할 수 있습니다.
이후에 m번에 걸쳐서 매번 오른쪽 위, 오른쪽, 오른쪽 아래 3 가지 중 하나의 위치로 이동해야 합니다.
결과적으로 채굴자가 얻을 수 있는 금의 최대 크기를 출력하는 프로그램을 작성하시오.
"""
from copy import deepcopy
from sys import stdin
from collections import deque
def solution():
    direction = [(0,1),(1,1),(-1,1)]
    for data in test:
        origin = deepcopy(data)
        Rrange, Crange = len(data), len(data[0])
        q= deque()
        for i in range(Rrange): q.append((i, 0))
        visit=[(i, 0) for i in range(Rrange)]
        while q:
            r, c = q.popleft()
            for dx, dy in direction:
                x,y = r+dx, c+dy
                if 0<=x<Rrange and 0<=y<Crange:
                    data[x][y] = max(origin[x][y]+data[r][c], data[x][y])
                    if (x,y) not in visit:
                        q.append((x,y))
        data = sorted(data, key = lambda x:x[-1], reverse=True)
        print(data[0][-1])

t=int(stdin.readline())
test = []
for _ in range(t):
    row, col = map(int, stdin.readline().split())
    data = list(map(int, stdin.readline().split()))
    temp=[]
    for i in range(row):#0:col, col:col*2,
        temp.append(data[i*col:(i+1)*col])
    test.append(temp)
solution()


"""
동적 계획법에 관한 문제
광부가 이동할 수 있는 위치를 direction에 저장 후 계획대로 이동하였다.
이때 deepcopy 모듈을 이용해 원본 배열을 저장해 놓은 뒤(광부가 움직일때 마다 값이 갱신되므로)
data[x][y] = max(origin[x][y]+data[r][c], data[x][y]) 와 같은 점화식을 통해 최대값을 갱신하였다.
또 이미 이동한 위치는 방문은 할 수 있지만 중복적으로 que에 담기는것을 방지하였다.
"""
