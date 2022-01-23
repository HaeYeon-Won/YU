"""
알파벳 소문자로 이루어진 N개의 단어가 들어오면 아래와 같은 조건에 따라 정렬하는 프로그램을 작성하시오.

길이가 짧은 것부터
길이가 같으면 사전 순으로
"""
from sys import stdin, stdout
def solution(s):
    s=sorted(s, key=lambda x:(x[0], x[1]))
    for i in s:
        print("{} {}".format(i[0], i[1]))

n=int(stdin.readline())
s = [list(map(int, stdin.readline().split())) for _ in range(n)]
solution(s)
