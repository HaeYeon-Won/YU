""“
Procedure DrawRactangular
Project : Hw1.1
Autor : Hae-Yeon-Won
Date of last update : 2021.09.04
input args : int width, length
output result : Draw Ractangular
"""
import turtle as t
for i in range(4):
    if (i%2==0):
        t.forward(width)
    else:
        t.forward(length)
    t.right(90)
#end for
t.done()
#end
