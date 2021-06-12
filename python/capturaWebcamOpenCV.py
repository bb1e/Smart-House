import cv2 as cv
import requests
import time,sys


def send_to_api():
    url='http://127.0.0.1/SmartHouse/upload.php/post'
    files = {'file': open('webcam.jpg', 'rb')}
    r = requests.post(url,files= files)
    print(r.text)
    print(r.status_code)
def get_from_api():
    url='http://127.0.0.1/SmartHouse/api/api.php?name=temperature'
    #files = {'name':'temperature','v' }
    r = requests.get(url)
    print(r.status_code)
    print(r.text)
    return float(r.text)

try:
    x= get_from_api()
    while True:
        if(x > 3):
            camera = cv.VideoCapture(0, cv.CAP_DSHOW)
            ret, image = camera.read()
            print("Camera Ligada,Resultado da camera ="+str(ret))
            cv.waitKey(5000)
            cv.imwrite('webcam.jpg', image)
            camera.release()
            send_to_api()
            print("Camera desligada")
            
        else:
            print("Temperatura abaixo de 10, fotografia não foi tirada")
            
      
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")
except:
    print( "Ocorreu um erro:", sys.exc_info() )
finally:
    print( "Fim do programa")
