"""
https://programmers.co.kr/learn/courses/30/lessons/42889
"""
def solution(N, stages):
    clear=[0 for _ in range((max(stages)+1))]
    for i in stages: clear[i]+=1
    lose_rate=[]
    for i in range(1, N+1):
        div=sum(clear[i:])
        if div==0:lose_rate.append([i, 0])
        else:lose_rate.append([i, clear[i]/sum(clear[i:])])
    lose_rate=sorted(lose_rate, key=lambda x:x[1], reverse=True)
    return list(zip(*lose_rate))[0]
  
  """
  처음에는 스테이지에 도달한 경우 0으로 나누어지는것을 고려하지 않았다.
  """
