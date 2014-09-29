<?php
class CommonAction extends Action{
	public function _initialize(){
		session_start();
		if (!isset($_SESSION['name']) || !isset($_SESSION['pwd'])) {
			$this->redirect('Index/index');
		}
		
	}
}