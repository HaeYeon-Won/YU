"""
- Project : Detect car license-plate Client 
- 일정거리이상 차량이 접근하면 사진을 찍어 Server에 전송 밑 음성 경고
- Author : Hae-Yeon-Won
- Date of last update : 2021.12.31.
"""
from serial import Serial
import cv2
import socket
import struct
import pickle
import time
import os
import pygame
import pigpio
from time import sleep

pygame.init()
pygame.mixer.init()

pi=pigpio.pi()

def Servo_Angle(pin, angle):
    """
    Servo motor 각도를 제어
    """
    ang=600+(10*angle) #0~180도 사이로 각도를 조절
    pi.set_servo_pulsewidth(pin, ang) # 해당 각도로 이동
    sleep(0.1)

def speak(txt):  # 음성 파일 재생
    filename=txt+'.mp3'
    pygame.mixer.music.load(filename)
    pygame.mixer.music.play()
    time.sleep(8)

def getTFminiData(ser): # TF mini lidar 거리 측정
    while True:
        count = ser.in_waiting #buffer에 data가 9개 넘어갈때까지 대기
        if count > 8:
            recv = ser.read(9) # 버퍼에 담긴 data를 읽어옴
            ser.reset_input_buffer() # 버퍼 reset
            if recv[0] == 0x59 and recv[1] == 0x59: # 0x59 is 'Y', 정상적으로 값을 읽어온 경우
                distance=recv[2]+recv[3]*256 # 거리계산
                ser.reset_input_buffer()
                #print(distance)
                return distance

def socketsend(client_socket): # 사진 전송
    camera = cv2.VideoCapture(0) #사진 촬영
    camera.set(cv2.CAP_PROP_FRAME_WIDTH, 640) #사진 너비 설정
    camera.set(cv2.CAP_PROP_FRAME_HEIGHT, 480)# 사진 높이 설정

    encode_param = [int(cv2.IMWRITE_JPEG_QUALITY), 90]

    ret, frame = camera.read()
    data = pickle.dumps(frame, 0) #프레임을 직렬화 하여 전송 준비
    size = len(data) #메시지 길이측정
    client_socket.sendall(struct.pack(">L", size) + data) #압축된 데이터 크기와, 데이터를 전송
    print('전송 완료')
    camera.release()

if __name__ == '__main__':
    ip= ''  #ip 주소
    port = 8080  #port 번호
    #소켓 연결
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client_socket.connect((ip,port))
    client_socket.send('1/init'.encode())
    print('연결 성공')
    ser = Serial("/dev/ttyUSB0", 115200)
    count = 0
    data=''
    angle=[90,120,110,100,90,60,70,80,90] # servo moter 각도 
    if ser.is_open == False:
        print("serial not open")
        ser.open()
    i=0
    while True:
        try:
            first_detect = getTFminiData(ser)
            if(first_detect < 85):
                if(count == 0):
                    client_socket.send('1/picture'.encode())
                    socketsend(client_socket)
                    data=client_socket.recv(1024).decode()

                    if data != 'retransmit': # 재전송 요청을 받지 않았을 경우. 즉, 정상적으로 전송 된 경우
                        Servo_Angle(17,90) # 각도를 원래대로 변환
                        i = 0
                        if data=='valid': # 장애인 전용 주차 구역 위반 차량이 아닌 경우 차량이 나갈 때까지 대기
                            count=2
                        else:             # 장애인 전용 주차 구역 위반 차량인 경우
                            count = 1
                    else:  # 재전송 요청을 받았을 경우
                        Servo_Angle(17,angle[i%len(angle)]) #각도를 변환해 가면서 새로운 사진 측정
                        i+=1
                elif(data== 'invalid' and count ==1):
                    speak('INVALID')  #음성 파일 실행
                    time.sleep(300)   #5분 경과
                    print('5분 경과')
                    while True:
                        second_detect = getTFminiData(ser)
                        if(second_detect < 85):   # 5분 경과 후 차량이 최소 거리안에 있을 경우
                            client_socket.send('1/picture'.encode()) 
                            socketsend(client_socket) # 사진 촬영 후 전송
                            data=client_socket.recv(1024).decode() # 해당 차량의 data를 받아온다 
                            if(data == 'retransmit'): # 재전송 요청을 받았을 경우
                                Servo_Angle(17,angle[i%len(angle)])
                                i+=1
                                continue
                            else: # 재전송 요청을 받지 않았을 경우. 즉, 정상적으로 전송 된 경우
                                Servo_Angle(17,90) # 각도를 원래대로 변환, 차량이 나갈 때까지 대기
                                i = 0
                                count=2
                                break
 
            elif(count==2 and first_detect>85):  # 차량이 나갔을 경우
                Servo_Angle(17,90) # 카메라 각도를 원래대로 조절
                i = 0
                data = '' # data 값 초기화
                count = 0

        except KeyboardInterrupt:   # Ctrl+C
            if ser != None:
                ser.close()
