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
	$busca = mysql_query("select * from alimentos_medidas where ID=$codigo");
	if (mysql_fetch_row($busca)) {
	
	$Nome					= mysql_result($busca,0,"Nome");
	$Quantidade 			= str_replace(".", ",", mysql_result($busca,0,"Quantidade"));

	} else {
		echo "codigo inexistente";
		exit;
	}
	
	$action="alterar";
	
} else {
	
	$action						= "inserir";
	$Nome						= "";
	$Quantidade					= "";
	
} 
//Tratamento

$busca          = mysql_query("select * from alimentos where ID= $codigoPai");
$AlimentoNome   = mysql_result($busca,0,"Nome");

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

        <title>Medida caseira</title>		
		
    </head>
    <body> 
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h3 align="center"><img src="../../images/nutren-a.png">Cadastro medida</h3>
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
						
						<b>Alimento: </b>	
						<input type="text" class="form-control" value="<?php echo $AlimentoNome ;?>" readonly="readonly">
						
						<b>Descrição:</b>
						<input type="text" step="0.01" name="Nome" id="Nome" class="form-control"value= "<?php echo $Nome; ?>">

						<b>Quantidade(g):</b>		
						<input type="text" onkeyup="FormataValor(this,13,event)" onkeypress="return SomenteNumeros(event);" name="Quantidade" id="Quantidade" class="form-control"value= "<?php echo $Quantidade; ?>">	

						
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