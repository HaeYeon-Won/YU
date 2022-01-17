"""
N개의 수로 이루어진 수열 A1, A2, ..., AN이 주어진다. 또, 수와 수 사이에 끼워넣을 수 있는 N-1개의 연산자가 주어진다. 연산자는 덧셈(+), 뺄셈(-), 곱셈(×), 나눗셈(÷)으로만 이루어져 있다.

우리는 수와 수 사이에 연산자를 하나씩 넣어서, 수식을 하나 만들 수 있다. 이때, 주어진 수의 순서를 바꾸면 안 된다.

예를 들어, 6개의 수로 이루어진 수열이 1, 2, 3, 4, 5, 6이고, 주어진 연산자가 덧셈(+) 2개, 뺄셈(-) 1개, 곱셈(×) 1개, 나눗셈(÷) 1개인 경우에는 총 60가지의 식을 만들 수 있다.
예를 들어, 아래와 같은 식을 만들 수 있다.

1+2+3-4×5÷6
1÷2+3+4-5×6
1+2÷3×4-5+6
1÷2×3-4+5+6
식의 계산은 연산자 우선 순위를 무시하고 앞에서부터 진행해야 한다. 또, 나눗셈은 정수 나눗셈으로 몫만 취한다. 음수를 양수로 나눌 때는 C++14의 기준을 따른다.
즉, 양수로 바꾼 뒤 몫을 취하고, 그 몫을 음수로 바꾼 것과 같다. 이에 따라서, 위의 식 4개의 결과를 계산해보면 아래와 같다.

1+2+3-4×5÷6 = 1
1÷2+3+4-5×6 = 12
1+2÷3×4-5+6 = 5
1÷2×3-4+5+6 = 7
N개의 수와 N-1개의 연산자가 주어졌을 때, 만들 수 있는 식의 결과가 최대인 것과 최소인 것을 구하는 프로그램을 작성하시오.
"""
from itertools import combinations, permutations
from copy import deepcopy
def calculate(a,b, o):
    if o==0: return a+b
    elif o==1: return a-b
    elif o==2: return a*b
    elif o==3:
        if a<0 or b<0:
            a, b= abs(a), abs(b)
            return -(a//b)
        else:
            return (a // b)

def solution():
    case=set(list(permutations(operator, n-1)))
    #print(case)
    max_val, min_val = -1000000000, 100000000
    for c in case:
        val=0
        temp=deepcopy(a)
        for i in range(len(c)):
            temp[i+1]=calculate(temp[i], temp[i+1], c[i])
        max_val=max(max_val, temp[-1])
        min_val=min(min_val, temp[-1])
    print(max_val)
    print(min_val)


n=int(input())
a=list(map(int, input().split()))
temp=list(map(int, input().split())) #사용가능한 덧셈, 뺄셈, 곱셈, 나눗셈의 갯수
operator=[]
for i in range(len(temp)):
    for j in range(temp[i]): operator.append(i)
solution()


"""
itertools를 사용하지않고 구현해봐야 할것 같다.
메모리, 시간이 너무 많이 걸린다.
"""
