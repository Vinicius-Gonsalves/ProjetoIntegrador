<?php 
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 
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

        <title>Clientes</title>
    </head>
    <body>     
        <div class="container-fluid">
            <div class="row header-page">
                <div class="col-md-12">
                    <h1 align="center">Listagem de Clientes</h1>
                </div>                
            </div>
            <hr>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><i class="glyphicon glyphicon-list"></i> Listagem</h4>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-plus-sign"></i> Operações
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                <li>
                                    <a onclick="window.location.href='cadastro.php'" data-dismiss="modal"><span class="glyphicon glyphicon-user"></span> Cadastrar Clientes</a>
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
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>


								<?php 
									$busca = mysql_query("select * from clientes");
									while($row=mysql_fetch_array($busca)){ 
										
										$codigo = $row['ID'];
									
									?>
                                        <tr>
											<td><?php echo $codigo;?></td>
											<td><?php echo $row['Nome'];?></td>
											<td><?php echo $row['CPF'];?></td>
											<td><?php echo $row['Telefone'];?></td>
                                            <td align="center">
                                                <button onclick="if (confirm('Confirma exclusão?')) { window.location.href='controller.php?action=excluir&codigo=<?php echo $codigo;?>'}" type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
                                                <button onclick="window.location.href='cadastro.php?action=editar&codigo=<?php echo $codigo;?>'" type="button" class="btn btn-success btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"></span> </button>
                                                <button onclick="window.location.href='#'" type="button" class="moreInfo btn btn-info btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-info-sign"></span></button>
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
                    <a href="../../gerenciador.php"><input class="btn btn-default btn-md" type="button" value="Voltar"/></a>
                </div>
            </div>				
        </div>
        <style>
            .header-page {
                background-color: #292929 !important;
                color: white; 
            }

            .dropdown {
                float: right !important;
            }
        </style>       
        <script>
            $(document).ready(function() {
                var table = $('#table').DataTable( {
                });          

                $('.moreInfo').click( function () {
                    var row = table.row($(this).closest('tr')).data();
                    console.log(row);
                    
                    BootstrapDialog.show({
                        title: 'Maiores Informações',
                        message: "<p>"+
                            "<strong>ID</strong>: "+ row[0]
                        +"</p>"
                        +"<p>"
                            +"<strong>Nome</strong>: "+ row[1]
                        +"</p>"
                        +"<p>"
                            +"<strong>CPF</strong>: "+ row[2]
                        +"</p>"
                        +'<p>'
                            +'<strong>Telefone</strong>: '+ row[3]
                        +'</p>'
                   });
                });
            } );
        </script>
        <div class="container-fluid">
            <div class="panel-footer">
                <strong>Projeto Integrador</strong>
            </div>            
        </div>
    </body>
</html>