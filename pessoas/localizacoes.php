<?phpinclude_once "../../includes/sessao.php";
$tipo 	  = verifString($_GET['tipo']);$EstadoID = verifString($_GET['EstadoID']);$CidadeID = verifString($_GET['CidadeID']);$DioceseID = verifString($_GET['DioceseID']);$estado = verifString($_GET['estado']);$cidade = verifString($_GET['cidade']);	switch($tipo)	{
		case 'estado' :
			$sql = "SELECT * FROM estados order by Nome";
			$option = 'o estado';
			$string = 'ID';
			break;
		case 'cidade' :
			$sql = "SELECT * FROM cidades where EstadoID=".$EstadoID." order by Nome";
			$option = 'a cidade';
			$string = 'ID';			
			break;
		case 'diocese' :
			$sql = "SELECT * FROM dioceses where EstadoID=".$EstadoID." order by Nome";	
			$option = 'a diocese';
			$string = 'ID';			
			break;		

		case 'cidadeString' :
			$sql = "SELECT A.* FROM cidades A, estados B where A.EstadoID=B.EstadoID and B.Sigla='".$estado."' order by A.Nome";
			$option = 'a cidade';
			$string = 'ID';			
			break;			
	}
	
	/* Executamos o SQL aqui */	//echo $sql;
	$consulta = mysql_query($sql);
	
	/* Iniciamos o resultado como null */
	$resultado = null;

	/* O primeiro option que vai aparecer já com o titulo dinâmico a partir de $option  */
	$resultado = "<option value='0'>Selecione $option</option>";

	
	/* Buscamos os resultados usando $c->string para identificar o ID dinamico pois varia, no caso temos iso3, uf, nome e nome  */
	while($row = mysql_fetch_array($consulta) ) {
		$flag = "";
		/* estado em edicao*/
		if ($tipo=='estado' and $EstadoID){
			$buscaEstado = mysql_query("select * from estados where ID='$EstadoID' and ID=$row[ID]");
			if (mysql_fetch_row($buscaEstado)){
				$flag = "selected";
			}			
		}
		
		/* cidade em edicao*/
		if ($tipo=='cidade' and $EstadoID and $CidadeID){
			$buscaCidade = mysql_query("select * from cidades where ID=$CidadeID and ID=$row[ID]");
			if (mysql_fetch_row($buscaCidade)){
				$flag = "selected";
			}		
		}		

		/* diocese em edicao*/
		if ($tipo=='diocese' and $EstadoID and $DioceseID) {
			$buscaDiocese = mysql_query("select * from dioceses where ID=$DioceseID and ID=$row[ID]");
			if (mysql_fetch_row($buscaDiocese)){
				$flag = "selected";
			}	
		}	

		
		
		/* diocese conforme codigo cidade */
		if ($tipo=='diocese' and $CidadeID) {
			$buscaDiocesaCid = mysql_query("select * from cidades where ID=$CidadeID and s_DioceseID=$row[ID]");
			if (mysql_fetch_row($buscaDiocesaCid)){
				$flag = "selected";
			}	
		}
		
		/* estado conforme sigla */
		if ($tipo=='estado' and $estado){
			$buscaEstadoStr = mysql_query("select * from estados where Sigla='$estado' and ID=$row[ID]");
			if (mysql_fetch_row($buscaEstadoStr)){
				$flag = "selected";
			}			
		}
		
		/* cidade conforme nome*/
		if ($tipo=='cidadeString'){
			$buscaCidadeStr = mysql_query("select * from cidades where nome='$cidade' and CidadeID=$row[ID]");
			if (mysql_fetch_row($buscaCidadeStr)){
				$flag = "selected";
			}			
		}		
		
		$resultado .= "<option value='$row[$string]' $flag>$row[Nome]</option>";
		
	}	
	
	/* Imprimimos o resultado */	print $resultado;	

?>	
