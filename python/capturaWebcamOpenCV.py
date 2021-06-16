import cv2 as cv
import requests
import time,sys



def send_to_api():
    url='http://127.0.0.1/SmartHouse/upload.php/post'
    files = {'file': open('webcam.jpg', 'rb')}
    r = requests.post(url,files= files)
    print(r.text)
    print(r.status_code)



try:
            camera = cv.VideoCapture(0)
            ret, image = camera.read()
            print("Camera Ligada,Resultado da camera ="+str(ret))
            cv.waitKey(1000)
            cv.imwrite('webcam.jpg', image)
            camera.release()
            send_to_api()
            print("Camera desligada")

            
                  
      
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")
except:
    print( "Ocorreu um erro:", sys.exc_info() )
finally:
    print( "Fim do programa")
