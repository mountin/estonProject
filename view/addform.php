<?php
/**
 * Created by PhpStorm.
 * User: mountin
 */
?>

<form name="form1" method="post" action="?action=<?php echo empty($contactInfo[0]['id'])?'addcontact':'editcontact';?>&id=<?php echo $contactInfo[0]['id']?>">
    <p><b>ID:</b><br>
        <input type="text" size="40" name="id" readonly value="<?php echo $contactInfo[0]['id']?>">
    </p>

    <p><b>Name:</b><br>
        <input type="text" size="40" name="name" value="<?php echo $contactInfo[0]['name']?>">
    </p>

    <p><b>Email:</b><br>
        <input type="text" size="40" name="email" value="<?php echo $contactInfo[0]['email']?>">
    </p>
    <p><b>Password:</b><br>
        <input type="password"  size="40" name="pass">
    </p>
    <p>Parent<Br>
        <select name="parent" cols="40" rows="3">
            <option value="0">not have parrent!</option>
            <?php foreach ($contacts as $parent):?>
                <option value="<?php echo $parent['id'] ?>" <?php echo ($parent['id'] == $contactInfo[0]['parentId'])?'selected':''?>><?php echo $parent['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>


    <p>Position<Br>
        <select name="position" cols="40" rows="3">
            <option value="0">not admin!</option>
            <?php foreach ($positions as $position):?>
                <option value="<?php echo $position['id'] ?>" <?php echo ($position['id'] == $contactInfo[0]['positionId'])?'selected':''?>><?php echo $position['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>


    <p>Assignment<Br>
        <select name="auth" cols="40" rows="3">
            <option value="null">not admin!</option>
            <?php foreach ($auths as $auth):?>
                <option value="<?php echo $auth['id'] ?>" <?php echo ($auth['id'] == $contactInfo[0]['rId'])?'selected':''?> ><?php echo $auth['rolename'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>


    <p><input type="submit" value="Send">
        <input type="reset" value="Clear"></p>
</form>