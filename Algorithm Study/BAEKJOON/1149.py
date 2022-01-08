"""
RGB거리에는 집이 N개 있다. 거리는 선분으로 나타낼 수 있고, 1번 집부터 N번 집이 순서대로 있다.
집은 빨강, 초록, 파랑 중 하나의 색으로 칠해야 한다. 각각의 집을 빨강, 초록, 파랑으로 칠하는 비용이 주어졌을 때,
아래 규칙을 만족하면서 모든 집을 칠하는 비용의 최솟값을 구해보자.
1번 집의 색은 2번 집의 색과 같지 않아야 한다.
N번 집의 색은 N-1번 집의 색과 같지 않아야 한다.
i(2 ≤ i ≤ N-1)번 집의 색은 i-1번, i+1번 집의 색과 같지 않아야 한다.
"""
def solution(size, mtrx):
    dP=[[0 for _ in range(3)] for _ in range(size)] #dP 테이블 초기화
    dP[0][0], dP[0][1], dP[0][2] = mtrx[0][0], mtrx[0][1], mtrx[0][2]
    L=[(1,2),(0,2),(0,1)] # 중복 색상 선택 방지
    for i in range(1, size):
        for j in range(3):
            dP[i][j]=min(mtrx[i][j]+dP[i-1][L[j][0]], mtrx[i][j]+dP[i-1][L[j][1]]) 
    print(min(dP[-1]))

size  = int(input())
mtrx=[list(map(int, input().split())) for _ in range(size)]
anwser=[]
solution(size, mtrx)
