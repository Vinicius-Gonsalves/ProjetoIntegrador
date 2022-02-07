<?php 
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

$codigoPai      = verifString($_GET['codigo']); //Recupera o codigo do grid.
$buscaPai       = mysql_query("select *, TIMESTAMPDIFF(year, DataNasc,now()) as 'Idade', B.Sigla as 'Sexo' 
from pessoas A left join Sexo B on (A.SexoID=B.ID)
 where A.ID= $codigoPai"); //executa no banco de dados.

if(!mysql_fetch_row($buscaPai)){
    exit;
}

$PacienteNome       = mysql_result($buscaPai,0,"Nome"); //recupera o resultado.
$PacienteIdade      = mysql_result($buscaPai,0,"Idade");
$PacienteSexo       = mysql_result($buscaPai,0,"Sexo");

$buscaUltImc        = mysql_query("select * from pessoas_avaliacao where PessoaID= $codigoPai order by ID desc limit 0,1");
if(mysql_fetch_row($buscaUltImc)){
    $PacienteUltImc     = mysql_result($buscaUltImc,0,"IMC");
    $PacienteUltImcData = transfData( mysql_result($buscaUltImc,0,"UsuarioIncDataHora"));
    $PacientePeso       = mysql_result($buscaUltImc,0,"Peso");
    $PacienteAltura     = mysql_result($buscaUltImc,0,"Altura");
}
else{
    $PacienteUltImc     = "";
    $PacienteUltImcData = "";  
}
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

        <title>Nutren-A Faculdade Anhanguera de Pelotas</title>

        <style type="text/css">
            @media print {
                .no-print, .dataTables_filter {
                    display: none;
                }
                .print-img{
                    display: none;
                }
                .print-img-1{
                    display: block;
                }
                
            }
            
            

            @media screen{
                .print-img{
                    display: block;
                }
                .print-img-1{
                    display: none;
                }
            }
        </style>
    </head>
    <body>     
        <div class="container-fluid">
            
			<div class="row header-page">
                <div class="col-md-4 print-img">
                    <img src="../../images/nutren-a.png">
                </div>  
                <div class="col-md-4 print-img-1">
                    <img src="../../images/nutren-print.png">
                </div>                   
                <div class="col-md-8">
                    <h3>Dieta de <?php echo $PacienteNome; ?> </h3>
                    <h4>Idade: <?php echo $PacienteIdade; ?> anos(<?php echo $PacienteSexo; ?>)
                    <?php  if($PacienteUltImc){
                    echo " Peso: $PacientePeso";echo"Kg"; echo " Altura: $PacienteAltura"; echo"m";
                    echo "<br>IMC: $PacienteUltImc ($PacienteUltImcData)";
                    }
                    else{
                        echo "<br>IMC não encontrado.";
                    }?></h4>
                </div>                
            </div>
            <hr>

            <div class="panel panel-default">
                <div class="panel-heading no-print">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><i class="glyphicon glyphicon-list"></i> Plano alimentar</h4>
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
                                <li>
                                    <a onClick="window.print()" data-dismiss="modal"><span class="glyphicon glyphicon-print"></span> Imprimir </a>
                                </li>
                              </ul>
                            </div>
                            
                            
                         </div>
                    </div>                  
                    
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Período</th>
                                        <th>Alimento</th>
                                        <th>Medida</th>                                        
                                        <th>Proteínas(g)</th>
                                        <th>Carboidratos(g)</th>
                                        <th>Lipídeos(g)</th>
                                        <th>Calorias(kcal)</th>
                                        <th>Quantidade(g)</th>                                                
                                        <th class="no-print">Operações</th>

                                    </tr>
                                </thead>
                                <tbody>


								<?php
                                    //Macros
                                    $QuantidadeTotal            = '';
                                    $ProteinasTotal             = '';
                                    $CarboidratosTotal          = '';
                                    $LipideosTotal              = '';
                                    $CaloriasTotal              = '';

                                    //Micros
                                    //@vinicius ira definir todas variaveis de micro com final total
                                    $FibraAlimentarTotal        = '';
                                    $AcucarTotal                = '';
                                    $CalcioTotal                = '';
                                    $ColesterolTotal            = '';
                                    $FerroTotal                 = '';
                                    $GordMonoinsaturadaTotal    = '';
                                    $GordPoliInsaturadaTotal    = '';
                                    $GordSaturadaTotal          = '';
                                    $GordTransTotal             = '';
                                    $FosforoTotal               = '';
                                    $MagnesioTotal              = '';
                                    $ManganesTotal              = '';
                                    $PotassioTotal              = '';
                                    $SelenioTotal               = '';
                                    $SodioTotal                 = '';
                                    $VitaminaATotal             = '';
                                    $VitaminaB1Total            = '';
                                    $VitaminaB2Total            = '';
                                    $VitaminaB3Total            = '';
                                    $VitaminaB6Total            = '';
                                    $VitaminaB9Total            = '';
                                    $VitaminaB12Total           = '';
                                    $VitaminaCTotal             = '';
                                    $VitaminaDTotal             = '';
                                    $VitaminaETotal             = '';
                                    $ZincoTotal                 = '';
                                    $CobreTotal                 = '';
                                    
									$busca = mysql_query("select C.Porcao, C.Nome as 'alimento', C.Calorias, C.Proteinas, C.Lipideos, C.FibraAlimentar, C.Carboidratos, C.Acucar, C.Calcio, C.Colesterol, C.Ferro, C.GordMonoinsaturada, C.GordPoliInsaturada, C.GordSaturada, C.GordTrans, C.Fosforo, C.Magnesio, C.Manganes, C.Potassio, C.Selenio, C.Sodio, C.VitaminaA, C.VitaminaB1, C.VitaminaB2, C.VitaminaB3, C.VitaminaB6, C.VitaminaB9, C.VitaminaB12, C.VitaminaC, C.VitaminaD, C.VitaminaE, C.Zinco, C.Cobre,
                                        B.Nome as 'periodo', 
                                        A.*, D.Nome as 'Medida', D.Quantidade as 'MedidaQuantidade' 
                                        from pessoas_alimentos A left join periodo B on (A.PeriodoID=B.ID)
                                        left join alimentos C on (A.AlimentoID=C.ID)
                                        left join alimentos_medidas D on (A.MedidaID=D.ID)
                                        where A.PessoaID= $codigoPai
                                        order by B.Ordem, C.Nome");
                                         
									
                                    while($row=mysql_fetch_array($busca)){ 
										
                                        //Obtendo as informações do DB
                                        $codigo        = $row['ID'];
                                        $Quantidade    = number_format($row['Quantidade'],0,',','');
                                        $MedidaQuantidade= number_format($row['MedidaQuantidade'],0,',','');
                                        $MedidaID      = $row['MedidaID'];
                                        $Porcao        = $row['Porcao'];
                                        
                                        //Macro
                                        $Proteinas         = $row['Proteinas'];
                                        $Carboidratos      = $row['Carboidratos'];
                                        $Lipideos          = $row['Lipideos'];
                                        $Calorias          = $row['Calorias'];

                                        //Micro
                                        //@vinicius ira recuperar todas propriedades do banco
                                        $FibraAlimentar         = $row['FibraAlimentar'];
                                        $Acucar                 = $row['Acucar'];
                                        $Calcio                 = $row['Calcio'];
                                        $Colesterol             = $row['Colesterol'];
                                        $Ferro                  = $row['Ferro'];
                                        $GordMonoinsaturada     = $row['GordMonoinsaturada'];
                                        $GordPoliInsaturada     = $row['GordPoliInsaturada'];
                                        $GordSaturada           = $row['GordSaturada'];
                                        $GordTrans              = $row['GordTrans'];
                                        $Fosforo                = $row['Fosforo'];
                                        $Magnesio               = $row['Magnesio'];
                                        $Manganes               = $row['Manganes'];
                                        $Potassio               = $row['Potassio'];
                                        $Selenio                = $row['Selenio'];
                                        $Sodio                  = $row['Sodio'];
                                        $VitaminaA              = $row['VitaminaA'];
                                        $VitaminaB1             = $row['VitaminaB1'];
                                        $VitaminaB2             = $row['VitaminaB2'];
                                        $VitaminaB3             = $row['VitaminaB3'];
                                        $VitaminaB6             = $row['VitaminaB6'];
                                        $VitaminaB9             = $row['VitaminaB9'];
                                        $VitaminaB12            = $row['VitaminaB12'];
                                        $VitaminaC              = $row['VitaminaC'];
                                        $VitaminaD              = $row['VitaminaD'];
                                        $VitaminaE              = $row['VitaminaE'];
                                        $Zinco                  = $row['Zinco'];
                                        $Cobre                  = $row['Cobre'];

                                        //Tratamentos
                                        if($MedidaID>0){
                                            $Medida           = $row['Medida'] . "(". $MedidaQuantidade ."g)";
                                            $QuantidadeReg    = $MedidaQuantidade*$Quantidade;

                                        }else{
                                            $Medida             = 'Gramas';
                                            $QuantidadeReg    = $Quantidade;
                                        }
                                        $Medida = $Quantidade ."  ". $Medida;

                                        //Calculos
                                        $ProteinasReg      = '';
                                        $CarboidratosReg   = '';
                                        $LipideosReg       = '';
                                        $CaloriasReg       = '';
                                        
                                        //Macros
                                        $QuantidadeTotal += $QuantidadeReg;

                                        if($Calorias>0){
                                            $CaloriasReg = ($Calorias*$QuantidadeReg)/$Porcao;
                                            $CaloriasTotal += $CaloriasReg;
                                        }
                                        if($Proteinas>0){
                                            $ProteinasReg = ($Proteinas*$QuantidadeReg)/$Porcao;
                                             $ProteinasTotal += $ProteinasReg;
                                        }
                                        if($Carboidratos>0){
                                            $CarboidratosReg = ($Carboidratos*$QuantidadeReg)/$Porcao;
                                             $CarboidratosTotal += $CarboidratosReg;
                                        }
                                        if($Lipideos>0){
                                            $LipideosReg = ($Lipideos*$QuantidadeReg)/$Porcao;
                                             $LipideosTotal += $LipideosReg;
                                        }
                                        
                                        //Micros
                                        if($FibraAlimentar>0){
                                            $FibraAlimentarTotal += ($FibraAlimentar*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Acucar>0){                                            
                                            $AcucarTotal += ($Acucar*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Calcio>0){                                            
                                            $CalcioTotal += ($Calcio*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Colesterol>0){                                            
                                            $ColesterolTotal += ($Colesterol*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Ferro>0){                                            
                                            $FerroTotal += ($Ferro*$QuantidadeReg)/$Porcao;
                                        }
                                        if($GordMonoinsaturada>0){                                            
                                            $GordMonoinsaturadaTotal += ($GordMonoinsaturada*$QuantidadeReg)/$Porcao;
                                        }
                                        if($GordPoliInsaturada>0){                                            
                                            $GordPoliInsaturadaTotal += ($GordPoliInsaturada*$QuantidadeReg)/$Porcao;
                                        }
                                        if($GordSaturada>0){                                            
                                            $GordSaturadaTotal += ($GordSaturada*$QuantidadeReg)/$Porcao;
                                        }
                                        if($GordTrans>0){                                            
                                            $GordTransTotal += ($GordTrans*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Fosforo>0){                                            
                                            $FosforoTotal += ($Fosforo*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Magnesio>0){                                            
                                            $MagnesioTotal += ($Magnesio*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Manganes>0){                                            
                                            $ManganesTotal += ($Manganes*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Potassio>0){                                            
                                            $PotassioTotal += ($Potassio*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Selenio>0){                                            
                                            $SelenioTotal += ($Selenio*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Sodio>0){                                            
                                            $SodioTotal += ($Sodio*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaA>0){                                            
                                            $VitaminaATotal += ($VitaminaA*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB1>0){                                            
                                            $VitaminaB1Total += ($VitaminaB1*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB2>0){                                            
                                            $VitaminaB2Total += ($VitaminaB2*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB3>0){                                            
                                            $VitaminaB3Total += ($VitaminaB3*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB6>0){                                            
                                            $VitaminaB6Total += ($VitaminaB6*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB9>0){                                            
                                            $VitaminaB9Total += ($VitaminaB9*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaB12>0){                                            
                                            $VitaminaB12Total += ($VitaminaB12*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaC>0){                                            
                                            $VitaminaCTotal += ($VitaminaC*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaD>0){                                            
                                            $VitaminaDTotal += ($VitaminaD*$QuantidadeReg)/$Porcao;
                                        }
                                        if($VitaminaE>0){                                            
                                            $VitaminaETotal += ($VitaminaE*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Zinco>0){                                            
                                            $ZincoTotal += ($Zinco*$QuantidadeReg)/$Porcao;
                                        }
                                        if($Cobre>0){                                            
                                            $CobreTotal += ($Cobre*$QuantidadeReg)/$Porcao;
                                        }
									?>
                                        <tr>
											<td><?php echo $row['periodo'];?></td>
											<td><?php echo $row['alimento'];?></td>
                                            <td><?php echo $Medida;?></td>
                                            <td><?php echo $ProteinasReg;?></td>
                                            <td><?php echo $CarboidratosReg;?></td>
                                            <td><?php echo $LipideosReg;?></td>
                                            <td><?php echo $CaloriasReg;?></td>
                                            <td><?php echo $QuantidadeReg;?></td>
                                                                                    
											<td align="center" class="no-print">
                                                <button onclick="if (confirm('Confirma exclusão?')) { window.location.href='controller.php?action=excluir&codigo=<?php echo $codigo;?>&codigoPai=<?php echo $codigoPai; ?>'}" type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
                                                <button onclick="window.location.href='cadastro.php?action=editar&codigo=<?php echo $codigo;?>&codigoPai=<?php echo $codigoPai; ?>'" type="button" class="btn btn-success btn-xs" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"></span> </button>                                               
                                                
                                            </td>
                                        </tr>
								<?php } ?> 
                                    
                                        
                                </tbody>
                            </table></div>


                            
                               
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Macronutrientes Totais</a></h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">                                    
                                    <div class="table-responsive">
                                    <table id="tabletotaismacro " class="table">
                                        <tr><td>Proteinas:       <?php echo $ProteinasTotal;?>g</td>
                                            <td>Carboidratos:       <?php echo $CarboidratosTotal;?>g</td>
                                            <td>Lipideos:       <?php echo $LipideosTotal;?>g</td>
                                            <td>Calorias:       <?php echo $CaloriasTotal;?>g</td>
                                            <td>Quantidade:       <?php echo $QuantidadeTotal;?>g</td>
                                        </tr>

                                    </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Micronutrientes Totais</a></h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="table-responsive">
                                    <table id="tabletotaismicro" class="table">
                                        <tr><td>Açucar:       <?php echo $AcucarTotal;?>g</td>
                                            <td>Calcio:       <?php echo $AcucarTotal;?>g</td>
                                            <td>Cobre:       <?php echo $CobreTotal;?>g</td>
                                            <td>Colesterol:       <?php echo $ColesterolTotal;?>g</td>
                                            <td>GordMinsaturada:       <?php echo $GordMonoinsaturadaTotal;?>g</td>
                                        </tr>
                                        <tr><td>GordPInsaturada:       <?php echo $GordPoliInsaturada;?>g</td>
                                            <td>GordTrans:       <?php echo $GordTransTotal;?>g</td>
                                            <td>Fibra Alimentar:       <?php echo $FibraAlimentarTotal;?>g</td>
                                            <td>Fósforo:       <?php echo $FosforoTotal;?>g</td>
                                            <td>Magnésio:       <?php echo $MagnesioTotal;?>g</td>
                                        </tr>
                                        <tr><td>Manganês:       <?php echo $ManganesTotal;?>g</td>
                                            <td>Potássio:       <?php echo $PotassioTotal;?>g</td>
                                            <td>Selênio:       <?php echo $SelenioTotal;?>g</td>
                                            <td>Sódio:       <?php echo $SodioTotal;?>g</td>
                                            <td>VitaminaA:       <?php echo $VitaminaATotal;?>g</td>
                                        </tr>
                                        <tr><td>VitaminaB1:       <?php echo $VitaminaB1Total;?>g</td>
                                            <td>VitaminaB2:       <?php echo $VitaminaB2Total;?>g</td>
                                            <td>VitaminaB3:       <?php echo $VitaminaB3Total;?>g</td>
                                            <td>VitaminaB6:       <?php echo $VitaminaB6Total;?>g</td>
                                            <td>VitaminaB9:       <?php echo $VitaminaB9Total;?>g</td>
                                        </tr>
                                        <tr><td>VitaminaB12:       <?php echo $VitaminaB12Total;?>g</td>
                                            <td>VitaminaC:       <?php echo $VitaminaCTotal;?>g</td>
                                            <td>VitaminaD:       <?php echo $VitaminaDTotal;?>g</td>
                                            <td>VitaminaE:       <?php echo $VitaminaETotal;?>g</td>
                                            <td>Zinco:       <?php echo $ZincoTotal;?>g</td>
                                        </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-md-12" align="center">
                    <a href="../pessoas/index.php"><input class="btn btn-default btn-md" type="button" value="Voltar"/></a>
                </div>
            </div>			
        </div>
        <script>
            $(document).ready(function() {
                var table = $('#table').DataTable( {
                    "ordering": false,
                    "paging": false,
                    "info": false
                }); 
            } );
        </script>      
        <div class="container-fluid no-print">
            <div class="panel-footer">
                <strong>Faculdade Anhanguera de Pelotas/RS  <i class="glyphicon glyphicon-copyright-mark"></i></strong>
            </div>            
        </div>
    </body>
</html>