<?
 /* 
 Copyright 2000, 2001, 2002, 2003, 2004, 2005 Dataprev - Empresa de Tecnologia e Informa��es da Previd�ncia Social, Brasil

 Este arquivo � parte do programa CACIC - Configurador Autom�tico e Coletor de Informa��es Computacionais

 O CACIC � um software livre; voc� pode redistribui-lo e/ou modifica-lo dentro dos termos da Licen�a P�blica Geral GNU como 
 publicada pela Funda��o do Software Livre (FSF); na vers�o 2 da Licen�a, ou (na sua opni�o) qualquer vers�o.

 Este programa � distribuido na esperan�a que possa ser  util, mas SEM NENHUMA GARANTIA; sem uma garantia implicita de ADEQUA��O a qualquer
 MERCADO ou APLICA��O EM PARTICULAR. Veja a Licen�a P�blica Geral GNU para maiores detalhes.

 Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral GNU, sob o t�tulo "LICENCA.txt", junto com este programa, se n�o, escreva para a Funda��o do Software
 Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
session_start();
	$v_id_software = $_GET['id_software'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Relat&oacute;rio de Altera&ccedil;&otilde;es de Hardware</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="5">
<table border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#999999">
  <tr bgcolor="#E1E1E1"> 
    <td rowspan="5" bgcolor="#FFFFFF"><img src="../../../imgs/cacic_novo.gif" width="50" height="50"></td>
    <td rowspan="5" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#E1E1E1"> 
    <td nowrap bgcolor="#FFFFFF"><div align="center"><font color="#333333" size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CACIC - Relatorio de Aquisi&ccedil;&otilde;es de Software Particular</strong></font></div></td>
  </tr>
  <tr> 
    <td height="1" bgcolor="#333333"></td>
  </tr>
  <tr> 
    <td><p><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
        em <? echo date("d/m/Y �\s H:i"); ?></font></p></td>
  </tr>
</table>
<br>
<br>
<br>
<br>
<? 
require_once('../../../include/library.php');
conecta_bd_cacic();
	
	$query = "SELECT s.nm_software, SUM(ai.qt_licenca) as qtde 
		FROM softwares s, aquisicoes_item ai, aquisicoes a 
		WHERE (s.id_software = " . $v_id_software . ") AND 
		      (s.id_software = ai.id_software) AND 
		      (a.id_aquisicao = ai.id_aquisicao) AND 
		      (a.nm_proprietario IS NOT NULL) 
		GROUP BY s.id_software";
	$result = mysql_query($query) or die ('Erro no select'.$query);
	$row = mysql_fetch_row($result);

echo '<table border="0" align="center" width="80%">
<tr><td align="left" nowrap><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Software: '.$row[0].'</strong></font></td>
<td align="right" nowrap><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Licen&ccedil;as: '.$row[1].'</strong></font></td></tr>
</table><br>';

	$query =  "SELECT a.id_aquisicao, a.dt_aquisicao, a.nr_processo, ai.qt_licenca, tl.te_tipo_licenca, s.nm_software, s.qt_licenca, ai.te_obs, a.nm_proprietario   
		FROM aquisicoes a, aquisicoes_item ai, softwares s, tipos_licenca tl  
		WHERE (ai.id_aquisicao = a.id_aquisicao) AND  
			(ai.id_software = s.id_software) AND 
			(ai.id_tipo_licenca = tl.id_tipo_licenca) AND 
			(ai.id_software = " . $v_id_software . ") AND 
			(a.nm_proprietario IS NOT NULL)  
		ORDER BY a.id_aquisicao"; 
	
	$result = mysql_query($query) or die ('Erro no select');

$cor = 0;
$num_registro = 1;

$fields=mysql_num_fields($result);
echo '<table align="center" width="80%" cellpadding="2" cellspacing="0" border="1" bordercolor="#999999" bordercolordark="#E1E1E1">
     <tr bgcolor="#E1E1E1" >
      <td nowrap align="left"><font size="1" face="Verdana, Arial">&nbsp;</font></td>';
echo '<td nowrap align="center"><b><font size="1" face="Verdana, Arial">Processo</font><b></td>';
echo '<td nowrap align="center"><b><font size="1" face="Verdana, Arial">Aquisi&ccedil;&atilde;o</font><b></td>';
echo '<td nowrap align="center"><b><font size="1" face="Verdana, Arial">Licen&ccedil;as</font><b></td>';
echo '<td nowrap align="center"><b><font size="1" face="Verdana, Arial">Tipo Licen&ccedil;a</font><b></td>';
echo '<td nowrap align="center"><b><font size="1" face="Verdana, Arial">Observa&ccedil;&atilde;o</font><b></td>';

echo '</tr>';


while ($row = mysql_fetch_row($result)) { //Table body
    echo '<tr ';
	if ($cor) { echo 'bgcolor="#E1E1E1"'; } 
	echo '>';
    echo '<td nowrap align="right"><font size="1" face="Verdana, Arial">' . $num_registro . '</font></td>';
    echo '<td nowrap align="center"><font size="1" face="Verdana, Arial"><a href="softwares_aquisicao.php?id_aquisicao=' . $row[0] . '&nr_processo=' . $row[2] . '&nm_proprietario=' . $row[8] . '" target="_blank"">' . $row[2] . '</a></td>';
    echo '<td nowrap align="center"><font size="1" face="Verdana, Arial"><a href="softwares_aquisicao.php?id_aquisicao=' . $row[0] . '&nr_processo=' . $row[2] . '&nm_proprietario=' . $row[8] . '" target="_blank"">' . date("d/m/Y", strtotime($row[1])) . '</a></td>';
    echo '<td nowrap align="center"><font size="1" face="Verdana, Arial">' . $row[3] .'&nbsp;</td>';
    echo '<td nowrap align="center"><font size="1" face="Verdana, Arial">' . $row[4] .'&nbsp;</td>';
    echo '<td nowrap align="center"><font size="1" face="Verdana, Arial">' . $row[7] .'&nbsp;</td>';
    $cor=!$cor;
	$num_registro++;
    echo '</tr>';
}
echo '</table>';
echo '<br><br>';

?></p>
<p></p>
<p align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Relat&oacute;rio 
  gerado pelo <strong>CACIC</strong> - Configurador Autom&aacute;tico e Coletor 
  de Informa&ccedil;&otilde;es Computacionais</font><br>
  <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Software desenvolvido 
  pela Dataprev - Escrit&oacute;rio do Esp&iacute;rito Santo</font></p>
</body>
</html>
