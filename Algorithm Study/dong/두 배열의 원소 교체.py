"""
N, K 그리고 배열A와 B의 정보가 주어ㅕㅆ을 때, 최대 K번의 바꿔치기 연산을 수행하여 만들 수 있는
배열 A의 모든 원소의 합의 최대값을 출력하는 프로그램을 작성하시오.
"""
def solution(A, B ,k):
    A.sort()
    B.sort(reverse=True)
    for i in range(k):
        if A[i]<B[i]: A[i]=B[i]
    return sum(A)

n, k = map(int, input().split())
A=list(map(int, input().split()))
B=list(map(int, input().split()))
print(solution(A, B, k))
