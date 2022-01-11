"""
문제
어떤 나라에 N개의 도시가 있다.
X에서 Y로 향하는 통로가 있으면 X->Y는 보낼 수 있지만 Y->X로는 따로 통로가 있어야 한다.
특정 도시에서 다른 도시로 전부 전보를 보내기 위해서 필요한 시간은 얼마인지 계산하라.

입력
첫째 줄에 도시의 개수 N, 통로의 개수 M, 메세지를 보내고자 하는 도시 C가 주어진다.
(1<= N <= 30000 , 1<= M <= 200000, 1<= C <= N)
둘째 줄부터 M+1 번째 줄에 걸쳐서 통로에 대한 정보 X,Y,Z가 주어진다. 이는 특정 도시 X에서 다른 특정 도시 Y로 이어지는 통로가 있으며, 메세지가 전달되는 시간이 Z라는 의미다.
(1<=X, Y<=N, 1<=Z<=1000)

출력
첫째 줄에 도시 C에서 보낸 메세지를 받는 도시의 총 개수와 총 걸리는 시간을 공백으로 구분하여 출력한다.
"""
import heapq
def dijkstrea(start):
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
    count=-1
    max_dist=0
    for i in distance:
        if i!=inf:
            count+=1
            max_dist=max(max_dist, i)
    print(count, max_dist)
inf = int(10e9)
vertex, edge, destination = map(int,input().split())
graph=[[] for i in range(vertex+1)]
distance =[inf] * (vertex+1)

for _ in range(edge):
    x,y,z = map(int, input().split())
    graph[x].append((y,z))


