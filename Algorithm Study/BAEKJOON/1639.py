"""
프로야구단 다숌 자이언츠에서는 야구장에 오는 손님에게 티켓을 나누어준다. 그리고 나서 그 티켓 중에 다음과 같은 규칙을 가진 티켓을 행운의 티켓이라고 하며, 
그 티켓을 가진 사람들에게 상품을 나누어준다.

행운의 티켓은 정확하게 2N자리로 이루어진 티켓이다. 왼쪽 N자리의 합과 오른쪽 N자리의 합이 일치하면 그 티켓은 행운의 티켓이라고 한다.

숌은 티켓 번호를 조작하려고 한다. 어떤 문자열이 주어지면, 그 문자열의 연속된 부분 문자열중 행운의 티켓 규칙을 만족하는 최대 부분 문자열의 길이를 출력하는 프로그램을 작성하시오. 
"""
def lucky_ticket(mid, offset):
    head,tail=lucky[mid-1::-1],lucky[mid:mid+offset]
    loop=min(len(head), len(tail))
    length=0
    Hsum, Tsum=0,0
    for i in range(loop):
        Hsum+=int(head[i])
        Tsum+=int(tail[i])
        if Hsum==Tsum:
            length=(i+1)*2
    return length


lucky=input()
l=len(lucky)
if l==1 or l==0:
    print(0)
else:
    L=[]
    for i in range(1,l):
        L.append(lucky_ticket(i,i))
    print(max(L))
    """
    효율성이 별로 좋지못하게 작성한것 같다.
    기존방식 : 리스트를 슬라이싱해서 길이가 짧은것 만큼 반복
    => 리스트의 길이를 처음부터 같게 잘라온 다음 각각의 합을 구해서 처리하면 더 빠를것 같다.
    (매 시행마다 길이계산 필요 x, 합계값, 길이값 반복적으로 변동 x 이므로)
    """
