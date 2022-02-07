<?php
	include_once "../../includes/sessao.php";
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
        <link href="../../includes/meucss.css" rel="stylesheet">
        <title>Projeto Integrado | Faculdade Anhanguera de Pelotas</title>
        
    </head>
    <body> 
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h3 align="center"><img src="../../images/nutren-a.png">Projeto Integrado Engenharia da Computação e Nutrição</h3><br><br>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
<br>
					<ol class="breadcrumb">
						<!--<li><a href="areas/template">Veiculos</a></li>
						<li><a href="areas/clientes">Clientes</a></li>
						<li><a href="areas/fabricantes">Fabricantes</a></li>
						<li><a href="areas/marcas">Marcas</a></li>-->
						<li><a href="../../areas/pessoas"><b>Pessoas</b></a></li>
						<li><a href="../../areas/alimentos"><b>Alimentos</b></a></li>
						<li><a href="../../areas/usuarios"><b>Usuários do sistema</b></a></li>
						<li><a href="../../sair.php"><b>Sair</b></a></li>
					</ol>

					<div class="alert alert-info" role="alert">
					  <h4 class="alert-heading">Olá <?php echo $_SESSION['Operador_Nome']; ?></h4>
					  
					  
					</div>
					
					
					
					
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