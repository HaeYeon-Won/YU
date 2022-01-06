"""
손님이 왔을 때 요청한 총 길이가 M일 때 적어도 M만큼의 떡을 얻기 위해 절단기에 설정할 수 있는 높이의 최댓값을 구하는 프로그램
"""
def solution(n, m, dduck):
    start, end = 0, max(dduck)
    answer=0
    while start<=end:
        mid =(start+end)//2
        result = 0
        for i in dduck:
            if i>mid: result+=(i-mid)
        if result<m: end=mid-1
        else:
            answer=mid
            start=mid+1
    return answer

n, m = map(int, input().split())
dduck=list(map(int, input().split()))
print(solution(n,m,dduck))
