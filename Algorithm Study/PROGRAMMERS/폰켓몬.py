"""
문제링크 https://programmers.co.kr/learn/courses/30/lessons/1845
"""
def solution(nums):
    size=len(nums)//2 #가져갈 수 있는 숫자
    nums=set(nums) #중복제거
    nums=list(nums)
    if len(nums)<=size: return len(nums) #중복제거 후 남아있는 종류보다 가져갈수 있는 숫자가 적다면 현재 중복제거된 길이 반환
    else: return size #아닌경우 사이즈 
