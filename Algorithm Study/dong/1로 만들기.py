"""
정수 X가 주어질 대 정수 X에 사용할 수 있는 연산은 다음과 같이 4가지이다.
1. X가 5로 나누어 떨어지면, 5로 나눈다
2. 3으로 나누어 떨어지면, 3으로 나눈다.
3. 2로 나누어 떨어지면 2로 나눈다
4. 1을뺀다.
정수 X가 주어졌을 때, 연산 4가지를 사용해서 1을 만들려고 한다. 연산을 사용하는 횧수의 최솟값을 출력하시오
."""
def solution(n):
    dP=[30001 for i in range(n+1)]
    dP[n]=0
    for i in range(n,0,-1):
        if i % 5 == 0: dP[i // 5] = min(dP[i // 5], dP[i] + 1)
        if i % 3 == 0: dP[i // 3] = min(dP[i // 3], dP[i] + 1)
        if i % 2 == 0: dP[i // 2] = min(dP[i // 2], dP[i] + 1)
        dP[i-1]=min(dP[i-1], dP[i]+1)
    print(dP[1])

n=int(input())
solution(n)

