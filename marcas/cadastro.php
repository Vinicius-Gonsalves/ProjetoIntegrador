<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Recupera as variaveis
@$codigo 			= $_GET['codigo'];
@$msg 				= $_GET['msg'];
@$mensagemErro 		= $_GET['mensagemErro'];

//Verifica se o formulario e de alteracao ou exclusao
if ($codigo>0){
	
	$busca = mysql_query("select * from Marca where ID=$codigo");
	if (mysql_fetch_row($busca)) {
	
	$Nome = 			mysql_result($busca,0,"Nome");
	
	} else {
		echo "codigo inexistente";
		exit;
	}
	
	$action="alterar";
	
} else {
	$action="inserir";
	$Nome="";
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
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-dialog.min.css" rel="stylesheet">

        <title>Marcas</title>
    </head>
    <body> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 align="center">Marcas</h3>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <?php if ($msg) {?>
						<div class="alert alert-success">
						<strong>Cadastrado com Sucesso!</strong>
					<?php echo $msg;?>
						</div>
					<?php }?>
					
					<?php if ($mensagemErro) {?>
						<div class="alert alert-danger">
						<strong>Erro!</strong> Não foi possível cadastrar/alterar a marca devido ao seguinte erro:<br><br>Nome em branco ou nulo.
						<?php echo $mensagemErro;?>
						</div>
					<?php }?>
					
					<!--  INSERIR UM FORMULÁRIO AQUI -->
					<form action='controller.php' method='post' name='form'>
						
						<?php if ($codigo>0) { ?>
						<b>ID</b>
						<input type="text" name="codigo" id="codigo" class="form-control" value= "<?php echo $codigo; ?>" readonly>
						<?php } ?>
						
						
						<b>Nome*</b>
						<input type="text" name="Nome" id="Nome" class="form-control" value= "<?php echo $Nome; ?>" required>
						
						<input type="hidden" name="action" value="<?php echo $action; ?>"
						
						<br><button align="center" type="submit" class="save btn btn-success">Registrar</button>
						
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
                *Campos obrigatórios<strong><br><br><br><br>Projeto Integrador - Airton Fouchy <i class="glyphicon glyphicon-copyright-mark"></i></strong>
            </div>            
        </div>
    </body>
</html>