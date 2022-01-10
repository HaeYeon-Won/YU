"""
개미전사는 식량창고를 선택적으로 약탈하여 식량을 빼앗을 예정이다. 이때 메뚜기 정찰병들은 일직선상에 존재하는
식량창고 중에서 최소한 한 칸 이상 떨어진 식량창고를 약탁해야한다. 예를 들어 식량창고 4개가 다음과 같이 존재한다고 가정하자
1 3 1 5
ㅇ;떼 개미전사는 두 분째 식량 창고와 네 번째 식량 창고를 선택했을 때 최댓값은 8개의 식량을 빼앗을 수 있다.
창고 N개에 대한 정보가 주어졌을 때 얻을 수 있는 식량의 최댓값은?
."""
def solution(n, contain):
    dP=[0 for _ in range(n)]
    dP[0], dP[1]= contain[0], contain[1]
    for i in range(2,n):
        dP[i]=max(dP[i-1], contain[i]+dP[i-2])
        print(dP)

n=int(input())
contain=list(map(int, input().split()))
solution(n, contain)

"""
최소한 한칸씩 띄워서 방문해야 하므로
만약 i번째를 방문한다하면 (i-1)번째까지 약탈한 식량과 (i번째 창고의 식량 + i-2번째 까지 약탈한 식량) 중 
더 큰 식량을 약탈해 오면 된다.
만약 최소 n칸씩 띄워서 방문해야하는 경우는
dP 테이블에는 n번 인덱스 까지 contain의 값을 채워놓고
dP[i]의 값은 max(dP[i-(n+1)+contain[i], dP[i-n] . . .  , dP[i-1])가 될것이다.

"""
