<?php 
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

$codigoPai      = verifString($_GET['codigo']); //Recupera o codigo do grid.
$buscaPai       = mysql_query("select * from alimentos where ID= $codigoPai"); //executa no banco de dados.

if(!mysql_fetch_row($buscaPai)){
    exit;
}

$AlimentoNome   = mysql_result($buscaPai,0,"Nome"); //recupera o resultado.
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">

        <script src="../../bootstrap/js/jquery-3.2.1.min.js" ></script>
        <script src="../../bootstrap/js/bootstrap.min.js" ></script>
        <script src="../../bootstrap/js/jquery.dataTables.min.js" ></script>
        <script src="../../bootstrap/js/dataTables.bootstrap.min.js" ></script>
        <script src="../../bootstrap/js/bootstrap-dialog.min.js" ></script>

        <link href="../../bootstrap/css/bootstrap.min.css"  rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-theme.min.css"  rel="stylesheet">
        <link href="../../bootstrap/css/dataTables.bootstrap.min.css"  rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap-dialog.min.css"  rel="stylesheet">
        <link href="../../includes/meucss.css" rel="stylesheet">

        <title>Dieta</title>
    </head>
    <body>     
        <div class="container-fluid">
            
			<div class="row header-page">
                <div class="col-md-12">
                    <h1 align="center"><img src="../../images/nutren-a.png">Medida caseira de <?php echo $AlimentoNome ;?></h1>
                </div>                
            </div>
            <hr>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><i class="glyphicon glyphicon-list"></i> Resumo</h4>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-plus-sign"></i> Operações
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                <li>
                                    <a onclick="window.location.href='cadastro.php?codigoPai= <?php echo $codigoPai; ?>'" data-dismiss="modal"><span class="glyphicon glyphicon-user"></span> Cadastrar </a>
                                </li>
                              </ul>
                            </div>
                            
                            
                         </div>
                    </div>                  
                    
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descrição</th>
                                        <th>Quantidade(g)</th>
                                        <th>Operações</th>

                                    </tr>
                                </thead>
                                <tbody>


                                <?php 
                                    $busca = mysql_query("select * from alimentos_medidas where AlimentoID=$codigoPai");
                                    while($row=mysql_fetch_array($busca)){ 
                                        
                                       $codigo = $row['ID'];
                                       
                                    ?>
                                        <tr>
                                            <td><?php echo $codigo;?></td>
                                            <td><?php echo $row['Nome'];?></td>
                                            <td><?php echo $row['Quantidade'];?></td>
                                                                                    
											<td align="center">
                                                <button onclick="if (confirm('Confirma exclusão?')) { window.location.href='controller.php?action=excluir&codigo=<?php echo $codigo;?>&codigoPai=<?php echo $codigoPai; ?>'}" type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
                                                <button onclick="window.location.href='cadastro.php?action=editar&codigo=<?php echo $codigo;?>&codigoPai=<?php echo $codigoPai; ?>'" type="button" class="btn btn-success btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"></span> </button>                                                                              
                                                
                                            </td>
                                        </tr>
								<?php } ?> 
                                    
                                </tbody>
                            </table>                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" align="center">
                    <a href="../alimentos/index.php"><input class="btn btn-default btn-md" type="button" value="Voltar"/></a>
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