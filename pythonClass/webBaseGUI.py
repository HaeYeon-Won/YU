from tkinter import *
from flask import Flask, render_template, request
import time
import json
from threading import Thread
RED_VAL, BLUE_VAL, GREEN_VAL = 0, 0, 0
print("WebBase GUI control")
print()
webRemoteControlServer = Flask(__name__)

@webRemoteControlServer.route("/")
def index():
    return render_template('rc_COLOR_index.html')

@webRemoteControlServer.route("/rc_Color", methods=["POST"])
def request_data():
    global RED_VAL, GREEN_VAL, BLUE_VAL, app
    cmd=request.form.get("rc_Color")
    color, value = cmd.split()
    print("color = {}, value = {}".format(color, value))
    value =int(value)
    if color=="red":
        RED_VAL = value
        app.updateRed(value)
    elif color=="green":
        GREEN_VAL = value
        app.updateGreen(value)
    elif color=="blue":
        BLUE_VAL = value
        app.updateBlue(value)
    return json.dumps({'status':'OK'})

@webRemoteControlServer.route("/reset_Color", methods=["POST"])
def reset_LED():
    global RED_VAL, GREEN_VAL, BLUE_VAL
    cmd=request.form.get("reset_Color")
    red_value, green_value, blue_value = cmd.split()
    print("red = {}, green = {}, blue = {}".format(red_value, green_value, blue_value))
    RED_VAL=0
    GREEN_VAL = 0
    BLUE_VAL = 0
    return json.dumps({'status':'OK'})
class App:
    def __init__(self, win): 
        frame = Frame(win) 
        frame.pack()
        Label(frame, text="Checking RGB Color Combination").grid(row=0, column=0, columnspan=3)

        Label(frame, text='Red').grid(row=1, column=0)
        Label(frame, text='Green').grid(row=2, column=0)
        Label(frame, text='Blue').grid(row=3, column=0)
        self.red_var = IntVar()
        self.green_var = IntVar()
        self.blue_var = IntVar()
        self.red = 0
        self.green = 0
        self.blue = 0
        Entry(frame, textvariable=self.red_var, justify='right').grid(row=1, column=2)
        Entry(frame, textvariable=self.green_var, justify='right').grid(row=2, column=2)
        Entry(frame, textvariable=self.blue_var, justify='right').grid(row=3, column=2)
        self.canvas = Canvas(win, bg="grey70", width=300, height=200)
        self.canvas.pack()
        self.oval = self.canvas.create_oval(10, 10, 290, 190, fill="white", width=3) 
        color = "#%02x%02x%02x"%(self.red, self.green, self.blue)
        self.canvas.itemconfig(self.oval, fill=color)
    

    def updateRed(self, duty): 
        global RED_VAL
        self.red = int(RED_VAL)
        self.red_var.set(int(RED_VAL))
        color = "#%02x%02x%02x"%(self.red, self.green, self.blue) 
        self.canvas.itemconfig(self.oval, fill=color)

    def updateGreen(self, duty): 
        global GREEN_VAL
        self.green = int(GREEN_VAL)
        self.green_var.set(int(GREEN_VAL))
        color = "#%02x%02x%02x"%(self.red, self.green, self.blue) 
        self.canvas.itemconfig(self.oval, fill=color)

    def updateBlue(self, duty): 
        global BLUE_VAL
        self.blue = int(BLUE_VAL)
        self.blue_var.set(int(BLUE_VAL))
        color = "#%02x%02x%02x"%(self.red, self.green, self.blue) 
        self.canvas.itemconfig(self.oval, fill=color)

def main():                  
    webRemoteControlServer.run(host="165.229.185.243", port=8080, debug=False)
def gui():
    global app
    window = Tk()
    window.geometry("400x400")
    window.wm_title('Color Selection Sliders') 
    app = App(window)
    window.mainloop()
    

thr1=Thread(target = main, args=())
thr2=Thread(target = gui, args = ())
thr1.start()
thr2.start()
thr1.join()
thr2.join()
