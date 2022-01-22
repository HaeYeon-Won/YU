"""
N개의 수가 주어졌을 때, 이를 오름차순으로 정렬하는 프로그램을 작성하시오.
"""
import sys
n = int(sys.stdin.readline())
nums = [0] * 10001
for _ in range(n):
    nums[int(sys.stdin.readline())] += 1
for i in range(10001):
    if nums[i] != 0:
        for j in range(nums[i]):
            print(i)
            
 """
 처음에는 merge sort로 해결하려 했지만  문제의 메모리 제한이 8MB 여서 배열을 나누는 과정에서 메모리 초과로 실패하였다.
 이후 위와같은 방법으로 input()을 사용하여 입력을 받았지만 시간초과가 났고, 이를 해결하기 위하여 stdin을 사용하였다.
 정렬방법을 사용하지 않고도 정렬 효과를 낼 수 있어서 굉장히 흥미로운 문제였다.(물론 시간은 오래걸리지만)
 """
