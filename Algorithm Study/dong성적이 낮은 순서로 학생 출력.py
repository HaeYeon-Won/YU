"""
N명의 학생 정보가 있다. 학생 저보는 학생의 이름과 학생의 성적으로 구분된다. 각학생의 이름과 성적 정보가
주어졌을 때 성적이 낮은 순서대로 학생의 이름을 출력하는 프로그램을 작성하시오
"""
def solution(arr):
    result=sorted(arr, key=lambda x : int(x[1]))
    return "".join(i[0]+" " for i in result)

num=int(input())
std=[list(map(str, input().split())) for _ in range(num)]
print(solution(std))
