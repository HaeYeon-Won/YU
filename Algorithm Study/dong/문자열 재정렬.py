"""
입력받은 문자에서 알파벳은 오름차순으로 앞에 출력, 바로 뒤에는 모둔 숫자의 합을 붙힌 문자열을 출력하시오
"""
def solution():
    alpha=[i for i in strings if not '0'<=i<='9']
    number=sum([int(i) for i in strings if '0'<=i<='9'])
    alpha.sort()
    alpha.append(str(number))
    print("".join(alpha))
strings=input()
solution()
