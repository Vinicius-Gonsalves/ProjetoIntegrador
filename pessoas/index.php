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
        <link href="../../includes/meucss.css" rel="stylesheet">

        <title>Pessoas</title>
    </head>
    <body>     
        <div class="container-fluid">
            
			<div class="row header-page">
                <div class="col-md-12">
                    <h1 align="center"><img src="../../images/nutren-a.png">Lista de Pessoas</h1>
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
                                <a onclick="window.location.href='cadastro.php'" data-dismiss="modal"><span class="glyphicon glyphicon-user"></span> Cadastrar </a>
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
                                        <th>Sexo</th>
                                        <th>Cidade</th>
                                        <th>Data de nascimento</th>
                                        <th>E-mail</th>
                                        <th>Whatsapp</th>
                                        <th>Celular</th>
                                        <th>Atribuições</th>                                        
                                        <th>Operações</th>

                                    </tr>
                                </thead>
                                <tbody>


								<?php 
									$busca = mysql_query("select B.Descricao as 'Sexo', C.Nome as 'Cidade',A.*
                                                        from pessoas A left join sexo B on (A.SexoID=B.ID) 
                                                        left join cidades C on (A.CidadeID=C.ID)");
									while($row=mysql_fetch_array($busca)){ 
										
									   $codigo = $row['ID'];
									   $Atribuicoes="";

                                       if($row['IsPaciente']==1){
                                            $Atribuicoes.= "Paciente";
                                        }

                                        if($row['IsNutricionista']==1){
                                            $Atribuicoes.= " Nutricionista";
                                        }

									?>
                                        <tr>
											<td><?php echo $codigo;?></td>
											<td><?php echo $row['Nome'];?></td>
											<td><?php echo $row['Sexo'];?></td>
                                            <td><?php echo $row['Cidade'];?></td>
                                            <td><?php echo transfData($row['DataNasc']);?></td>
                                            <td><?php echo $row['Email'];?></td>
                                            <td><?php echo $row['WhatsApp'];?></td>
											<td><?php echo $row['Celular'];?></td>
                                            <td><?php echo trim($Atribuicoes);?></td>                                      
											<td align="center">
                                                <button onclick="if (confirm('Confirma exclusão?')) { window.location.href='controller.php?action=excluir&codigo=<?php echo $codigo;?>'}" type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
                                                <button onclick="window.location.href='cadastro.php?action=editar&codigo=<?php echo $codigo;?>'" type="button" class="btn btn-success btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"></span> </button>
                                                <button onclick="window.location.href='../pessoas_avaliacao/index.php?codigo=<?php echo $codigo;?>'" type="button" class="btn btn-warning btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-heart"></span> </button>
                                                <button onclick="window.location.href='../pessoas_alimentos/index.php?codigo=<?php echo $codigo;?>'" type="button" class="btn btn-default btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-apple"></span> </button>
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
                    <a href="../../areas/principal/index.php"><input class="btn btn-default btn-md" type="button" value="Voltar"/></a>
                </div>
            </div>			
        </div>              
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
                            +"<strong>Sexo</strong>: "+ row[2]
                        +"</p>"
                        +"<p>"
                            +"<strong>Cidade</strong> "+ row[3]
                        +"</p>"
                        +"<p>"
                            +"<strong>Data de nascimento</strong>: "+ row[4]
                        +"</p>"
                        +"<p>"
                            +"<strong>E-mail</strong>: "+ row[5]
                        +"</p>"
                        +"<p>"
                            +"<strong>Whatsapp</strong>: "+ row[6]
                        +"</p>"   
                        +"<p>"
                            +"<strong>Celular</strong>: "+ row[7]
                        +"</p>" 
                        +"<p>"
                            +"<strong>Atribuições</strong> "+ row[8]
                        +"</p>"
                        

                   });
                });
            } );
        </script>
        <div class="container-fluid">
            <div class="panel-footer">
                <strong>Faculdade Anhanguera de Pelotas/RS  <i class="glyphicon glyphicon-copyright-mark"></i></strong>
            </div>            
        </div>
    </body>
</html>