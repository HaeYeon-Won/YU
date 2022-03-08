"""
N-Queen 문제는 크기가 N × N인 체스판 위에 퀸 N개를 서로 공격할 수 없게 놓는 문제이다.

N이 주어졌을 때, 퀸을 놓는 방법의 수를 구하는 프로그램을 작성하시오.
"""
def isValid(locate):
    for i in range(locate[0]):
        if table[i]==locate[1] or abs(i-locate[0])==abs(table[i]-locate[1]):
            #같은 열상에 있거나
            return False
    return True

def solution(round,table):
    global answer
    if round==n:
        answer+=1
        return
    else:
        for col in range(n):
            if isValid((round, col)):
                table[round]=col
                solution(round+1, table)

if __name__ =="__main__":
    n= int(input())
    table = [-1 for _ in range(n)]
    answer = 0
    solution(0,table)
    print(answer)



"""
=> 2차원 쓸 이유가 없다
왜냐하면 어차피 같은행 같은열에는 올 수 없음
그러니까 1차원으로 선언하자
예를들어 0,1에 있다하면 0번 인덱스에 1이 들어가 있다 생각하면 됨.
기본값은 -1로 초기화 하면 될듯
그렇게 해서 전체 다 돌려보면 될거같은뎅 
"""
