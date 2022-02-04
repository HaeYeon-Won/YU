"""
n × n의 크기의 대나무 숲이 있다. 욕심쟁이 판다는 어떤 지역에서 대나무를 먹기 시작한다.
그리고 그 곳의 대나무를 다 먹어 치우면 상, 하, 좌, 우 중 한 곳으로 이동을 한다. 그리고 또 그곳에서 대나무를 먹는다.
그런데 단 조건이 있다. 이 판다는 매우 욕심이 많아서 대나무를 먹고 자리를 옮기면 그 옮긴 지역에 그 전 지역보다 대나무가 많이 있어야 한다.
이 판다의 사육사는 이런 판다를 대나무 숲에 풀어 놓아야 하는데, 어떤 지점에 처음에 풀어 놓아야 하고, 어떤 곳으로 이동을 시켜야 판다가 최대한 많은 칸을 방문할 수 있는지 고민에 빠져 있다.
우리의 임무는 이 사육사를 도와주는 것이다. n × n 크기의 대나무 숲이 주어져 있을 때, 이 판다가 최대한 많은 칸을 이동하려면 어떤 경로를 통하여 움직여야 하는지 구하여라.
"""
from sys import stdin
from sys import setrecursionlimit
setrecursionlimit(150000)
direction = ((1,0),(-1,0),(0,1),(0,-1))
def solution(row, col):
    if visited[row][col]!=0: return visited[row][col]
    visited[row][col]=1
    for dx, dy in direction:
        x,y = row+dx, col+dy
        if 0<=x<n and 0<=y<n and data[row][col]<data[x][y]:
            visited[row][col] = max(visited[row][col], solution(x, y)+1)
    return visited[row][col]

n=int(stdin.readline())
data = [list(map(int, stdin.readline().split()))for _ in range(n)]
result = 0
visited = [[0 for _ in range(n)] for _ in range(n)]
for i in range(n):
    for j in range(n):
        result = max(result, solution(i, j))
print(result)

"""
처음에는 그냥 BFS를 사용하여 값을 하나하나 갱신해 가며 해결하려하였지만 시간초과가 발생하였다.
이후 조건을 걸어 이미 방문한 장소에 방문한경우, 값을 해당시점의값+기록된값 으로 처리하고 
큐에 append하지 않아 더이상 해당경로로 이동하지 않게 처리하고, 갱신값이 없는 경우만 갱신해주었지만 또한 시간초과가 발생하였다.
위와 같은 로직을 dfs로 옮겼는데 성공하였다. 왜그런지 잘 모르겠다 정말..
"""
