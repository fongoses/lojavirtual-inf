<?php
  if(!defined("__MVCPATHS__")) {
  define("__MVCPATHS__", "true");
  
    $MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
    $CONTROLLERPATH=$MAINPATH.'/controller';
    $MODELPATH = $MAINPATH.'/model';
  
  }

  include($CONTROLLERPATH.'/session/restrict/restrictPageHeader.php');
  
  

?>
  

<!DOCTYPE html>
<html>
<head>
       
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <!-- StyleSheets  -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="../../css/smartstyle.css"></link>
    

    <!-- Carrega Scripts -->
    <script src="../../js/jquery.js" type="text/javascript"></script> 
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script> 
    
    <script src="documentReady.js" type="text/javascript" ></script> 
       
       
       
       
       
       
<title>SmartTicket::</title>
</head>

<body >
  

  <?php
    //barra superior
    include($CONTROLLERPATH.'/session/restrict/barra_usuario.php');




    echo "<div class=\"container\">
                        <form role=\"form\" id='formEdicao' action='../../../controller/usuario/atualiza_usuario.php' method='post'>";

    echo "<div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Nome Completo*</label>
                                    <input type='text' name='nome' class=\"form-control\" value=\"".$_SESSION['user']->getName()."\"/>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Email*</label>
                                    <input type='text' name='email' disabled=true class=\"form-control\" value=\"".$_SESSION['user']->getEmail()."\">
                                </div>
                            </div>

                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Senha*</label>
                                    <input name='pass' type='password' class=\"form-control\" value=\"Senha\">
                                </div>
                            </div>


                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Endereço</label>
                                     <input name='endereco' type='text' class=\"form-control\" value=\"".$_SESSION['user']->getAddress()."\">
                                </div>
                            </div>
                            
                            
                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Cidade</label>
                                    <input name='cidade' type='text' class=\"form-control\" value=\"".$_SESSION['user']->getCity()."\">
                                </div>
                            </div>                         
                            
                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">UF*</label>
                                    <input name='uf' type='text' class=\"form-control\" value=\"".$_SESSION['user']->getIdUf()."\">
                                </div>
                            </div>   

                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">País*</label>
                                    <input name='pais' type='text' class=\"form-control\" value=\"".$_SESSION['user']->getIdPais()."\">
                                </div>
                            </div>                         
                                

                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Cep</label>
                                    <input name='cep' type='text' class=\"form-control\" value=\"".$_SESSION['user']->getZip()."\">
                                </div>
                            </div>                         
                                
                                
                                
                                
                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Nascimento</label>
                                    <input name='nascimento' type='text' class=\"form-control\" value=\"Nascimento\">
                                </div>
                            </div>
                                
                                
                            <div class=\"row\">
                               <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Cpf</label>
                                    <input name='cpf' type='text' class=\"form-control\" value=\"CPF\">
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <button type=\"submit\" class=\"btn btn-primary pull-right\">Atualizar</button></div>
                                </div>
                            
                          </div>
            </form>";

?>

  

                        
                            
                        
                        
               

	
	


</body>
</html>
