"""
방문 판매원 A는 많은 회사가 모여 있는 공중 미래 도시에 있다. 공중미래 도시에는 1번부터 N번까지의 회사가 있는데 특정 회사끼리는 서로 도로를 통해 연결되어 있다.
방문 판매원 A는 현재 1번 회사에 위치해 있으며, X번 회사에 방문해 물건을 판매하고자 한다.
공중 미래 도시에서 특정 회사에 도착하기 위한 방법은 회사끼리 연결되어 있는 도로를 이용하는 방법이 유일하다.
또한 연결된 2개의 회사는 양방향으로 이동할 수 있다. 공중 미래 도시에서의 도로는 마하의 속도로 사람을 이동시켜주기 때문에 특정 회사와 다른 회사가 도로로 연결되어 있다면,
정확히 1만큼의 시간으로 이동할 수 있다.
또한 오늘 방문 판매원 A는 기대하던 소개팅에도 참석하고자 한다.
소개팅의 상대는 K번 회사에 존재한다. 방문 판매원 A는 X번 회사에 가서 물건을 판매하기 전에 먼저 소개팅 상대의 회사에 찾아가서 함께 커피를 마실 예정이다.
따라서 방문 판매원 A는 1번 회사에서 출발하여 K번 회사를 방문한 뒤에 X번 회사로 가는 것이 목표다. 이때 방문 판매원 A는 가능한 한 빠르게 이동하고자 한다.
방문 판매원이 회사 사이를 이동하게 되는 최소 시간을 계산하는 프로그램을 작성하시오. 이때 소개팅의 상대방과 커피를 마시는 시간 등은 고려하지 않는다고 가정한다.
"""
def solution(table):
    for k in range(1, vertex+1):
        for a in range(1, vertex+1):
            for b in range(1, vertex+1):
                table[a][b]= min(table[a][b], table[a][k]+table[k][b])
    for i in table:
        print(i)
    distance = table[1][K] + table[K][X]
    if distance==inf: return -1
    else: return distance

inf = int(10e9)
vertex, edge = map(int,input().split())
table = [[inf for _ in range(vertex+1)] for _ in range(vertex+1)]
loop=[(i,i) for i in range(1, vertex+1)]
for init in loop:
    table[init[0]][init[1]]=0
for i in range(edge):
    start, dest = map(int,input().split())
    table[start][dest]=1
    table[dest][start] = 1
K, X = map(int, input().split())
solution(table)


"""
플로이드 워셜 알고리즘을 사용한 문제이다.
플로이드 워셜 알고리즘은 모든 지점에서 다른 모든 지점까지의 최단 경로를 모두 구해야 하는 경우에 사용할 수 있는 알고리즘이다.
다익스트라 알고리즘같은 경우에는 단계마다 최단 거리를 가지는 노드를 하나씩 반복적으로 선택하고 해당 노드를 거쳐가는 경로를 확인하며 테이블을 갱신한다.
하지만 플로이트 워셜 알고리즘은 방문하지 않은 노드 중에서 최단 거리를 갖는 노드를 찾을 필요가 없다는 점이 다르다.
해당 알고리즘의 시간복잡도는 노드가 N개일때 N번 수행하고, 단계마다 O(N^2)의 연산을 통해 모든경로를 고려하므로 총 시간복잡도는 O(N^3)이다.
이때 구체적인 점화식은 Dab = min(Dab, Dak+Dkb)와 같다.
따라서 전체적으로 3중 반복문을 이용하여 이 점화식에 따라 최단 거리 테이블을 갱신하면 된다.
"""
