"""
정수 X에 사용할 수 있는 연산은 다음과 같이 세 가지 이다.

X가 3으로 나누어 떨어지면, 3으로 나눈다.
X가 2로 나누어 떨어지면, 2로 나눈다.
1을 뺀다.
정수 N이 주어졌을 때, 위와 같은 연산 세 개를 적절히 사용해서 
1을 만들려고 한다. 연산을 사용하는 횟수의 최솟값을 출력하시오.
"""
def make_one(num):
    answer=[num for _ in range(num+1)] #테이블 생성
    answer[-1]=0 #시작시 시행횟수는 0이므로 초기화
    for i in range(len(answer)-1,0,-1):
        """
        1을 빼거나, 2또는 3을 나누거나
        총 세가지를 시행해 보면서 연산량이 가장 적은것으로 테이블을 초기화
        """
        answer[i-1]=min(answer[i]+1, answer[i-1]
        if i%2==0: answer[i//2]=min(answer[i]+1, answer[i//2])
        if i%3==0: answer[i//3]=min(answer[i]+1, answer[i//3])
    
    return answer[1]

n=int(input())
print(make_one(n))
