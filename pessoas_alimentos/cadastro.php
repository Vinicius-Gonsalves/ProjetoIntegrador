<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 


//Recupera as variaveis
@$codigo		= verifString($_GET['codigo']);
@$codigoPai		= verifString($_GET['codigoPai']);
@$msg 			= verifString($_GET['msg']);
@$mensagemErro	= verifString($_GET['mensagemErro']);


//Verifica se o formulario e de alteracao ou exclusao
if ($codigo>0)
{
	$busca = mysql_query("select * from pessoas_alimentos where ID=$codigo");
	if (mysql_fetch_row($busca)) {
	
	$PeriodoDB 				= mysql_result($busca,0,"PeriodoID");
	$AlimentoDB 			= mysql_result($busca,0,"AlimentoID");
	$MedidaDB	 			= mysql_result($busca,0,"MedidaID");
	$Quantidade 			= str_replace(".", ",", mysql_result($busca,0,"Quantidade"));

	} else {
		echo "codigo inexistente";
		exit;
	}
	
	$action="alterar";
	
} else {
	
	$action						= "inserir";
	$PeriodoDB					= 0;
	$AlimentoDB					= 0;
	$MedidaDB					= 0;
	$Quantidade					= "";
	
} 
//Tratamento

$busca          = mysql_query("select * from pessoas where ID= $codigoPai");
$PacienteNome   = mysql_result($busca,0,"Nome");

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
		<script src="../../includes/comboAlimento.js"></script>
		<script src="../../includes/js.js"></script>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-dialog.min.css" rel="stylesheet">
         <link href="../../includes/meucss.css" rel="stylesheet">

        <title>Refeição paciente</title>	

		<script language="Javascript">
	
		function checa_formulario(form){

			if(form.PeriodoID.value==0){
				alert('Período não informado.');
				form.PeriodoID.focus();
				return false;
			}

			if(form.AlimentoID.value==0){
				alert('Alimento não informado.');
				form.AlimentoID.focus();
				return false;
			}

		}	
	
	
	
		function carregaForm(){
		
			<?php 

				if ($AlimentoDB){
					echo "comboDinamicoDB($AlimentoDB,$MedidaDB,0);";
				}
			?>
		}			
			

		</script>
		
		
    </head>
    <body onload="carregaForm();"> 
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h3 align="center"><img src="../../images/nutren-a.png">Refeição</h3>
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
						
						<b>Paciente: </b>	
						<input type="text" class="form-control" value="<?php echo $PacienteNome ;?>" readonly="readonly">
						
						<b>Período:</b>
							<select name="PeriodoID" id="PeriodoID" class="form-control"> 
							<?php  
							$sqlFiltro = "select * from periodo order by Ordem";
							$sql_genero=mysql_query($sqlFiltro);	 
							echo "<option value='0'>Selecione</option>";
							while($array = mysql_fetch_array($sql_genero)) 
							{
								$cod_estado	= $array['ID'];
								$estado		= $array['Nome'];
								
								if ($PeriodoDB>0 and  $PeriodoDB==$cod_estado)
									echo "<option value='$cod_estado' selected>$estado</option>";
								else
									echo "<option value='$cod_estado' >$estado</option>";
							}?>			
						</select>		

						<?php /*<b>Alimento:</b>		
							<select name="AlimentoID" id="AlimentoID" class="form-control"> 
							<?php  
							$sqlFiltro = "select * from alimentos order by Nome";
							$sql_genero=mysql_query($sqlFiltro);	 
							echo "<option value='0'>Selecione</option>";
							while($array = mysql_fetch_array($sql_genero)) 
							{
								$cod_estado	= $array['ID'];
								$estado		= $array['Nome'];
								
								if ($AlimentoDB>0 and  $AlimentoDB==$cod_estado)
									echo "<option value='$cod_estado' selected>$estado</option>";
								else
									echo "<option value='$cod_estado' >$estado</option>";
							}?>			
						</select>					

						<b>Medida caseira:</b> */ ?>

						<b>Alimento</b>
						<select name="AlimentoID" id="AlimentoID" class="form-control"> 
							<option value="0">Selecione o alimento</option>
						</select> 						
						
						<b>Medica Caseira</b>
						<select name="MedidaID" id="MedidaID" class="form-control"> 
							<option value="0">Gramas</option>
						</select> 						

						<input type="hidden" name="DioceseID" id="DioceseID" value="0">


						<b>Quantidade:</b>	
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Quantidade" id="Quantidade" class="form-control"value= "<?php echo $Quantidade; ?>" required>				
						
						<input type="hidden" name="action" value="<?php echo $action; ?>">
						<input type="hidden" name="codigoPai" value="<?php echo $codigoPai; ?>">

						<fieldset align="center">
						<button align="center" type="submit" class="save btn btn-success">Registrar</button>
						</fieldset>
					</form>
					
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-12" align="center">
                    <a href="index.php?codigo=<?php echo $codigoPai; ?>"><input class="btn btn-default btn-md" type="button" value="Voltar para a Lista"/></a>
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