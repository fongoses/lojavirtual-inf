<?php
/*
 * Created on 23/03/2012
 *
 *Verifica se o email informado esta cadastrado na base de dados
 *
 *Como o script é chamado via ajax, sua saida ecoa um caracter de retorno, correspondente
 *ao codigo de retorno.
 *
 *	retorna/ecoa 0 para usuario inexistente no banco de dados
 *	retorna/ecoa 1 para usuario ja existente no banco de dados
 *
 */
 
 
 /* --Includes/Imports---------------------------------------------*/ 
 include('./sessionControl.php'); //Classes de usuario e de sessao ja declaradas aqui
 header('Content-Type: text/html; charset=UTF-8');
 
    $base="lojavirtual"; 	
 	
 	$email=$_POST['emailField']; 
 
 	//conect in mysql
	$db=mysql_pconnect('localhost','usuarioweb','12345678');
	if (!$db)
	{	
		
		echo '0';				
		return 0;
		
	
	}
	//
	mysql_selectdb($base,$db);
	
	//charset
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	
	
	
	$query = sprintf("SELECT * FROM users WHERE (email = '%s')",
															mysql_real_escape_string($email)); //pass foi unsetado pela funcao que leu dados do form na hora de registar(getRegisterFormFieldsSafely). Solução: fazer uma função para obter os dados do usuario, se possivel, sem a necessidade de confirmar o password. Sugestao: em vez da verificacao por password, testar somente a validade da sessao. O pass geralmente soh eh verificado em areas mais importantes da sessao restrita
															
											
											
	
											
	//realiza a consulta
	$result = mysql_query($query);								
	if (!$result){
		
		echo '0';
		mysql_close();
		return 0;
	}	 
	
	$row =  mysql_fetch_array($result,MYSQL_NUM); //obtem a primeira linha, armazena em row, e incrementa o ponteiro da tabela resultante		 		 
	 
	if (!$row){
	 	
	 	echo '0';
	 	//doesnt exists in database
	 	mysql_close();
		return 0;
	 		 	
	}
	
	//se o email ja existe, retorna 1
	echo '1';			 		 		 	
	mysql_close();	
	return 1;
 
 
?>
