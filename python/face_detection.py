import cv2
ESC=27

def crop_faces():
    # carrega o modelo treinado
    face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
    # inicializa o systema de video para captura 
    cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)

    while True:
        # Captura um frame
        _, img = cap.read()
        # Converte para escala de cinza
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        # Detecta as caras
        faces = face_cascade.detectMultiScale(gray, 1.1, 4)
        # Desenha um rectanculo em cada cara
        for (x, y, w, h) in faces:
            cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 0), 2)
        # Janela de video com o resultado
        cv2.imshow('face.jpg', img)
        
        
        # Termina com ESC pressionado
        k = cv2.waitKey(30) & 0xff
        if(k == ESC):
            break

    # recorta a cara na imagem -> roi (Region Of Interest) ***
    # código do crop aqui
    # x e y inicio do rectangulo da cara
    # w (width) e h (height) os tamanhos do rectangulo da cara
    cv2.imread('face.jpg')
    roi=img[y:y+h, x:x+w]

    # SINTAXE: 
    # roi = img[ <y inicial> : <y final> , <x inicial> : <x final> ] 
    # EXEMPLO DE UM CORTE DE UMA IMAGEM COM 100 PIXEIS DE ALTURA E 200 PIXEIS DE LARGURA NA POSIÇÃO X=0, Y=0
    # roi = img[0:100,0:200] 
    
    

    # Termina o systema de video
    cap.release()
    cv2.destroyAllWindows()
    
    return roi