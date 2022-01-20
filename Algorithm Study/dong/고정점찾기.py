"""
고정점이랑 수열의 원소 중에서 극 밧이 인덱스와 동일한 원소를 의미합니다.
하나의 수열이 N개의 서로 다른 원소를 포함하고 있으며, 모든 원소가 오름차순으로 정렬되어 있습니다.
이때 이 수열에서 고정점이 있다면, 고정점을 축력하는 프로그램을 작성하세요.
고정점은 대 1개만 존재합니다. 만약 고정점이 없다면 -1을 출력합니다.
"""

def solution(L):
    start, end = 0, len(L)-1
    while start<=end:
        mid = (start+end)//2
        if L[mid]==mid:
            return mid
        elif L[mid]>mid: end = mid-1
        elif L[mid]<mid: start = mid+1
    return -1

n= map(int, input().split())
L=list(map(int, input().split()))
print(solution(L))
