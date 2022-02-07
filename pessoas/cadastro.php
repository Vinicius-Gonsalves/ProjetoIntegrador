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
	$busca = mysql_query("select * from pessoas where ID=$codigo");
	if (mysql_fetch_row($busca)) {
	
	$Nome = 			mysql_result($busca,0,"Nome");
	$SexoDB =	 		mysql_result($busca,0,"SexoID");
	$DataNasc = 		mysql_result($busca,0,"DataNasc");
	$Email = 			mysql_result($busca,0,"Email");
	$WhatsApp = 		mysql_result($busca,0,"WhatsApp");
	$Celular =			mysql_result($busca,0,"Celular");
	$IsPaciente =		mysql_result($busca,0,"IsPaciente");
	$IsNutricionista=	mysql_result($busca,0,"IsNutricionista");
	$Ativo=				mysql_result($busca,0,"Ativo");
	$CidadeDB=			mysql_result($busca,0,"CidadeID");
	
	$EstadoDB = 0;
	$buscaEstado = mysql_query("select EstadoID from cidades where ID=$CidadeDB");
	if (mysql_fetch_row($buscaEstado)){
		$EstadoDB = mysql_result($buscaEstado,0,"EstadoID");
	}
	

	} else {
		echo "codigo inexistente";
		exit;
	}
	
	$action="alterar";
	
} else {
	
	$action				= "inserir";
	$Nome				= "";
	$SexoDB				= 0;
	$DataNasc			= "";
	$Email				= "";
	$WhatsApp			= "";
	$Celular			= "";
	$IsPaciente			= 1;
	$IsNutricionista	= 0;
	$Ativo 				= 1;
	$EstadoDB			= 0;
	$CidadeDB			= 0;

} 

//Tratamento

$LabelPaciente= "";
if($IsPaciente== 1){
	$LabelPaciente= "checked";
}

$LabelNutricionista= "";
if($IsNutricionista== 1){
	$LabelNutricionista= "checked";
}

if($Ativo== 1){
	$LabelAtivo 		= "checked";
	$LabelInativo		= "";
}
else{
	$LabelAtivo 		= "";
	$LabelInativo		= "checked";
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
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-dialog.min.css" rel="stylesheet">
        <link href="../../includes/meucss.css" rel="stylesheet">

        <title>Pessoas</title>
		
		<script language="Javascript">
	
		function carregaForm(){
		
			<?php 

				if ($EstadoDB and $CidadeDB){
					echo "comboDinamicoDB($EstadoDB,$CidadeDB,0);";
				}
			?>
		}			
			

		</script>	
		
    </head>
    <body onload="carregaForm();"> 
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h3 align="center"><img src="../../images/nutren-a.png">Pessoas</h3>
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
					<form action='controller.php' method='post' name='form'>
						
						<?php if ($codigo>0) { ?>
						<b>ID</b>
						<input type="text" name="codigo" id="codigo" class="form-control" value= "<?php echo $codigo; ?>" readonly>
						<?php } ?>
						
						<b>Nome</b>
						<input type="text" name="Nome" id="Nome" class="form-control"value= "<?php echo $Nome; ?>" required>
						
						<b>Sexo</b>
						<select name="SexoID" id="SexoID" class="form-control"> 
							<?php  
							$sqlFiltro = "select * from sexo order by Descricao";
							$sql_genero=mysql_query($sqlFiltro);	 
							echo "<option value='0'>Selecione</option>";
							while($array = mysql_fetch_array($sql_genero)) 
							{
								$cod_estado	= $array['ID'];
								$estado		= $array['Descricao'];
								
								if ($SexoDB>0 and  $SexoDB==$cod_estado)
									echo "<option value='$cod_estado' selected>$estado</option>";
								else
									echo "<option value='$cod_estado' >$estado</option>";
							}?>			
						</select>						

						<b>Data de nascimento</b>
						<input type="date" name="DataNasc" id="DataNasc" class="form-control"value= "<?php echo $DataNasc; ?>">

						<b>Estado</b>
						<select name="EstadoID" id="EstadoID" class="form-control"> 
							<option value="0">Selecione o estado</option>
						</select> 						
						
						<b>Cidade</b>
						<select name="CidadeID" id="CidadeID" class="form-control"> 
							<option value="0">Primeiro selecione o estado</option>
						</select> 

						
						<input type="hidden" name="DioceseID" id="DioceseID" value="0">
						
						<b>E-mail</b>
						<input type="email" name="Email" id="Email" class="form-control"value= "<?php echo $Email; ?>">
						
						<b>WhatsApp</b>
						<input type="text" name="WhatsApp" maxlength="12" onkeypress="formatar('##-#####-####', this)" id="WhatsApp" class="form-control"value= "<?php echo $WhatsApp; ?>">

						<b>Celular</b>		
						<input type="text" name="Celular" id="Celular" class="form-control"value= "<?php echo $Celular; ?>">

						<br><b>Atribuições:</b><br>
						<input type="checkbox" name="IsPaciente" id="IsPaciente" clas="form-control" <?php echo $LabelPaciente; ?>>	Paciente

						<input type="checkbox" name="IsNutricionista" id="IsNutricionista" clas="form-control" <?php echo $LabelNutricionista; ?>>	Nutricionista

						<br><br><b>Situação:</b><br> 
						<input type="radio" name="Ativo" value="1" <?php echo $LabelAtivo; ?>> Ativo
						<input type="radio" name="Ativo" value="0" <?php echo $LabelInativo; ?>> Inativo <br><br>
						
						<input type="hidden" name="action" value="<?php echo $action; ?>">

						<fieldset align="center">
						<button align="center" type="submit" class="save btn btn-success">Registrar</button>
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