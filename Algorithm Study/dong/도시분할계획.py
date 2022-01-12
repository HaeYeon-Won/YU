"""
첫째 줄에 집의 개수 N 길의 개수 M이 주어진다
그 다음 줄부터 M줄에 걸쳐 길의 정보가 A, B, C, 3개의 정수로 공백으로 구분되어 주어지는데
A번 집과 B번집을 연결하는 길의 유지비가 C라는 뜻이다.

출력조건
첫 째 줄에 길을 없애고 남은 유지비 합의 최솟값을 출력한다.
"""
from collections import deque
def find_parent(parent, x):
    if parent[x]!=x: #만약 자신이 root가 아니라면
        parent[x]=find_parent(parent, parent[x]) #재귀적으로 부모를 찾아가면 값을 갱신
    return parent[x] # 부모라면 자기자신 반환

def union_parent(parent, a, b):
    a=find_parent(parent, a) #a의 부모 확인
    b=find_parent(parent, b) #b의 부모확인
    if a>b: parent[a]=b #a가 b보다 크다면 a의 부모는 a
    else: parent[b]=a

def solution():
    parent = [i for i in range(N+1)]
    total=0
    for d in data:
        if find_parent(parent, d[0])==find_parent(parent, d[1]): continue
        union_parent(parent, d[0], d[1])
        total+=d[2]
        last=d[2]
    print(total-last)



N,M = map(int, input().split())
data = [list(map(int, input().split())) for _ in range(M)] #합치기 (0, a, b), 같은팀 확인(1, a, b)
data=sorted(data, key=lambda x:x[2])
solution()
