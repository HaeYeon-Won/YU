"""
알파벳 소문자로 이루어진 N개의 단어가 들어오면 아래와 같은 조건에 따라 정렬하는 프로그램을 작성하시오.

길이가 짧은 것부터
길이가 같으면 사전 순으로
"""
from sys import stdin, stdout
def solution(s):
    s.sort()
    s.sort(key = lambda x:len(x))
    for i in s:
        stdout.write(i+'\n')

n=int(stdin.readline())
s = [stdin.readline().rstrip() for _ in range(n)]
s=list(set(s))
solution(s)

"""
먼저 중복을 제거하기위해 set으로 변환 후 다시 list로 변환하였다.
이후 사전순으로 정렬 후
다시 문자열의 길이순으로 정렬해 주었다.
기존에는 lambda함수는 2차원 배열에서 우선순위를줄때 사용하였지만
문자열 길이를 기준으로 사용해 볼 수 있어서 흥미로웠다.
"""
