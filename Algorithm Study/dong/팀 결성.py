"""
학교에서 학생들에게 0~N번까지의 번호를 부여했다. 처음에는 모든 학생이 서로 다른 팀으로 구분되어
총 N+1개의 팀이 존재한다. 이때 선생님은 팀 합치기 연과과 같은 팀 여부 확인 연산을 사용할 수 있다.
'팀 합치기' 연산은 두 팀을 합치는 연산이다.
2. '같은 팀 여부 확인' 연산은 특정한 두 학생이 같은 팀에 속하는지를 확인하는 연산이다.
선생님이 M개의 연산을 수행할 수 있을때, '같은 팀 여부 확인'연산에 결과를 출력하는 프로그램을 작성하시오.
"""
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
    for d in data:
        if d[0]==0:
            union_parent(parent, d[1], d[2])
        elif d[0]==1:
            if find_parent(parent, d[1])==find_parent(parent, d[2]):
                print("YES")
            else:
                print("NO")


N,M = map(int, input().split())
data = [list(map(int, input().split())) for _ in range(M)] #합치기 (0, a, b), 같은팀 확인(1, a, b)
solution()
