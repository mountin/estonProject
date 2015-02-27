<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 25.02.15
 * Time: 1:19
 */

?>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta charset="UTF-8">
</head>
<table width='100%' border='1' bordercolor="#cccccc" cellspacing='0' cellpadding='1' rules=rows frame=void class='arttable'>
    <tr bgcolor='#ececec' 1bgcolor='#99CC66' style="color:#e00000">

    <td align='left' nowrap><b>#</b> Hello, <?php echo $_SESSION['name']?> (<a href="?action=logout">Logout</a>)</td>
    <td width='100%'><div align='center'><b>List of Contacts</b></div></td>
    <td align='center' nowrap><b>Email</b></td>
    <td colspan='2' align='center'><a href='?action=addcontact'><b>Add new Contact</b></a></td>
    </tr>

    <?php foreach($contacts as $detail):?>
        <tr bgcolor='#ffffff'>

            <td align='left'><?php echo($detail["id"]); ?></td>

            <td align='center'><?php echo(stripslashes($detail["name"]));?></td>
            <td align='center'><?php echo(stripslashes($detail["email"]));?></td>
            <td width='60'><a href='?action=editcontact&id=<?php echo($detail["id"]); ?>'>Edit</a></td>
            <td width='60'><a href="javascript:if (confirm('Are you sure <?echo(stripslashes($row["heading"])); ?> ?')) {document.location = '?action=deletecontact&id=<?php echo($detail["id"]); ?>';}">Delete</a></td>
        </tr>
    <?php ENDFOREACH;?>
</table>
<br/><b>Tree example</b><br/>
<?php echo $contact->buildTree($contacts2, 0);?>
</body>
