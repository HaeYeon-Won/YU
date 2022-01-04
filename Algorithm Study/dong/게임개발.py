"""
1. 현재 위치에서 현재 방향을 기준으로 왼쪽 방향 (반시계 방향으로 90도 회전한 방향) 부터 차례대로 갈 곳을 정한다.
2. 캐릭터의 바로 왼쪽 방향에 아직 가보지 않은 칸이 없다면, 왼쪽 방향으로 회전만 수행하고 1단계로 돌아간다.
3. 만약 네 방향 모두 이미 가본 칸이거나 바다로 되어있는 칸인 경우에는 ,바라보는 방향을 유지한 채로 한칸 뒤로 가고 1단계로 돌아간다.
단 이때 뒤쪽 방향이 바다인 칸이라 뒤로 갈 수 없는 경우에는 움직임을 엄춘다.
캐릭터가 방문한 칸의 수는?
단 육지는 0, 바다는 1
"""
from sys import stdin
def solution(n,m,pos,mtrx):
    see=[(-1,0),(0,1),(1,0),(0,-1)] # 움직이는 방향
    next=pos[2]+1 #처음 반시계 돌린 위치
    r, c = pos[0], pos[1] #초기 위치
    path=[] #이동했었던 경로
    count=0 #얼만큼 돌았는지 판단하기 위해 설정
    answer=0 
    while True:
        row, col = r+see[next][0], c+see[next][1] #원래 위치 + 바라보고있는 방향으로 1칸 이동
        if count==4: # 만약 4방향 다 돌아봤는데 더이상 움직일 위치가 없다면
            row, col = r + see[(next+2)%4][0], c + see[(next+2)%4][1] #바라보고있는 반대방향으로 한칸 이동
            if (row, col) in path or mtrx[row][col]==1: # 이동한 칸이 이미 이동 했던칸 이거나 바다라면 loop 탈출
                break
        if mtrx[row][col]==0: #육지
            if (row, col) in path: # 이미 방문한 장소라면 이동만
                r, c = row, col
                count+=1
            else: # 이동하지 않은 경우
                r, c = row, col
                answer+=1
                count=0
                path.append((r, c)) #경로에 방문했던 위치를 기록
        elif mtrx[row][col]==1: # 바다
            next = (next + 1) % 4 #바라보는 방향 변경
            count += 1
    return answer



if __name__=='__main__':
    n,m=map(int, stdin.readline().split())
    pos=list(map(int, stdin.readline().split()))
    mtrx=[]
    for _ in range(n): mtrx.append(list(map(int, stdin.readline().split())))
    print(solution(n,m,pos,mtrx))
    
"""
뭔가 틀린거같은데?
"""
