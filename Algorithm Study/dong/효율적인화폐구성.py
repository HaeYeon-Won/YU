"""
N가지 종류의 화폐가 있다. 이 화폐들의 개수를 최소한으로 이용해서 그 가치의 합이 M원이 되도록 하려고 한다.
이때 각 화폐는 몇 개라도 사용할 수 있으며, 사용한 화폐의 구성은 같지만 순서만 다른 것은 같은 경우로 구분한다.
예를 들어 2원 3원 단위의 화폐가 있을 때는 15원을 만들기 위해 3원을 5개 사용하는 것이 가장 최소한의 화쳬 개수이다.

"""
def solution(now, money):
    dP = [10001 for i in range(now+1)]
    dP[0]=0
    for i in range(now):
        for j in money:
            idx = i+j
            if idx<=now: dP[idx] = min(dP[idx], dP[i]+1)
    if dP[now]==10001: return -1
    else: return dP[now]



n, now = map(int, input().split())
money = [int(input()) for _ in range(n)]
money=set(money)
money=list(money)
print(solution(now, money))
