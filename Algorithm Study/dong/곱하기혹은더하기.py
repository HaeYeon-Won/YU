"""
각자리 숫자가 숫자로만 이루어진 문자열 S가 주어졌을 때, 왼쪽부터 오른쪽으로 하나씩 모든 숫자를 확인하며,
숫자 사이에 *, +를 넣어 만들어질 수 있는 가장 큰 수를 구하는 프로그램을 만드시오.
단, 모든연산은 왼쪽부터 이루어짐
"""

def solution():
    result = int(number[0])
    for i in range(1, len(number)): result=max(result+int(number[i]), result*int(number[i]))
    print(result)

number = input()
solution()
