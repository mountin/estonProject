<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 25.02.15
 * Time: 1:42
 */?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body text="#ffffff" marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>

<table width="100%" height="100%" align=center valign=middle>
<tr><td valign=middle align=center>
<?php echo (!empty($wrongPass)?'<div style="color: red"> Your email or pasword is wrong</div>':'')?>
<form action="index.php?action=login" method=post>
<table border=0 cellspacing=0 cellpadding=0 width="170">
<tr bgcolor="#666666">
<td rowspan="7" width=4>&nbsp;</td>
<td height="18" valign="bottom">&nbsp;&nbsp;<font face="Verdana" size=2>login</font></td>
<td rowspan="7" width=4>&nbsp;</td>
</tr>
<tr bgcolor="#666666"><td><input type="text" name="LOGIN" size="13" style="width:160px;"></td></tr>
<tr bgcolor="#666666"><td height="18" valign="bottom">&nbsp;&nbsp;<font face="Verdana" size=2>password</font></td></tr>
<tr bgcolor="#666666"><td>
<input type="password" name="PASSWORD" size="13" style="width:160px;">
</td></tr>
<tr bgcolor="#666666"><td height=10>&nbsp;</td></tr>
<tr bgcolor="#666666"><td height="18" align="right">
<input type="submit" value=":: Enter ::"></td></tr>
<tr bgcolor="#666666"><td height=7>&nbsp;</td></tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>
