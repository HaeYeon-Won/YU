"""
손님이 왔을 때 요청한 총 길이가 M일 때 적어도 M만큼의 떡을 얻기 위해 절단기에 설정할 수 있는 높이의 최댓값을 구하는 프로그램
"""
def solution(n, m, dduck):
    dduck.sort()
    start, end = 0, dduck[-1]
    while start<=end:
        mid =(start+end)//2
        result = sum([i-mid for i in dduck if (i-mid)>0])
        if result>m: start=mid+1
        elif result<m: end=mid-1
        elif result==m: return mid


n, m = map(int, input().split())
dduck=list(map(int, input().split()))
print(solution(n,m,dduck))
