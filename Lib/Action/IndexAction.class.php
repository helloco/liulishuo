<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		//   用户名  登录次数   登录时间
		
		session_start();
		$redis = new Redis();
		if (!$redis) {
			$this->redirect('/Public/error.html');
			exit();
		}
		$redis->connect('127.0.0.1',6379);
		if (!isset($_SESSION['name'])) {
			
			
			if (!$redis->exists('visitor_online_sum')) {
				$redis->set('visitor_online_sum',1);
			}else
				$redis->incr('visitor_online_sum');
			
			
		}else {
			$User = M('User');
			$res = $User->where("name='%s'",$_SESSION['name'])->select();
			$this->assign('type',1);
			$this->assign('login_times',$res[0]['login_times']+1);
			
			$data['login_times'] = $res[0]['login_times']+1;
			$User->where("name='%s'",$_SESSION['name'])->save($data);
			
			$this->assign('login_total_times',$res[0]['login_total_times']);
	
			if (!$redis->exists('member_online_sum')) {
				$redis->set('member_online_sum',1);
			}else
				$redis->incr('member_online_sum');
			
		}
		$this->assign('visitor_online_sum',$redis->get('visitor_online_sum'));
		$this->assign('member_online_sum',$redis->get('member_online_sum'));
    	$this->display('index');
    }
    
    public function registerView() {
    	$this->display('registerView');
    }
    
    public function loginView() {
    	$this->display('loginView');
    }
    
    public function register() {
    	 
    	$name = I('name','','htmlspecialchars');
    	$pwd = I('pwd','','htmlspecialchars');
    	$pwd2 = I('pwd2','','htmlspecialchars');
    	
    	if ($pwd != $pwd2) {
    		$this->error("密码不一致",'registerView');
    	}
    	$data = array(
    			'name' => $name,
    	);
    	$User = M('User');
    	$res = $User->where("name='%s'",$data)->select();
    	if ($res) {
    		$this->error("用户名已经存在",'registerView');;
    	}
    	$data = array(
    			'name' => $name,
    			'pwd' => md5($pwd),
    			'login_times' => 0,
    			'login_total_time' => 0,
    			
    	);
    	 
    	$res = $User->add($data);
    	
    	if ($res) {
    		session_start();
    		session('name',$name);
    	
    		$this->redirect('/Index/index');
    	}
    	 
    }
    public function login() {
    	if (!IS_POST)
    		_404('页面不存在',U('index'));
    	
    	$data = array(
    			'name' => I('name','','htmlspecialchars'),
    			'pwd' => md5(I('pwd','','htmlspecialchars')),
    	);
    	$Admin = M('User');
    	$res = $Admin->where("name='%s' and pwd='%s'",$data)->select();
    	if ($res) {
    		session_start();
    		session('name',$res[0]['name']);
    		
    		
    		$this->redirect('/Index/index');
    	}else {
    		session_destroy();
    		$this->error("用户名或者密码错误",'index');
    		
    	}
    }
    
    public function logout(){
    	$redis = new Redis();
    	if (!$redis) {
    		$this->redirect('/Public/error.html');
    		exit();
    	}
    	$redis->connect('127.0.0.1',6379);
    	$redis->decr('member_online_sum');
    	session_destroy();
    	$this->redirect('/Index/index');
    }
    
}