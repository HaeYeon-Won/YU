"""
문제
방향그래프가 주어지면 주어진 시작점에서 다른 모든 정점으로의 최단 경로를 구하는 프로그램을 작성하시오. 단, 모든 간선의 가중치는 10 이하의 자연수이다.

입력
첫째 줄에 정점의 개수 V와 간선의 개수 E가 주어진다. (1 ≤ V ≤ 20,000, 1 ≤ E ≤ 300,000) 모든 정점에는 1부터 V까지 번호가 매겨져 있다고 가정한다.
둘째 줄에는 시작 정점의 번호 K(1 ≤ K ≤ V)가 주어진다. 셋째 줄부터 E개의 줄에 걸쳐 각 간선을 나타내는 세 개의 정수 (u, v, w)가 순서대로 주어진다.
이는 u에서 v로 가는 가중치 w인 간선이 존재한다는 뜻이다. u와 v는 서로 다르며 w는 10 이하의 자연수이다.
서로 다른 두 정점 사이에 여러 개의 간선이 존재할 수도 있음에 유의한다.
"""
from sys import stdin
import heapq
def solution(start):
    q=[]
    heapq.heappush(q, (0, start)) #시작 노드로 가기 위한 최단 경로는 0으로 설정하여, 큐에삽입
    distance[start]=0
    while q:# 큐가 존재할때 까지
        dist, now = heapq.heappop(q) #최단거리가 가장 짧은 노드에 대한 정보 pop
        if distance[now]<dist: #현재 노드가 처리된적이 있다면 무시
            continue
        for i in graph[now]: #현재 노드와 연결된 다른 인접한 노드들을 확인
            cost=dist+i[1]
            if cost<distance[i[0]]: # 현재 노드를 지나쳐, 다른 노드로 이동하는 거리가 더 짧은 경우
                distance[i[0]]=cost
                heapq.heappush(q, (cost, i[0]))
    for i in range(1, len(distance)):
        if distance[i]==INF:print("INF")
        else: print(distance[i])

INF=int(1e9)
vertex, edge = map(int, stdin.readline().split())
start = int(stdin.readline())
graph = [[] *(vertex+1) for _ in range(vertex+1)]
distance = [INF]*(vertex+1)
for _ in range(edge):
    u,v,w = map(int, stdin.readline().split())
    graph[u].append((v,w))
solution(start)


"""
다익스트라 개념을 생각하는데 너무 오래걸렸다.
조금 더 
"""
