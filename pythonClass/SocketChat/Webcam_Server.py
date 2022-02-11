import socket
import cv2
import numpy
from queue import Queue 
from _thread import * 
import time
SERVER_WEBCAM = 0
def recvall(sock, count):
    buf = b'' 
    while count:
        newbuf = sock.recv(count) 
        if not newbuf: 
            return None 
        buf += newbuf
        count -= len(newbuf) 
    return buf

def video_sendto_client(client_socket, addr, queue):
    print('Server::connected to ({} : {})'.format(addr[0], addr[1])) 
    while True:
        try:
            if not queue.empty (): 
                stringData = queue.get()
                client_socket.send(str(len(stringData)).ljust(16).encode()) 
                client_socket.send(stringData)
        except ConnectionResetError as e: 
            break
    client_socket.close()

def video_chat_server(queue):
    server_webcam = cv2.VideoCapture(0+SERVER_WEBCAM) 
    while True:
        ret, serv_frame = server_webcam.read() 
        if ret == False:
            continue
        encode_param=[int(cv2.IMWRITE_JPEG_QUALITY),90]
        result, imgencode = cv2.imencode('.jpg', serv_frame, encode_param) 
        img_data = numpy.array(imgencode)
        stringData = img_data.tobytes() 
        queue.put(stringData)
        #cv2.imshow('Server:: Server_Video', serv_frame) 
        key = cv2.waitKey(1)
        if key == 27: # if ESC key is input, then exit 
            break

def video_recvfrom_client (client_socket):
    while True:
        try:
            length = recvall (client_socket, 16)
            if length==None:
                continue
            stringData = recvall(client_socket, int(length)) 
            data = numpy.frombuffer(stringData, dtype='uint8') 
            decimg=cv2.imdecode(data,1)
            cv2.imshow('Server:: Received from Client',decimg) 
            key = cv2.waitKey(1)
            if key == 27: # if ESC key is input, then exit 
                break
        except ValueError:
            pass

if __name__ == "__main__":
    enclosure_queue = Queue() 
    serverAddr = ''
    PORT = 9999
    hostname = socket.gethostname()
    serverAddr = socket.gethostbyname(hostname) 
    print("Server IP address = {}".format(serverAddr))
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM) 
    server_socket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1) #server_socket.bind((HOST, PORT))
    server_socket.bind((serverAddr, PORT)) 
    server_socket.listen()
    print('Server::Video chatting server started')
    start_new_thread(video_chat_server, (enclosure_queue,)) 
    print('Server::Waitint for client .... ')
    client_socket, addr = server_socket.accept()
    print('Server::connected to ({} : {})'.format(client_socket, addr))
    start_new_thread(video_sendto_client, (client_socket, addr, enclosure_queue,)) 
    start_new_thread(video_recvfrom_client, (client_socket,))
    #server_socket.close()
    while True:
        try:
            time.sleep(1)
        except KeyboardInterrupt:
            server_socket.close()
            break
