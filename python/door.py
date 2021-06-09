from datetime import datetime
#import keyboard
import sys,time,requests, msvcrt
url="http://127.0.0.1/SmartHouse/api/api.php"

def datahora():
    
    now = datetime.now()
    x = now.strftime("%d/%m/%Y %H:%M:%S")
    return x
def send_to_api(url,pload):
    url="http://127.0.0.1/SmartHouse/api/api.php"
    requests.post(url,data = pload)
########################## Codigo principal #########################
try:
    
    ## para sair spamar ctrl +
    while True:
        char = msvcrt.getwch()
        if(char != None):
            if(char == "1"):
                print("open")
                pload = {'value':'1','name':'door','date':datahora()}
                send_to_api(url,pload)
                time.sleep(2)
            elif(char == "0"):
                print("closed")
                pload = {'value':'0','name':'door','date':datahora()}
                send_to_api(url,pload)
                time.sleep(2)
            else:
                time.sleep(2)
                print("invalid")
                
    
    
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C

    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer

    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception

    print( "Fim do programa") 
 