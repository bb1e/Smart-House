import sys,time,requests, msvcrt,os
import cv2 as cv
from datetime import datetime
import simpleaudio as sa
from face_detection import crop_faces




try :
    while True:
        x=crop_faces()
        
        camera = cv.VideoCapture(0, cv.CAP_DSHOW)
        #ret, image = camera.read()
        #print("Camera Ligada,Resultado da camera ="+str(ret))
        cv.waitKey(2000)
        cv.imwrite('face.jpg', x)
        print("Face recortada com sucesso!")
        camera.release()
        time.sleep(2)
            
   
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C

    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer

    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception

    print( "Fim do programa") 