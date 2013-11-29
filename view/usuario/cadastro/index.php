

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
       
       
       
       
       
       
<title>Cadastro</title>
</head>

<body >
    

        <div class="modal fade in " id='modalWindow'>
            <div class="modal-dialog ">
                <div class="modal-content  ">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.href='../../'">&times;</button>

                        <h4 class="modal-title">Cadastre-se!</h4>
                    </div>

                    <div class="modal-body well well-sm">


                        
                        <form role="form" id='formCadastro' action='../../../controller/usuario/cadastra_usuario.php' method='post'>
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Nome Completo*</label>
                                    <input type='text' name='nome' class="form-control" placeholder="Nome"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Email*</label>
                                    <input type='text' name='email' class="form-control" placeholder="Email">
                                </div>
                            </div>                           
                            

                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Senha*</label>
                                    <input name='pass' type='password' class="form-control" placeholder="Senha">
                                </div>
                            </div>


                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Endereço</label>
                                     <input name='endereco' type='text' class="form-control" placeholder="Endereco">
                                </div>
                            </div>
                            
                            
                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Cidade</label>
                                    <input name='cidade' type='text' class="form-control" placeholder="Cidade">
                                </div>
                            </div>                         
                            
                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">UF*</label>
                                    <input name='uf' type='text' class="form-control" placeholder="UF">
                                </div>
                            </div>   

                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">País*</label>
                                    <input name='pais' type='text' class="form-control" placeholder="Pais">
                                </div>
                            </div>                         
                                

                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Cep</label>
                                    <input name='cep' type='text' class="form-control" placeholder="Cep">
                                </div>
                            </div>                         
                                
                                
                                
                                
                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Nascimento</label>
                                    <input name='nascimento' type='text' class="form-control" placeholder="Nascimento">
                                </div>
                            </div>
                                
                                
                            <div class="row">
                               <div class="form-group col-lg-8">
                                    <label for="code">Cpf</label>
                                    <input name='cpf' type='text' class="form-control" placeholder="CPF">
                                </div>
                            </div>
                                
                                



                            

						</form>
                        
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.href='../../'">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick='document.getElementById("formCadastro").submit();'>Cadastrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    
	   

	
	


</body>
</html>
