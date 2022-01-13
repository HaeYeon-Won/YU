"""
A, B 두사람이 볼링을 치고 있습니다. 두 사람은 서로 무게가 다른 볼링공을 고르려고 합니다.
볼링공은 총 N개가 있으며 각 볼링공 마다 무게가 적혀 있고, 공의 번호는 1번부터 순차적으로 부여됩니다.
또한 같은 무게의 공이 있을 수 있지만 서로 다른 공으로 간주합니다.
무게는 1~M까지 입니다.
"""
def solution():
    result=0
    for i in range(num-1):
        now=weight[i]
        result+= len([j for j in range(i+1, num) if j!=now])
    print(result)

num, m=map(int, input().split())
weight=list(map(int, input().split()))
solution()
