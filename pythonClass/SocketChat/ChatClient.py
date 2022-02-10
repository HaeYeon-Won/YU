import socket, sys, threading
from threading import Thread # for testing multi-thread
from time import sleep #for sleep in thread
from tkinter import *
from tkinter import ttk, scrolledtext, END
hostAddr = ""
SocketChat_PortNumber = 80
class SocketChatting:
    def __init__(self, mode):
        global hostAddr
        # Create instance
        self.win = Tk()
        self.mode = mode # server or client
        # Add a title
        self.win.title("Multi-thread-based Socket Chatting (TCP Client)")
        hostname = socket.gethostname()
        hostAddr = socket.gethostbyname(hostname)
        print("My (client) IP address = {}".format(hostAddr))
        self.myAddr = hostAddr
        self.createWidgets()
        cli_thread = Thread(target=self.TCPClient, daemon=True)
        cli_thread.start()

    # TCP client
    def TCPClient(self):
        self.cliSock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        servAddr_str = input("Server IP Addr (e.g., '127.0.0.1') = ")
        self.cliSock.connect((servAddr_str, SocketChat_PortNumber))
        # send connect request to TCP server
        servAddr = self.cliSock.getpeername()
        print("TCP Client is connected to server ({})\n".format(servAddr))
        self.scr_cliDisplay.insert(INSERT,"TCP client is connected to server \n")
        self.scr_cliDisplay.insert(INSERT,"TCP server IP address : {}\n".format(servAddr[0]) )
        self.servAddr_entry.insert(END, servAddr[0])
        while True:
            cliRecvMsg = self.cliSock.recv(8192).decode()
            print("recv _msg = ", cliRecvMsg)####################
            if not cliRecvMsg:
                break
            self.scr_cliDisplay.insert(INSERT,">> " + cliRecvMsg)
        self.cliSock.close()

    #Exit GUI cleanly; definition of quit()
    def _quit(self):
        self.win.quit()
        self.win.destroy()
        exit()

    #define callback for myMsg_enter()
    def cli_send(self): #from mySelf to peer/server
        msgToServer = str(self.scr_cliInput.get(1.0, END))
        self.scr_cliDisplay.insert(INSERT,"<< " + msgToServer)
        self.cliSock.send(bytes(msgToServer.encode()))
        print("send_msg = ", msgToServer) #################################
        self.scr_cliInput.delete('1.0', END) #clear scr_msgInput scrolltext

    def createWidgets(self):
        # Add a frame in self.win
        frame = LabelFrame(self.win, text="Socket-based Text Message Chatting (TCP Client)")
        frame.grid(column=0, row=0, padx=8, pady=4)
        #Add a LabelFrame of myAddr, peerAddr, Connect Button in frame
        frame_addr = LabelFrame(frame, text="")
        frame_addr.grid(column=0, row=0, padx=40, pady=20, columnspan=2)
        # Add labels (myAddr, peerAddr) in the frame_addr_connect
        myAddr_label = Label(frame_addr, text="My(Client)Addr")
        myAddr_label.grid(column=0, row=0, sticky='W') #
        peerAddr_label = Label(frame_addr, text="Peer(Server) Addr")
        peerAddr_label.grid(column=1, row=0, sticky='W') #
        # Add a Textbox Entry widgets (myAddr, peerAddr) in the frame_addr_connect
        self.myAddr = StringVar()
        self.myAddr_entry = Entry(frame_addr, width=15, textvariable=self.myAddr)
        self.myAddr_entry.insert(END, hostAddr)
        self.myAddr_entry.grid(column=0, row=1, sticky='W')
        self.servAddr = StringVar()
        self.servAddr_entry = Entry(frame_addr, width=15, textvariable="")
        #self.servAddr_entry.insert(END, LocalHost)
        self.servAddr_entry.grid(column=1, row=1, sticky='W')
        # Add ScrolledText fields of display and input
        frame_cliDisplay = LabelFrame(frame, text="Socket Client Display")
        frame_cliDisplay.grid(column=0, row=1)
        scrol_w, scrol_h = 40, 20
        self.scr_cliDisplay = scrolledtext.ScrolledText(frame_cliDisplay, width=scrol_w,
        height=scrol_h, wrap=WORD)
        self.scr_cliDisplay.grid(column=0, row=0, sticky='WE') #, columnspan=3
        frame_cliTextInput = LabelFrame(frame, text="Input Text Message (Client) :")
        frame_cliTextInput.grid(column=0, row=2 )
        self.scr_cliInput = scrolledtext.ScrolledText(frame_cliTextInput, width=40,
        height=3, wrap=WORD)
        self.scr_cliInput.grid(column=0, row=0) #, columnspan=3
        # Add Buttons (cli_send, serv_send)
        cli_send_button = Button(frame_cliTextInput, text="Send Message to Server",
        command=self.cli_send)
        cli_send_button.grid(column=0, row=1, sticky='E')
        #Place cursor into the message input scrolled text
        self.scr_cliInput.focus()
#======================
# Start GUI
#======================
print("Running TCP Client")
sockChat = SocketChatting('client')
sockChat.win.mainloop()
