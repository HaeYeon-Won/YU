"""
N×M크기의 직사각형이 있다. 각 칸에는 한 자리 숫자가 적혀 있다. 이
 직사각형에서 꼭짓점에 쓰여 있는 수가 모두 같은 가장 큰 정사각형을 찾는 프로그램을 작성하시오.
이때, 정사각형은 행 또는 열에 평행해야 한다.
"""
def solution(row, col, arr):
    """
    정사각형의 조건 : 길이가 같아야한다, 모든 내각은 90도
    => 같은행에 최소 하나있어야하고, 같은열에 최소 하나 있어야함.
    => 이렇게 만든 사각형의 모든 변의 길이가 같아야함.
    """
    rectangle={'0':[],'1':[],'2':[],'3':[],'4':[],'5':[],'6':[],'7':[],'8':[],'9':[]}
    for i in range(row):
        for j in range(col):
            #각각 숫자의 좌표를 저장
            rectangle[arr[i][j]].append([i,j])
    rectangle = [value for value in rectangle.values() if len(value) >= 4] #만약 좌표가 4개이하(사각형 생성 x)인것을 제외
    max_area=1
    limit=min(row, col) #row, col 의 길이중 더 작은것이 사각형의 최대 길이
    for pos in rectangle:
        """
        하나를 뽑아왔을때 => 같은 행, 열에 있고 길이가 같은가
        """
        for i in range(len(pos)):
            LU = pos[i]  # Left Up
            for k in range(1, limit):#길이를 1씩 증가시켜가며 탐색
                if LU[0]+k>=row or LU[1]+k>=col:#배열의 범위를 넘어가면 break
                    break
                RU = [LU[0], LU[1]+k] #Right Up
                LD = [LU[0]+k, LU[1]] #Left Down
                RD = [LU[0]+k, LU[1]+k] #Right Down
                if (RU in pos) and (LD in pos) and (RD in pos): #만약 길이가 k 인 정사각형이 존재 한다면.
                    max_area=max(max_area, (k+1)**2) #기존 넓이와 현재 넓이중 큰 값으로 갱신
    return max_area


if __name__=="__main__":
    row, col = map(int, input().split())
    arr = []
    for _ in range(row):
        temp=input()
        arr.append(temp)
    print(solution(row, col, arr))
    
"""
제출 성공은 했지만 시간, 메모리가 너무 많이 소모된다.
전체 배열을 비교하는것 보다 특정 조건을 만족하는 배열만을 가지고 
조건이 맞는것들을 찾는게 더 효율적이라 생각하였지만 이 과정때문에
더 부하가 많이 걸린것 같다.
"""
