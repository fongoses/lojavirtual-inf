<!-- -------------------------------------------------------- -->
<!-- -scripts/classes PHP ----------------------------------- -->
<?php
	
	
	
	include('../../../../controllers/session/restrict/restrictPageHeader.php'); //pagina restrita
	header('Content-Type: text/html; charset=UTF-8'); 
	
	
	
	$loggedUser = $_SESSION['user'];
	echo '<h3> Olá, '.$loggedUser->getName().'. Você está logado.</h3>';
	//echo 'variaveis da sessão recuperadas';


?>


  
  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <title>Bem vindo a sua página inicial</title>
  
    
      
      <!-- -------------------------------------------------------- -->
      <!-- Carrega Scripts ---------------------------------------- --> 
      <script src="../../js/jquery-1.4.2.min.js" type="text/javascript"></script>     
      <!--<script src="../../js/mainClass.js" type="text/javascript"></script>       
      <script src="../../js/documentReady.js" type="text/javascript"></script> -->
       
    	
      <!-- -------------------------------------------------------- -->
      <!-- Script para execução das funções das classes ----------- -->	
      <!-- <script type="text/javascript" src="../../js/runAll.js" >
      
	
          /*
          
              Tudo no runAll.js
              
          
          */
          
      </script> -->
      
      
  
      <!-- -------------------------------------------------------- -->
      <!-- StyleSheets -------------------------------------------- -->
      
  
  
      
      
  </head>
  
  <body>
  
  <!--<p id="counter" ></p>-->
  <br/>
  <hr>
  <br/>
  <a href="controlPanel"> Painel de Controle</a>
  <br/>
  <br/>
  <br/>
  <a href="logout"> Sair</a>
  <br/>
  
  
  </body>
  </html>
