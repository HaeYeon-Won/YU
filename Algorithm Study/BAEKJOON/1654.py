"""
집에서 시간을 보내던 오영식은 박성원의 부름을 받고 급히 달려왔다.
박성원이 캠프 때 쓸 N개의 랜선을 만들어야 하는데 너무 바빠서 영식이에게 도움을 청했다.
이미 오영식은 자체적으로 K개의 랜선을 가지고 있다. 그러나 K개의 랜선은 길이가 제각각이다.
박성원은 랜선을 모두 N개의 같은 길이의 랜선으로 만들고 싶었기 때문에 K개의 랜선을 잘라서 만들어야 한다.
예를 들어 300cm 짜리 랜선에서 140cm 짜리 랜선을 두 개 잘라내면 20cm는 버려야 한다. (이미 자른 랜선은 붙일 수 없다.)
편의를 위해 랜선을 자르거나 만들 때 손실되는 길이는 없다고 가정하며,
기존의 K개의 랜선으로 N개의 랜선을 만들 수 없는 경우는 없다고 가정하자.
그리고 자를 때는 항상 센티미터 단위로 정수길이만큼 자른다고 가정하자.
N개보다 많이 만드는 것도 N개를 만드는 것에 포함된다.
이때 만들 수 있는 최대 랜선의 길이를 구하는 프로그램을 작성하시오.
"""
from sys import stdin
def solution(LAN, need):
    start, end = 1, max(LAN)
    answer=[]
    while start<=end:
        mid=(start+end)//2
        val = sum([length//mid for length in LAN])
        if val>need:
            answer.append(mid)
            start=mid+1
        elif val<need:
            end=mid-1
        else:
            answer.append(mid)
            start = mid + 1
    return max(answer)

n, need = map(int,stdin.readline().split())
LAN= list(map(int,stdin.readlines()))
print(solution(LAN, need))

"""
stdin을 사용하여 입력을 받으니까 실행시간이 680ms에서 92ms로 감소하였다.
검색결과 input와 stdin.readline()의 차이가 발생하는 원인은

1) 두 함수간의 속도차이는 Prompt 출력여부

2) stdin.readline()은 한번에 읽어와 버퍼에  저장
  input()은 하나씩 누를 때마다 데이터를 버퍼에 보관
 
이다.

즉, 버퍼 사이즈 차이로 입력이 반복될 수록 stdin.readline()이 우위를 가진다.

실제 사용가능할지는 모르겠지만 사용가능하다면 가급적 stdin을 사용해야겠다.
"""
