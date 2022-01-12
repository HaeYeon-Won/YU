"""
동빈이는 총 N개의 강의를 듣고자 한다. 모든 강의는 1번부터 N번까지의 번호를 가진다. 또한 동시에 여러 개의 강의를 들을 수 있다고 가정한다.
예를 들어 N=3일 때, 3 번 강의의 선수 강의로 1번과 2 번 강의가 있고, 1번과 2번 강의는 선수 강의가 없다고 가정하자.
그리고 각 강의에 대하여 강의 시간이 다음과 같다고 가정하자.
1번 강의 : 30
2번 강의 : 20
3번 강의 : 40
이 경우 1 번 강의를 수강하기 까지의 최소 시간은 30 시간,
2번 강의를 수강하기 까지의 최소 시간은 20 시간, 3번 강의를 수강하기 까지의 최소 시간은 7- 시간이다.
동빈이가 듣고자 하는 N개의 강의 정보가 주어졌을 때 , N개의 강의에 대하여 수강하기 까지 걸리는 최소 시간을 각각 출력하는 프로그램을 작성하시오.
"""
from collections import deque
from copy import deepcopy
def topology_sort(vertex, indegree, graph):
    result=deepcopy(time)
    q=deque()
    for i in range(1, vertex+1):
        if indegree[i]==0:
            q.append(i)
    while q:
        now=q.popleft()
        for i in graph[now]:
            result[i]=max(result[i], result[now]+time[i])
            indegree[i]-=1
            if indegree[i]==0:
                q.append(i)
    return result

def solution(vertex, graph, indegree, time):
    result = topology_sort(vertex, indegree, graph)
    print("graph = ", graph)
    print("indegree = ", indegree)
    print("time = ",time)
    print("result = ", result)



N= int(input())
graph = [[] for _ in range(N+1)]
time=[0 for _ in range(N+1)]
indegree = [0] * (N+1)
for i in range(1, N+1):
    data=list(map(int, input().split()))
    time[i]=data[0]
    for j in data[1:-1]:
        graph[j].append(i)
        indegree[i]+=1
solution(N, graph, indegree, time)
