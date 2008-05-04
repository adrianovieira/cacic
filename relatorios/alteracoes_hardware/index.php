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

// Essa vari�vel � usada pelo arquivo de include selecao_redes_inc.php e inicio_relatorios_inc.php.
session_start();
/*
 * verifica se houve login e tamb�m regras para outras verifica��es (ex: permiss�es do usu�rio)!
 */
if(!isset($_SESSION['id_usuario'])) 
  die('Acesso negado!');
else { // Inserir regras para outras verifica��es (ex: permiss�es do usu�rio)!
}

$id_acao = 'cs_coleta_hardware';
require_once('../../include/inicio_relatorios_inc.php'); 
?>
 <script src="../../include/sniffer.js" type="text/javascript" language="javascript"></script>
 <script src="../../include/dyncalendar.js" type="text/javascript" language="javascript"></script>
 <link href="../../include/dyncalendar.css" media="screen" rel="stylesheet">

<table width="90%" border="0" align="center">
  <tr> 
    <td class="cabecalho">Relat&oacute;rio 
      de Altera&ccedil;&atilde;o de Hardware</td>
  </tr>
  <tr> 
    <td class="descricao">Este relat&oacute;rio 
      exibe as altera&ccedil;&otilde;es nas configura&ccedil;&otilde;es de hardware 
      dos computadores das redes selecionadas. &Eacute; poss&iacute;vel selecionar 
      os sistemas operacionais desejados e tamb&eacute;m determinar quais configura&ccedil;&otilde;es 
      de hardware ser&atilde;o exibidas no relat&oacute;rio.</td>
  </tr>
  <tr> 
    <td>
				</td>
  </tr>
</table>
<form action="rel_alteracoes_hardware.php" target="_blank" method="post" ENCTYPE="multipart/form-data" name="form1"   onsubmit="return valida_form()">
  <table width="90%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
	<?
	/*
	 if ($_SESSION['cs_nivel_administracao']==1 || $_SESSION['cs_nivel_administracao']==2)
  		{
	?>
<td valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="label">Selecione os locais:</td>
          </tr>
          <tr> 
            <td height="1" bgcolor="#333333"></td>
          </tr>
          <tr> 
            <td height="1"><table border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td>&nbsp;&nbsp;</td>
                  <td class="cabecalho_tabela"><div align="left">Dispon&iacute;veis:</div></td>
                  <td>&nbsp;&nbsp;</td>
                  <td width="40">&nbsp;</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                  <td nowrap class="cabecalho_tabela">Selecionados:</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td> <div align="left"> 
                      <select multiple name="list11[]" size="10"  class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" >
                        <?
                        $query = "SELECT 	id_local,
											sg_local
                                  FROM 		locais
                                  ORDER BY	sg_local";
                        $result = mysql_query($query) or die('Erro na consulta � tabela "locais".');
                        while ($row = mysql_fetch_array($result)) 
							{ 
                            echo '<option value=' . $row['id_local'] . '>' . $row["sg_local"] . '</option>';
                        	}
						?>
                      </select>
                      </div></td>
                  <td>&nbsp;</td>
                  <td width="40"> <div align="center"> 
                      <input type="button" value="   &gt;   " onClick="move(this.form.elements['list11[]'],this.form.elements['list12[]'])" name="B132">					  
                      <br>
                      <br>
                      <input type="button" value="   &lt;   " onClick="move(this.form.elements['list12[]'],this.form.elements['list11[]'])" name="B232">					  
                    </div></td>
                  <td>&nbsp;</td>
                  <td><select multiple name="list12[]" size="10" class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" >
                    </select></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td class="descricao">&nbsp;&nbsp;&nbsp;(Dica: 
              use SHIFT ou CTRL para selecionar m&uacute;ltiplos itens)</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
    </tr>	 
	<?
	}
	*/
	?>
      <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" align="center">
          <tr> 
            <td class="label" colspan="2">Selecione o per&iacute;odo em que dever&aacute; 
              ser realizada a consulta:</td>
          </tr>
          <tr> 
            <td height="1" bgcolor="#333333" colspan="2"></td>
          </tr>
          <tr valign="middle"> 
            <td width="33%" height="1" nowrap valign="middle"> <input name="date_input1" type="text" size="10"  class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" value="<? echo $date_input1;?>"> 
              <script type="text/javascript" language="JavaScript">
	<!--
	function calendar1Callback(date, month, year)	
		{
		document.forms['form1'].date_input1.value = date + '/' + month + '/' + year;
		}
  	calendar1 = new dynCalendar('calendar1', 'calendar1Callback');
	//-->
	</script> &nbsp; <font size="2" face="Verdana, Arial, Helvetica, sans-serif">a</font> 
              &nbsp;&nbsp; <input name="date_input2" type="text" size="10" class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" value="<? echo $date_input2;?>"> 
              <script type="text/javascript" language="JavaScript">
	<!--
	function calendar2Callback(date, month, year)	
		{
		document.forms['form1'].date_input2.value = date + '/' + month + '/' + year;
		}
  	calendar2 = new dynCalendar('calendar2', 'calendar2Callback');
	//-->
	</script> </td>
            <td align="left" class="descricao">&nbsp;&nbsp;(formato: dd/mm/aaaa)</td>
          </tr>
          <tr> 
            <td height="1" bgcolor="#333333" colspan="2"></td>
          </tr>
        </table>
        
      </td>
    </tr>
    <tr> 
      <td valign="top"> <p>&nbsp;</p></td>
    </tr>
    <tr> 
      <td valign="top"><table width="90%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td class="label">Selecione 
              as configura&ccedil;&otilde;es de hardware que deseja exibir:</td>
          </tr>
          <tr> 
            <td height="1" bgcolor="#333333"></td>
          </tr>
          <tr> 
            <td height="1"><table border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td>&nbsp;&nbsp;</td>
                  <td class="cabecalho_tabela"><div align="left">Dispon&iacute;veis:</div></td>
                  <td>&nbsp;&nbsp;</td>
                  <td width="40">&nbsp;</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                  <td nowrap class="cabecalho_tabela">Selecionados:</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td> <div align="left"> 
                      <select multiple name="list5[]" size="10"  class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" >
                        <? 	$query = "SELECT 	nm_campo_tab_hardware, 
												te_desc_hardware
								  	  FROM 		descricao_hardware 
									  ORDER BY 	te_desc_hardware";
						$result_hardwares_selecionados = mysql_query($query) or die('Ocorreu um erro durante a consulta � tabela descricao_hardware ou sua sess�o expirou!');
						/* Agora monto os itens do combo de hardwares selecionadas. */ 
       while($campos_hardwares_selecionados=mysql_fetch_array($result_hardwares_selecionados)) 	{
						   echo '<option value=", ' . $campos_hardwares_selecionados['nm_campo_tab_hardware'] . ' as &quot;' .  $campos_hardwares_selecionados['te_desc_hardware'] . '&quot;">' . $campos_hardwares_selecionados['te_desc_hardware']  . '</option>';
						}  ?>
                      </select>
                      </div></td>
                  <td>&nbsp;</td>
                  <td width="40"> <div align="center"> 
				  		<?
                      //<input type="button" value="   &gt;   " onClick="copia(this.form.elements['list5[]'],this.form.elements['list7[]']); move(this.form.elements['list5[]'],this.form.elements['list6[]'])" name="B132">
					  ?>
                      <input type="button" value="   &gt;   " onClick="move(this.form.elements['list5[]'],this.form.elements['list6[]'])" name="B132">					  
                      <br>
                      <br>
					  <?
                      //<input type="button" value="   &lt;   " onClick="exclui(this.form.elements['list6[]'],this.form.elements['list8[]']); exclui(this.form.elements['list6[]'],this.form.elements['list7[]']); move(this.form.elements['list6[]'],this.form.elements['list5[]'])" name="B232">
					  ?>
                      <input type="button" value="   &lt;   " onClick="move(this.form.elements['list6[]'],this.form.elements['list5[]'])" name="B232">					  
                    </div></td>
                  <td>&nbsp;</td>
                  <td><select multiple name="list6[]" size="10" class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" >
                    </select></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td class="descricao">&nbsp;&nbsp;&nbsp;(Dica: 
              use SHIFT ou CTRL para selecionar m&uacute;ltiplos itens)</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top"> <p>&nbsp;</p></td>
    </tr>
<?	
/*	
    <tr> 
      <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td class="label">Selecione 
              as configura&ccedil;&otilde;es de hardware para estat&iacute;sticas:</td>
          </tr>
          <tr> 
            <td height="1" bgcolor="#333333"></td>
          </tr>
          <tr> 
            <td height="1"><table border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td>&nbsp;&nbsp;</td>
                  <td class="cabecalho_tabela"><div align="left">Dispon&iacute;veis:</div></td>
                  <td>&nbsp;&nbsp;</td>
                  <td width="40">&nbsp;</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                  <td nowrap class="cabecalho_tabela">Selecionados:</td>
                  <td nowrap>&nbsp;&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td> <div align="left"> 
                      <select multiple name="list7[]" size="10"  class="normal" onFocus="SetaClassDigitacao(this);" onBlur="SetaClassNormal(this);" >
					  </select>
                      </div></td>
                  <td>&nbsp;</td>
                  <td width="40"> <div align="center"> 
                      <input type="button" value="   &gt;   " onClick="move(this.form.elements['list7[]'],this.form.elements['list8[]'])" name="B132">
                      <br>
                      <br>
                      <input type="button" value="   &lt;   " onClick="move(this.form.elements['list8[]'],this.form.elements['list7[]'])" name="B232">
                    </div></td>
                  <td>&nbsp;</td>
                  <td><select multiple name="list8[]" size="10">
                    </select></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td class="descricao">&nbsp;&nbsp;&nbsp;(Dica: 
              use SHIFT ou CTRL para selecionar m&uacute;ltiplos itens)</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
    </tr>
	*/
	?>	
    <tr> 
      <td valign="top"> 
        <?  $v_require = '../../include/' .($_SESSION['cs_nivel_administracao']<>1 && $_SESSION['cs_nivel_administracao']<>2?'selecao_redes_inc.php':'selecao_locais_inc.php');
		require_once($v_require);		
		?>

      </td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top"> 
        <?  require_once('../../include/selecao_so_inc.php');		?>
      </td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top"> <br> <br> <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td height="1" bgcolor="#333333"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td> <div align="center"> 
				<?
                //<input name="submit" type="submit" value="        Gerar Relat&oacute;rio      " onClick="SelectAll(this.form.elements['list2[]']), SelectAll(this.form.elements['list4[]']), SelectAll(this.form.elements['list6[]']), SelectAll(this.form.elements['list8[]'])">
				?>
                <input name="submit" type="submit" value="        Gerar Relat&oacute;rio      " onClick="ChecaTodasAsRedes(),<? echo ($_SESSION['cs_nivel_administracao']<>1 && $_SESSION['cs_nivel_administracao']<>2?"SelectAll(this.form.elements['list2[]'])":"SelectAll(this.form.elements['list12[]'])")?>, 
																										 SelectAll(this.form.elements['list4[]']), 
																										 SelectAll(this.form.elements['list6[]'])">				
              </div></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
</body>
</html>
