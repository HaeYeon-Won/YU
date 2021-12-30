2. """
3. Project : Hw1.1
4. Autor : Hae-Yeon-Won
5. Date of last update : 2021.09.04
6. input args : int width, length
7. output result : Draw Ractangular
8. """
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
