"""
오픈채팅방
https://programmers.co.kr/learn/courses/30/lessons/42888
"""
from collections import deque
def solution(record):
    answer=[]
    data=deque()
    NickName = dict()
    for i in range(len(record)):
        now = list(map(str, record[i].split()))
        if len(now)==3:
            state, uID, nick = now[0], now[1], now[2]
            NickName[uID] = nick
        else:
            state, uID = now[0], now[1]
        data.append((state, uID))

    while data:
        state, uID = data.popleft()
        if state=='Enter': answer.append(NickName[uID] + '님이 들어왔습니다.')
        elif state=='Leave': answer.append(NickName[uID] + '님이 나갔습니다.')

    return answer


print(solution(["Enter uid1234 Muzi", "Enter uid4567 Prodo","Leave uid1234","Enter uid1234 Prodo","Change uid4567 Ryan"]))
