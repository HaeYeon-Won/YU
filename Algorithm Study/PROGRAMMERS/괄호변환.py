"""
카카오에 신입 개발자로 입사한 "콘"은 선배 개발자로부터 개발역량 강화를 위해 다른 개발자가 작성한 소스 코드를 분석하여 문제점을 발견하고 수정하라는 업무 과제를 받았습니다.
소스를 컴파일하여 로그를 보니 대부분 소스 코드 내 작성된 괄호가 개수는 맞지만 짝이 맞지 않은 형태로 작성되어 오류가 나는 것을 알게 되었습니다.
수정해야 할 소스 파일이 너무 많아서 고민하던 "콘"은 소스 코드에 작성된 모든 괄호를 뽑아서 올바른 순서대로 배치된 괄호 문자열을 알려주는 프로그램을 다음과 같이 개발하려고 합니다.

조건
1. 입력이 빈 문자열인 경우, 빈 문자열을 반환합니다.
2. 문자열 w를 두 "균형잡힌 괄호 문자열" u, v로 분리합니다. 단, u는 "균형잡힌 괄호 문자열"로 더 이상 분리할 수 없어야 하며, v는 빈 문자열이 될 수 있습니다.
3. 문자열 u가 "올바른 괄호 문자열" 이라면 문자열 v에 대해 1단계부터 다시 수행합니다.
  3-1. 수행한 결과 문자열을 u에 이어 붙인 후 반환합니다.
4. 문자열 u가 "올바른 괄호 문자열"이 아니라면 아래 과정을 수행합니다.
  4-1. 빈 문자열에 첫 번째 문자로 '('를 붙입니다.
  4-2. 문자열 v에 대해 1단계부터 재귀적으로 수행한 결과 문자열을 이어 붙입니다.
  4-3. ')'를 다시 붙입니다.
  4-4. u의 첫 번째와 마지막 문자를 제거하고, 나머지 문자열의 괄호 방향을 뒤집어서 뒤에 붙입니다.
  4-5. 생성된 문자열을 반환합니다.
  "( ( ) ( ) ) ( ) "
"""
def right(p):
    if p[0]==')': return False
    count=0
    for i in p:
        if count<0: return False
        if i=='(': count+=1
        else: count-=1
    return True

def divChar(p):
    u, v = '', ''
    temp=[]
    for c in p: #균형잡힌 문자열을 만드는 과정
        temp.append(c)
        if temp.count('(')==temp.count(')'):
            break
    i=len(temp)
    u="".join(temp)
    v=p[i:]
    return u, v

def reverse(p):
    temp=''
    for i in range(1,len(p)-1):
        if p[i]=='(': temp+=')'
        else: temp+='('
    return temp

def solution(p):
    if len(p)==0:return '' #문자가 없다면 빈 문자 반환
    if right(p): return p # 올바른 괄호라면 해당 괄호 그대로 반환
    else:
        u,v=divChar(p) #u, v를 자르는 과정
        if right(u): return u+solution(v) #u가 맞다면 v를 다시 재귀적으로 처리
        else:
            return "("+solution(v)+")"+reverse(u) #u가 맞지 않으면 조건대로 처리


val=")()(()"
print(solution(val))
