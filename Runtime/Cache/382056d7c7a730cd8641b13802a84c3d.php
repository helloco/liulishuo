<?php if (!defined('THINK_PATH')) exit();?><html>
<form  action="<?php echo U('Index/register');?>" method="post">
name: 
<input type="text" name="name" />
<br />
pwd: 
<input type="password" name="pwd" />
<br />
confirm pwd: 
<input type="password" name="pwd2" />

<br />
<input type="submit" value="submit">
</form>

</html>