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
        self.win.title("Multi-thread-based Socket Chatting (TCP Server)")
        hostname = socket.gethostname()
        hostAddr = socket.gethostbyname(hostname)
        print("My (server) IP address = {}".format(hostAddr))
        self.myAddr = hostAddr
        self.createWidgets()
        # Start TCP/IP server in its own thread
        serv_thread = Thread(target=self.TCPServer, daemon=True)
        serv_thread.start()
        # TCP server

    def TCPServer(self):
        self.servSock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        self.servSock.bind((hostAddr, SocketChat_PortNumber))
        # bind socket to (IP_addr(local_host), port_number)
        self.scr_servDisplay.insert(INSERT,"TCP server is waiting for a client .... \n" )
        self.servSock.listen(1)
        self.conn, self.cliAddr = self.servSock.accept() # cliAddr : (IPaddr, port_no)
        print("TCP Server is connected to client ({})\n".format(self.cliAddr))
        self.scr_servDisplay.insert(INSERT,"TCP server is connected to client\n" )
        self.scr_servDisplay.insert(INSERT, "TCP client IP address : {}\n".format(self.cliAddr[0]))
        self.peerAddr_entry.insert(END, self.cliAddr[0])
        while True:
            servRecvMsg = self.conn.recv(512).decode()
            print("recv _msg = ", servRecvMsg)####################
            if not servRecvMsg:
                break
            self.scr_servDisplay.insert(INSERT,">> " + servRecvMsg)
        self.conn.close()
        #Exit GUI cleanly; definition of quit()

    def _quit(self):
        self.win.quit()
        self.win.destroy()
        exit()

    def serv_send(self): # from server send message to client
        msgToCli = str(self.scr_servInput.get(1.0, END))
        self.scr_servDisplay.insert(INSERT,"<< " + msgToCli)
        self.conn.send(bytes(msgToCli.encode()))
        print("send_msg = ", msgToCli) #################################
        self.scr_servInput.delete('1.0', END) #clear scr_msgInput scrolltext

    def createWidgets(self):
    # Add a frame in self.win
        frame = LabelFrame(self.win, text="Socket-based Text Message Chatting (TCP Server)")
        frame.grid(column=0, row=0, padx=8, pady=4)
        #Add a LabelFrame of myAddr, peerAddr, Connect Button in frame
        frame_addr = LabelFrame(frame, text=" ")
        frame_addr.grid(column=0, row=0, padx=40, pady=20, columnspan=2)
        # Add labels (myAddr, peerAddr) in the frame_addr_connect
        myAddr_label = Label(frame_addr, text="My(Server) Addr")
        myAddr_label.grid(column=0, row=0, sticky='W') #
        peerAddr_label = Label(frame_addr, text="Peer(Client) Addr")
        peerAddr_label.grid(column=1, row=0, sticky='W') #
        # Add a Textbox Entry widgets (myAddr, peerAddr) in the frame_addr_connect
        self.myAddr = StringVar()
        self.myAddr_entry = Entry(frame_addr, width=15, textvariable=self.myAddr)
        self.myAddr_entry.insert(END, hostAddr)
        self.myAddr_entry.grid(column=0, row=1, sticky='W')
        self.peerAddr = StringVar()
        self.peerAddr_entry = Entry(frame_addr, width=15, textvariable="")
        #self.peerAddr_entry.insert(END, LocalHost)
        self.peerAddr_entry.grid(column=1, row=1, sticky='W')
        # Add ScrolledText fields of display and input
        frame_serv_display = LabelFrame(frame, text="Socket Server Display")
        frame_serv_display.grid(column=0, row=1)
        scrol_w, scrol_h = 40, 20
        self.scr_servDisplay = scrolledtext.ScrolledText(frame_serv_display, width=scrol_w,
        height=scrol_h, wrap=WORD)
        self.scr_servDisplay.grid(column=0, row=2, sticky='E') #, columnspan=3
        frame_serv_text_input = LabelFrame(frame, text="Input Text Message (Server) :")
        frame_serv_text_input.grid(column=0, row=2)
        self.scr_servInput = scrolledtext.ScrolledText(frame_serv_text_input, width=40, height=3,
        wrap=WORD)
        self.scr_servInput.grid(column=0, row=0) #, columnspan=3
        # Add Buttons (cli_send, serv_send)
        serv_send_button = Button(frame_serv_text_input, text="Send Message to Client",
        command=self.serv_send)
        serv_send_button.grid(column=0, row=1, sticky='E')
        #Place cursor into the message input scrolled text
        self.scr_servInput.focus()
#======================
# Start GUI
#======================
print("Running TCP server")
sockChat = SocketChatting("server")
sockChat.win.mainloop()
