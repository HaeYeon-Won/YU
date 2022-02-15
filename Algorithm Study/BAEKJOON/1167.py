"""
트리의 지름이란, 트리에서 임의의 두 점 사이의 거리 중 가장 긴 것을 말한다. 트리의 지름을 구하는 프로그램을 작성하시오.
입력
트리가 입력으로 주어진다. 먼저 첫 번째 줄에서는 트리의 정점의 개수 V가 주어지고 (2 ≤ V ≤ 100,000)둘째 줄부터 V개의 줄에 걸쳐 간선의 정보가 다음과 같이 주어진다.
정점 번호는 1부터 V까지 매겨져 있다.
먼저 정점 번호가 주어지고, 이어서 연결된 간선의 정보를 의미하는 정수가 두 개씩 주어지는데, 하나는 정점번호, 다른 하나는 그 정점까지의 거리이다.
예를 들어 네 번째 줄의 경우 정점 3은 정점 1과 거리가 2인 간선으로 연결되어 있고, 정점 4와는 거리가 3인 간선으로 연결되어 있는 것을 보여준다.
각 줄의 마지막에는 -1이 입력으로 주어진다. 주어지는 거리는 모두 10,000 이하의 자연수이다.
"""
import heapq
def solution(start):
    q=[]
    heapq.heappush(q, (0, start))
    distance[start] = 0
    while q:
        dist, now = heapq.heappop(q)
        if distance[now]<dist:
            continue
        for i in graph[now]:
            cost = dist+i[1]
            if cost< distance[i[0]]:
                distance[i[0]]=cost
                heapq.heappush(q, (cost, i[0]))
    return distance[1:]

V = int(input())
INF = int(10e9)
graph=[[] for i in range(V+1)]
for i in range(V):
    data = list(map(int, input().split()))
    now = data[0]
    for i in range(1, len(data)-1, 2):
        a, b = data[i], data[i+1]
        graph[now].append((a,b))
distance = [INF] * (V + 1)
first = solution(1)
newStart = first.index(max(first))+1
distance = [INF] * (V + 1)
print(max(solution(newStart)))

"""
그래프에서 임의의 노드에서 각 노드까지의 거리를 측정하여 최대거리를 가지는 노드는 트리의 지름을 이루는 한 노드이다.
즉, 임의의 한점에서 각 노드까지의 거리를 구하고, 이중 최대거리를 갖는 노드에서 다시 시작하여
한번 더 각 노드 까지의 최대거리를 구한다면 그 최대거리가 트리의 지름이 된다.
"""
