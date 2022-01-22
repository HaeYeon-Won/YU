"""
        7
      3   8
    8   1   0
  2   7   4   4
4   5   2   6   5
위 그림은 크기가 5인 정수 삼각형의 한 모습이다.
맨 위층 7부터 시작해서 아래에 있는 수 중 하나를 선택하여 아래층으로 내려올 때, 이제까지 선택된 수의 합이 최대가 되는 경로를 구하는 프로그램을 작성하라.
아래층에 있는 수는 현재 층에서 선택된 수의 대각선 왼쪽 또는 대각선 오른쪽에 있는 것 중에서만 선택할 수 있다.
삼각형의 크기는 1 이상 500 이하이다. 삼각형을 이루고 있는 각 수는 모두 정수이며, 범위는 0 이상 9999 이하이다.
"""
import sys
def solution():
    for i in range(len(tri)-2, -1,-1):
        for j in range(len(tri[i])):
            tri[i][j]=max(tri[i][j]+tri[i+1][j], tri[i][j]+tri[i+1][j+1])
    print(tri[0][0])
n= int(sys.stdin.readline())
tri = [list(map(int, sys.stdin.readline().split())) for _ in range(n)]
solution()

"""
바텀업 방식으로 구현하였음.
삼각형의 높이가 n인 경우 n-1부터 최대값으로 갱신
이후 최상단층을 출력하면 계산할 수 있는 최대값이 나온다.
"""
