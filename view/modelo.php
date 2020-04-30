<?php
		require_once("../controller/marcaCtr.php");

	$pf = $_POST;
	$marcaControle = new MarcaCtr();
	$marcaControle->cadastrar($pf);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
<link rel="stylesheet" type="text/css" href="css/visual.css"
</head>

<body>
	<div id="geral">
    	<div id="topo">
        	<div id="cabecalho">
            </div>
            
            <div id="infoExtra">
            </div>
        	
        </div>
        
        <div id="meio">
        	<div id="meioCompleto">
            	<div id="contEsq">
					requeire_once
                </div>
                
                <div id="contDir">
                	<div id="conteudo">
                    	<div id="subMenuSuperior">
                        	<ul>
                                <?php 
								$opMenu = $_GET["m"];
								$opSelP = "";
								$opSelC = "";
								$opSelA = "";
								$opSelL = "";
								$opSelTL = "";
								$opSelCL = "";
								$opSelM = "";
								
								switch ($opMenu) {
									case 'p':
										$opSelP = "class='subMenuEscolhido'";
										break;
									case 'c':
										$opSelC = "class='subMenuEscolhido'";
										break;
									case 'a':
										$opSelA = "class='subMenuEscolhido'";
										break;
									case 'l':
										$opSelL = "class='subMenuEscolhido'";
										break;
									case 'tl':
										$opSelTL = "class='subMenuEscolhido'";
										break;
									case 'cl':
										$opSelCL = "class='subMenuEscolhido'";
										break;
									case 'm':
										$opSelM = "class='subMenuEscolhido'";
										break;
								}
								?>
                                <a href="?m=p" <?php echo $opSelP; ?>><li>pessoa</li></a>
                                <a href="?m=c" <?php echo $opSelC; ?>><li>cidade</li></a>
                                <a href="?m=a" <?php echo $opSelA; ?>><li>armacao</li></a>
                                <a href="?m=l" <?php echo $opSelL; ?>><li>lente</li></a>
                                <a href="?m=tl" <?php echo $opSelTL; ?>><li>tipo_lente</li></a>
                                <a href="?m=cl" <?php echo $opSelCL; ?>><li>cores</li></a>
                                <a href="?m=m" <?php echo $opSelM; ?>><li>marca</li></a>
                            </ul>
                        </div>
                        
                        <font id="contForm">
                        	<div id="contFormCabecalho">
                                <h1>Cadastro de Pessoa</h1>
                                <span>Faça o cadastro de clientes. AQui você também pode cadastrar uma filial, basta escolher a opção Filial.</span>
                            </div>
                            
                            <div id="divForm">
                                <form action="" method="post" class="smart-blue">
                                    <!--<h1>Contact Form 
                                        <span>Please fill all the texts in the fields.</span>
                                    </h1>
                                    <label>
                                        <p><span>Your Name :</span></p>
                                        <input id="name" type="text" name="name" placeholder="Your Full Name" size="100" maxlength="" />
                                    </label>
                                    
                                    <label>
                                        <p><span>Your Name :</span></p>
                                        <input id="name" type="checkbox" name="name" placeholder="Your Full Name" value="" /> Opção
                                        <input id="name" type="checkbox" name="name" placeholder="Your Full Name" value="" /> Opção
                                    </label>

                                    <label>
                                        <p><span>Your Name :</span></p>
                                        <input id="name" type="radio" name="name" placeholder="Your Full Name" value="" /> Opção
                                        <input id="name" type="radio" name="name" placeholder="Your Full Name" value="" /> Opção
                                    </label>
                                    
                                    <label><input type="radio" name="" id="" value=""> Campo</label>
                                    
                                    <label>
                                        <p><span>Your Email :</span></p>
                                        <input id="email" type="date" name="email" placeholder="Valid Email Address" />
                                    </label>
                                    
                                    <label>
                                        <p><span>Message :</span></p>
                                        <textarea id="message" name="message" placeholder="Your Message to Us"></textarea>
                                    </label> 
                                     <label>
                                        <span>Subject :</span><select name="selection">
                                        <option value="Job Inquiry">Job Inquiry</option>
                                        <option value="General Question">General Question</option>
                                        </select>
                                    </label>-->    


                                    <label>
                                        <p><span>COD_PESSOA</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição vsadçlksk asdkf asçdklf adskf s</option>
                                        </select>
                                    </label>
                                    
                                    <label>
                                        <p><span>COD_OTICA</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição</option>
                                        </select>
                                    </label>
                                    
                                    <label>
                                        <input type='radio' name='pfCodTipoPessoa' id='pfCodTipoPessoa' value='COD_TIPO_PESSOA'> COD_TIPO_PESSOA 
                                    </label>
                                    
                                    <label>
                                        <p><span>COD_CIDADE</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição</option>
                                        </select>
                                    </label>
                                    
                                    <label>
                                        <p><span>END_PESSOA</span></p>
                                        <input id='pfEndPessoa' type='text' name='pfEndPessoa' placeholder='Nome do Campo' size='50' maxlength='50' />
                                    </label>
                                    
                                    <label>
                                        <p><span>NUM_ENDERECO</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição</option>
                                        </select>
                                    </label>
                                    
                                    <label>
                                        <p><span>CEP</span></p>
                                        <input id='pfCep' type='text' name='pfCep' placeholder='Nome do Campo' size='8' maxlength='8' />
                                    </label>
                                    
                                    <label>
                                        <p><span>CPF</span></p>
                                        <input id='pfCpf' type='text' name='pfCpf' placeholder='Nome do Campo' size='12' maxlength='12' />
                                    </label>
                                    
                                    <label>
                                        <p><span>NOM_MAE</span></p>
                                        <input id='pfNomMae' type='text' name='pfNomMae' placeholder='Nome do Campo' size='50' maxlength='50' />
                                    </label>
                                    
                                    <label>
                                        <p><span>NOM_PESSOA</span></p>
                                        <input id='pfNomPessoa' type='text' name='pfNomPessoa' placeholder='Nome do Campo' size='50' maxlength='50' />
                                    </label>
                                    
                                    <label>
                                        <p><span>DAT_NASCIMENTO</span></p>
                                        <input id='pfDatNascimento' type='date' name='pfDatNascimento' placeholder='Nome do Campo' />
                                    </label>
                                    
                                    <label>
                                        <p><span>NUM_TELEFONE</span></p>
                                        <input id='pfNumTelefone' type='text' name='pfNumTelefone' placeholder='Nome do Campo' size='11' maxlength='11' />
                                    </label>
                                    
                                    <label>
                                        <p><span>NUM_CELULAR</span></p>
                                        <input id='pfNumCelular' type='text' name='pfNumCelular' placeholder='Nome do Campo' size='11' maxlength='11' />
                                    </label>
                                    
                                    <label>
                                        <p><span>DES_EMAIL</span></p>
                                        <input id='pfDesEmail' type='text' name='pfDesEmail' placeholder='Nome do Campo' size='50' maxlength='50' />
                                    </label>
                                    
                                    <label>
                                        <p><span>COD_STATUS</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição</option>
                                        </select>
                                    </label>
                                    
                                    <label>
                                        <input type='radio' name='pfCodSexo' id='pfCodSexo' value='COD_SEXO'> COD_SEXO 
                                    </label>
                                    
                                    <label>
                                        <p><span>COD_PESSOA_MATRIZ</span></p>
                                        <select name='@NAME'>
                                            <option value=''>Selecione</option>
                                            <option value='cod'>descrição</option>
                                        </select>
                                    </label>


                                     <label>
                                        <span>&nbsp;</span> 
                                        <input type="submit" class="button" value="Send" /> 
                                    </label>    
                                </form>
                        </div>
                        </font>
                    </div>
                </div>
            </div>
        </div>
        
      <div id="rodape">
        </div>
    </div>
</body>
</html>