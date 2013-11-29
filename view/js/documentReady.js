
//documentReady da view principal
$(document).ready(function(){

	
	function isEmailFormatValid(email){
		var $email = email;
		var expEmail= new RegExp("...@...\..."); //email valido: no minimo 3caracteres antes de um arroba seguido por mais 3 caracteres, um '.'(\.) e mais 2 chars		
		var expEmail2 = /[^A-Za-z@\.0-9]/g; //email valido: sem caracteres invalidos
		
		if ( (!expEmail.test($email)))
		{
			//invalid
			return false;
		}
		
		if ( (expEmail2.test($email)))
		{
			//invalid
			return false;
		}
		
		return true;
		
	}


	function submitLoginFormWithAjax(destUrl,formObject){
		
		
		var email = $('#loginform #login').get(0).value; //obtem o Value pelo DOM(get(0))
		var passwd = $('#loginform #pass').get(0).value;		
		//var todoFormEVariaveisEtudoMaisSerializado = formObject.serialize();		
		
		//controles via cliente
		if (email=='' || passwd =='' || email=='Email' || passwd=='Senha' ){
			alert("Por favor, informe seu nome e email.");
			return;
			
		}

		if (!isEmailFormatValid(email)){
			alert("Por favor, insira um email válido");
			return;
		}
		
		
		var $request=$.ajax({				  
				url: destUrl, //envia para essa pagina/server
				cache: false,
				type: "POST", //pelo metodo post
				data: {login: email, pass: passwd }			

			}).done(function(msg) {				
				
				
				var returnCode = msg;				
				
				//o PHP ecoa apenas o codigo, em vez de fazer o controle das mensagens.
				//Isso porque, via Ajax, qualquer manipulação nos DOMs feitas pelo PHP
				//eh encoberta pelo ajax, nao podendo ser renderizada

				if(returnCode.match("-2")){alert('Já há uma sessão ativa.\nFaça logout para entrar com uma outra conta.');location.href="usuario/principal";return;}
				
				if(returnCode.match("-1")){location.href="usuario/principal";return;}
				
				if(returnCode.match("0")){alert('Usuário e/ou senha inválidos.');return;}
				
				if(returnCode.match("1")){location.href="usuario/principal";return;}
		
			});

			


		
	}
	



	/*--- submit button, seguindo recomendacoes da documentacao da jquery -----*/
	var $loginForm = $("#loginform");		
	$loginForm.submit(function(e){		
		e.preventDefault(); //cancela submissao original
		submitLoginFormWithAjax("../controller/session/restrict/autentica.php",$(this));
		
	});


});