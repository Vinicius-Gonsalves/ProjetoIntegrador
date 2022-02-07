<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Recupera as variaveis
@$codigo		= $_GET['codigo'];
@$msg 			= $_GET['msg'];
@$mensagemErro	= $_GET['mensagemErro'];


//Verifica se o formulario e de alteracao ou exclusao
if ($codigo>0)
{
	$busca = mysql_query("select * from alimentos  where ID=$codigo");
	if (mysql_fetch_row($busca)) {
	
	$Nome = 				str_replace(".", ",", mysql_result($busca,0,"Nome"));
	$Porcao =	 			str_replace(".", ",", mysql_result($busca,0,"Porcao"));
	$Calorias = 			str_replace(".", ",", mysql_result($busca,0,"Calorias"));	
	$GrupoDB = 				str_replace(".", ",", mysql_result($busca,0,"GrupoID"));
	$Proteinas = 			str_replace(".", ",", mysql_result($busca,0,"Proteinas"));
	$Carboidratos = 		str_replace(".", ",", mysql_result($busca,0,"Carboidratos"));
	$Lipideos = 			str_replace(".", ",", mysql_result($busca,0,"Lipideos"));
	$FibraAlimentar = 		str_replace(".", ",", mysql_result($busca,0,"FibraAlimentar"));
	$Acucar = 				str_replace(".", ",", mysql_result($busca,0,"Acucar"));
	$Calcio = 				str_replace(".", ",", mysql_result($busca,0,"Calcio"));
	$Colesterol = 			str_replace(".", ",", mysql_result($busca,0,"Colesterol"));
	$Ferro = 				str_replace(".", ",", mysql_result($busca,0,"Ferro"));
	$GordMonoinsaturada = 	str_replace(".", ",", mysql_result($busca,0,"GordMonoinsaturada"));
	$GordPoliInsaturada = 	str_replace(".", ",", mysql_result($busca,0,"GordPoliInsaturada"));
	$GordSaturada = 		str_replace(".", ",", mysql_result($busca,0,"GordSaturada"));
	$GordTrans = 			str_replace(".", ",", mysql_result($busca,0,"GordTrans"));
	$Fosforo = 				str_replace(".", ",", mysql_result($busca,0,"Fosforo"));
	$Magnesio = 			str_replace(".", ",", mysql_result($busca,0,"Magnesio"));
	$Manganes = 			str_replace(".", ",", mysql_result($busca,0,"Manganes"));
	$Potassio = 			str_replace(".", ",", mysql_result($busca,0,"Potassio"));
	$Selenio = 				str_replace(".", ",", mysql_result($busca,0,"Selenio"));
	$Sodio = 				str_replace(".", ",", mysql_result($busca,0,"Sodio"));
	$VitaminaA = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaA"));
	$VitaminaB1 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB1"));
	$VitaminaB2 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB2"));
	$VitaminaB3 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB3"));
	$VitaminaB6 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB6"));
	$VitaminaB9 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB9"));
	$VitaminaB12 = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaB12"));
	$VitaminaC = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaC"));
	$VitaminaD = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaD"));
	$VitaminaE = 			str_replace(".", ",", mysql_result($busca,0,"VitaminaE"));
	$Zinco = 				str_replace(".", ",", mysql_result($busca,0,"Zinco"));
	$Cobre = 				str_replace(".", ",", mysql_result($busca,0,"Cobre"));

	} else {
		echo "codigo inexistente";
		exit;
	}
	
	$action		="alterar";
	$lblbutton	="Registrar";
	
} else {
	
	$action					= "inserir";
	$Nome					= "";
	$Porcao					= 100;
	$Calorias				= "";
	$GrupoDB				= 0;
	$Proteinas				= "";
	$Carboidratos			= "";
	$Lipideos				= "";
	$FibraAlimentar			= "";
	$Acucar					= "";
	$Calcio					= "";
	$Colesterol				= "";
	$Ferro					= "";
	$GordMonoinsaturada		= "";
	$GordPoliInsaturada		= "";
	$GordSaturada			= "";
	$GordTrans				= "";
	$Fosforo				= "";
	$Magnesio				= "";
	$Manganes				= "";
	$Potassio				= "";
	$Selenio				= "";
	$Sodio					= "";
	$VitaminaA				= "";
	$VitaminaB1				= "";
	$VitaminaB2				= "";
	$VitaminaB3				= "";
	$VitaminaB6				= "";
	$VitaminaB9				= "";
	$VitaminaB12			= "";
	$VitaminaC				= "";
	$VitaminaD				= "";
	$VitaminaE				= "";
	$Zinco					= "";
	$Cobre					= "";
	$lblbutton				="Gravar e inserir medida caseira";
} 


?>

 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">

        <script src="../../bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../bootstrap/js/jquery.dataTables.min.js"></script>
        <script src="../../bootstrap/js/dataTables.bootstrap.min.js"></script>
        <script src="../../bootstrap/js/bootstrap-dialog.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="../../includes/combo.js"></script>
		<script src="../../includes/js.js"></script>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-dialog.min.css" rel="stylesheet">
        <link href="../../includes/meucss.css" rel="stylesheet">

        <title>Cadastro Alimentos</title>
		
        <script language="Javascript">
        	function checa_formulario(form){

        		/*if(form.Nome.value.length<=2){
        			alert('Nome não informado.');
        			form.Nome.focus();
        			return false;
        		}*/

        		if(form.GrupoID.value==0){
        			alert('Grupo não informado.');
        			form.GrupoID.focus();
        			return false;
        		}


        	}
        </script> 

		
    </head>
    <body onload="carregaForm();"> 
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h3 align="center"><img src="../../images/nutren-a.png">Alimentos</h3>
                </div>
                
            </div>
            <br><div class="row">
                <div class="col-md-6 col-md-offset-3">

					<?php if ($msg) { ?>
						<div class="alert alert-success">
							<?php echo $msg;?>
						</div>
					<?php } ?>

					<?php if ($mensagemErro) { ?>
						<div class="alert alert-danger">
							<?php echo $mensagemErro;?>
						</div>					
					<?php } ?>


                    <!--  INSERIR UM FORMULÁRIO AQUI -->
					<form action='controller.php' method='post' name='form' onsubmit="return checa_formulario(this)">
						
						<?php if ($codigo>0) { ?>
						<b>ID</b>
						<input type="text" name="codigo" id="codigo" class="form-control" value= "<?php echo $codigo; ?>" readonly>
						<?php } ?>
						
						<b>Nome (*)</b>
						<input type="text" name="Nome" id="Nome" class="form-control"value= "<?php echo $Nome; ?>" required>
												
						<div class="row">
							<div class="col-md-6">
						<b>Porção(g) (*)</b>
						<input type="text" name="Porcao" id="Porcao" class="form-control"value= "<?php echo $Porcao; ?>" required>
						</div>
							<div class="col-md-6">
						<b>Calorias (*)</b>
						<input type="text" name="Calorias" id="Calorias" class="form-control"value= "<?php echo $Calorias; ?>" required>	
						</div>		
						</div>
						<b>Grupo (*)</b>
						<select name="GrupoID" id="GrupoID" class="form-control"> 
							<?php  
							$sqlFiltro = "select * from alimentos_grupo order by Nome";
							$sql_genero=mysql_query($sqlFiltro);	 
							echo "<option value='0'>Selecione</option>";
							while($array = mysql_fetch_array($sql_genero)) 
							{
								$cod_estado	= $array['ID'];
								$estado		= $array['Nome'];
								
								if ($GrupoDB>0 and  $GrupoDB==$cod_estado)
									echo "<option value='$cod_estado' selected>$estado</option>";
								else
									echo "<option value='$cod_estado' >$estado</option>";
							}?>			
						</select>
						<br><div align="center" ><b>Macronutrientes:</b></div>
						<br>

						<div class="row">
							<div class="col-md-3">
						<b>Proteínas(g)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Proteinas" id="Proteinas" class="form-control"value= "<?php echo $Proteinas; ?>">
							</div>
							<div class="col-md-3">
						<b>Carboidratos(g)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Carboidratos" id="Carboidratos" class="form-control"value= "<?php echo $Carboidratos; ?>">
							</div>
							<div class="col-md-3">
						<b>Lipídeos(g)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Lipideos" id="Lipideos" class="form-control"value= "<?php echo $Lipideos; ?>">
							</div><div class="col-md-3">
						<b>Fibra Alimentar(g)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="FibraAlimentar" id="FibraAlimentar" class="form-control"value= "<?php echo $FibraAlimentar; ?>">
							</div>
						</div>

						<br><div align="center" ><b>Micronutrientes:</b>	</div>
						<br>	

						<div class="row">
							<div class="col-md-3">
						<b>Açucar(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Acucar" id="Acucar" class="form-control"value= "<?php echo $Acucar; ?>">
							</div>
							
							<div class="col-md-3">
						<b>Cálcio(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Calcio" id="Calcio" class="form-control"value= "<?php echo $Calcio; ?>">
							</div>
							
							<div class="col-md-3">
						<b>Colesterol(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Colesterol" id="Colesterol" class="form-control"value= "<?php echo $Colesterol; ?>">
							</div>

							<div class="col-md-3">
						<b>Ferro(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Ferro" id="Ferro" class="form-control"value= "<?php echo $Ferro; ?>">
							</div>
						</div>

						<br><div class="row">
							<div class="col-md-3">
						<b>G.Monoinsaturada(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="GordMonoinsaturada" id="GordMonoinsaturada" class="form-control"value= "<?php echo $GordMonoinsaturada; ?>">
							</div>	

							<div class="col-md-3">
						<b>G.PoliInsaturada(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="GordPoliInsaturada" id="GordPoliInsaturada" class="form-control"value= "<?php echo $GordPoliInsaturada; ?>">
							</div>	

							<div class="col-md-3">
						<b>G.Saturada(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="GordSaturada" id="GordSaturada" class="form-control"value= "<?php echo $GordSaturada; ?>">
							</div>	

							<div class="col-md-3">
						<b>G.Trans(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="GordTrans" id="GordTrans" class="form-control"value= "<?php echo $GordTrans; ?>">
							</div>
						</div>

						<br><div class="row">
							<div class="col-md-3">
						<b>Fósforo(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Fosforo" id="Fosforo" class="form-control"value= "<?php echo $Fosforo; ?>">
							</div>	

							<div class="col-md-3">
						<b>Magnésio(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Magnesio" id="Magnesio" class="form-control"value= "<?php echo $Magnesio; ?>">
							</div>	

							<div class="col-md-3">
						<b>Manganês(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Manganes" id="Manganes" class="form-control"value= "<?php echo $Manganes; ?>">
							</div>	

							<div class="col-md-3">
						<b>Potássio(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Potassio" id="Potassio" class="form-control"value= "<?php echo $Potassio; ?>">
							</div>	
						</div>		

						<br><div class="row">
							<div class="col-md-3">
						<b>Selênio(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Selenio" id="Selenio" class="form-control"value= "<?php echo $Selenio; ?>">
							</div>	

							<div class="col-md-3">
						<b>Sódio(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Sodio" id="Sodio" class="form-control"value= "<?php echo $Sodio; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina A(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaA" id="VitaminaA" class="form-control"value= "<?php echo $VitaminaA; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina B1(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB1" id="VitaminaB1" class="form-control"value= "<?php echo $VitaminaB1; ?>">
							</div>	
						</div>	

						<br><div class="row">
							<div class="col-md-3">
						<b>Vitamina B2(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB2" id="VitaminaB2" class="form-control"value= "<?php echo $VitaminaB2; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina B3(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB3" id="VitaminaB3" class="form-control"value= "<?php echo $VitaminaB3; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina B6(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB6" id="VitaminaB6" class="form-control"value= "<?php echo $VitaminaB6; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina B9(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB9" id="VitaminaB9" class="form-control"value= "<?php echo $VitaminaB9; ?>">
							</div>	
						</div>

						<br><div class="row">
							<div class="col-md-3">
						<b>Vitamina B12(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaB12" id="VitaminaB12" class="form-control"value= "<?php echo $VitaminaB12; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina C(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaC" id="VitaminaC" class="form-control"value= "<?php echo $VitaminaC; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina D(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaD" id="VitaminaD" class="form-control"value= "<?php echo $VitaminaD; ?>">
							</div>	

							<div class="col-md-3">
						<b>Vitamina E(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="VitaminaE" id="VitaminaE" class="form-control"value= "<?php echo $VitaminaE; ?>">
							</div>	
						</div>

						<br><div class="row">
							<div class="col-md-3">
						<b>Zinco(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Zinco" id="Zinco" class="form-control"value= "<?php echo $Zinco; ?>">
							</div>	

							<div class="col-md-3">
						<b>Cobre(mg)</b>
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Cobre" id="Cobre" class="form-control"value= "<?php echo $Cobre; ?>">
							</div>	
						</div>		<br><br>	
						
						<input type="hidden" name="action" value="<?php echo $action; ?>">

						 (*) Preenchimento obrigatório!
						<fieldset align="center">
						<button align="center" type="submit" class="save btn btn-success"><?php echo $lblbutton; ?></button>
						</fieldset>
					</form>
					
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-12" align="center">
                    <a href="index.php"><input class="btn btn-default btn-md" type="button" value="Voltar para a Lista"/></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel-footer">
                <strong>Faculdade Anhanguera de Pelotas/RS  <i class="glyphicon glyphicon-copyright-mark"></i></strong>
            </div>            
        </div>
    </body>
</html>