"""
동빈이네 전자 매장에는 부품이 N개 있다. 각 부품은 정수 형태의 고유한 번호가 있다.
어느 날 소님이 M개 종류의 부품을 대량으로 구매하겠다며 당일 날 견적서를 요청했다.
동빈이는 때를 놓치지 않고 손님이 문의한 부품 M개 종류를 모두 확인해서
견적서를 작성하해야한다. 이때 가게안에 부품이 모두 있는지 확인하는 프로그램을 작성하자
"""
def solution(n, m, numbers, order):
    answer=[]
    numbers.sort()
    for key in order:
        flag=len(answer)
        start, end = 0, len(numbers) - 1
        while start<=end:
            mid=(start+end)//2
            val=numbers[mid]
            if val>key: end=mid-1
            elif val<key: start=mid+1
            elif val==key:
                answer.append('yes')
                break
        if flag==len(answer):
            answer.append('no')
    return "".join(i+" " for i in answer)


n=int(input())
numbers=list(map(int, input().split()))
m=int(input())
orders=list(map(int, input().split()))
print(solution(n,m,numbers, orders))
