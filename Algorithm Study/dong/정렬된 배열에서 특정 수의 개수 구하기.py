"""
n개의 원소를 포함하고 있는 수열이 오름차순으로 정렬되어 있습니다. 이때 이 수열에서 x가 등장하는 횟수를 계산하세요.
예를들어 수열 [1,1,2,2,2,3,]이 있을때 x=2라면 수열에서 값이 2인 원소가 4개이므로 4를출력합니다.
"""
import bisect

def solution(key, L):
    left = bisect.bisect_left(L, key)
    right= bisect.bisect_right(L, key)
    return right-left

n, key = map(int, input().split())
L=list(map(int, input().split()))
print(solution(key, L))
