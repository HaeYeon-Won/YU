"""
하나의 수열에는 다양한 수가 존재한다. 이러한 수는 크기에 상관없이 나열되어 있다.
이 수 를 큰 수 부터 작은 수 순서로 정렬해야 한다. 수열을 내림차순으로 정렬하는 프로그램을 만드시오.
"""
def quick_sort(arr):
    if len(arr) <= 1:
        return arr
    pivot = arr[len(arr) // 2]
    lesser_arr, equal_arr, greater_arr = [], [], []
    for num in arr:
        if num < pivot:
            lesser_arr.append(num)
        elif num > pivot:
            greater_arr.append(num)
        else:
            equal_arr.append(num)
    return quick_sort(greater_arr) + equal_arr + quick_sort(lesser_arr)


num=int(input())
numbers=[int(input()) for _ in range(num)]
print(quick_sort(numbers))
