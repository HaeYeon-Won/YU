"""
행복 왕국의 왕실 정원은 체스판과 같은 8 * 8 좌표 평면이다. 왕실 정원의 특정한 한칸에 나이트가 서있다.
나이트는 매우 충성스러운 신하로서 매일 무술을 연마하나다.
나이트는 말을 타고 있기 때문에 이동할 때는 L자 형태로만 이동할 수 있으며 정원 밖으로는 나갈 수 없다.
나이트는 특정한 위치에서 다음과 같은 2가지 경우로 이동할 수 있다.
1. 수평으로 두칸 이동한 뒤 수직으로 한칸 이동하기
2. 수직으로 두 칸 이동한 뒤에 수평으로 한 칸 이동하기
나이트가 이동할 수 있는 경우의 수를 출력하시오
"""
from sys import stdin
def solution(n):
    r, c = int(n[1])-1, ord(n[0])-ord('a')
    direction=[(1,2), (1,-2), (-1,2), (-1,-2), (2,-1),(2,1),(-2,-1),(-2,1)]
    answer=0
    for pos in direction:
        x, y=r+pos[0], c+pos[1]
        if (x>-1 and x<8) and (y>-1 and y<8):
            answer+=1
    return answer

if __name__=='__main__':
    n=stdin.readline()
    print(solution(n))
