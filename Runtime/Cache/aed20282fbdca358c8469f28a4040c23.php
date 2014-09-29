<?php if (!defined('THINK_PATH')) exit();?><ul>
<li><a href="<?php echo U('Index/registerView');?>">注册</a></li>
<li><a href="<?php echo U('Index/loginView');?>">登录</a></li>
<li><a href="<?php echo U('Index/logOut');?>">注销</a></li>
</ul>
会员在线：<?php echo ($member_online_sum); ?>
游客在线：
<br><br>
<?php if(($type == 1)): ?>会员：<?php echo ($_SESSION["name"]); ?>    谢谢你登录了我们网站！您已经登录 <?php echo ($login_times); ?> 次，   共登录 <?php echo ($login_total_times); ?>分钟 
 <?php else: ?> 你好，陌生人！你没有登录，或者你还没有注册，但是你已经浏览这个页面 {M} 分钟了。<?php endif; ?>