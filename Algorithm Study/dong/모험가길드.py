"""
첫쨰 줄에 모험가의 수 N이 주어집니다.
둘쨰줄에 각 모험가의 공포도의 값을 N이하의 자연수로 주어지며, 각 자연수는 공백으로 구분합니다.

출력
여행을 떠날 수 있는 그룹 수으,ㅣ 최댓값을 입력합니다.
"""

def solution():
     traveler.sort()
     result=0
     q=[]
     for i in traveler:
         q.append(i)
         if q[-1]<=len(q):
             result+=1
             q=[]
     print(result)


N= int(input())
traveler=list(map(int, input().split()))
solution()
