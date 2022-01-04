"""
동빈이의 큰 수의 법칙은 다양한 수로 이루어진 배열이 있을 때
주어진 수들을 M번 더하여 가장 큰 수를 만드는 법칙이다.
단, 배열의 특정한 인덱스에 해당하는 수가 연속해서 K번을 초과하여 더해질 수 없는 것이 이 법칙의 특징이다.
예를들어 2,4,5,4,6 으로 이루어진 배열이 있을 때 M=8이고 K=3라 가정하면
6+6+6+5+6+6+6+5인 46이 된다.
단, 서로 다른 인덱스에 해당하는 수가 같은 경우에도 서로 다른 것으로 간주한다.
"""
from sys import stdin
def solution(n,m,k, number):
    number.sort()
    val=0
    for i in range(1,m+1):
        if i%k==0: val+=number[-2]
        else : val+=number[-1]
    return val

if __name__=='__main__':
    n,m,k=map(int, stdin.readline().split())
    number=list(map(int, stdin.readline().split()))
    print(solution(n,m,k,number))
