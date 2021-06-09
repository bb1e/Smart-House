autores: Bruna Bastos Leal (2201732)
		 Rafael Pereira Barroso (2201697)


Dashboard para casa inteligente

=> página login (index.php)

	utilizadores:
	- user: Bruna  password: 12345
	- user: Rafael  password: 54321
	
	o código css da página login encontra-se no ficheiro style.css
	depois da linha de comentário /* login */

	
=> api

	está a funcionar com ficheiros.txt


=> página inicial (dashboard.php)

	-sidebar
		icons usados na sidebar: https://boxicons.com
			-stylesheet: 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'
			
		todo o css referente à side bar encontra-se no ficheiro style.css depois da 
		linha de comentário /* sidebar */ e o seu javascript está no final do código 
		de cada cada ficheiro .php
		 
	-bloco do calendário
		o calendário foi baseado no source code: https://github.com/trananhtuat/js-calendar
		
		ficheiros do calendário:
		-calendar.css
		-calendar.js


=> página do histórico (history.php)

	apresenta todos os logs dos sensores


=> página para interação com objetos inteligentes (smartobjects.php)

	esta página vai servir para o utilizador interagir com objetos inteligentes à
	distância
	
	cada icon apresentado na página vai servir como botão para ligar/desligar
	os dispositivos inteligentes


=> página de estatisticas (analytics.php)

	esta página está "vazia" mas vai servir para apresentar gráficos estatisticos
	a partir da base de dados com os valores medidos nos sensores
	
