<?php
use Phalcon\Mvc\Controller;
class controllerBase extends Controller{
	
	public function initialize()
	{
		$userId=$this->session->get('userId');
		if(empty($userId)){
			echo '弹出框';
		}	
		else{
			return true;
		}
	}
}
