"""
n(2 ≤ n ≤ 100)개의 도시가 있다. 그리고 한 도시에서 출발하여 다른 도시에 도착하는 m(1 ≤ m ≤ 100,000)개의 버스가 있다. 각 버스는 한 번 사용할 때 필요한 비용이 있다.
모든 도시의 쌍 (A, B)에 대해서 도시 A에서 B로 가는데 필요한 비용의 최솟값을 구하는 프로그램을 작성하시오.
"""
from sys import stdin
import heapq
def solution(start):
    distance = [int(1e9)] * (vertex + 1)
    q=[]
    heapq.heappush(q, (0,start))
    distance[start]=0
    while q:
        dist, now = heapq.heappop(q)
        if distance[now]<dist:
            continue
        for i in graph[now]:
            cost=dist+i[1]
            if cost<distance[i[0]]:
                distance[i[0]]=cost
                heapq.heappush(q, (cost, i[0]))
    for i in range(1, len(distance)):
        if distance[i]==int(1e9): distance[i]=0
    return " ".join([str(distance[i]) for i in range(1, len(distance))])

vertex=int(stdin.readline())
numEdge = int(stdin.readline())
graph=[[] for _ in range(vertex+1)]
distance=[int(1e9)]*(vertex+1)
for _ in range(numEdge):
    u,v,w = map(int, stdin.readline().split())
    graph[u].append((v,w))
for i in range(1, vertex+1):
    print(solution(i))

"""
전형적인 플로이드 와샬 알고리즘 문제.
다익스트라로 풀면 효율이 증가할것이라 예상하였지만 그렇지 못했다...
플로이트 와샬의 시간복잡도는 N^3 이고
다익스트라의 복잡도는 ElogV 인데
총 N개의 vertex만큼 반복하므로 E*N의 복잡도를 가져 더 효율적이라 생각하였지만
아니였다.
"""
