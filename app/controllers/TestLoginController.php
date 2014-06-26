<?php
use \Phalcon\Mvc\Controller;
class TestLoginController extends Controller
{
	// public function initialize(){
		// $userId=$this->session->get('userId');
		// if(empty($userId)){
			// echo 'Please Login';
		// }
	// }
	
	public function UserstateAction()
	{
		$userId = $this->session->get('userId');
		if (empty($userId)){
			echo "403";die();
		}
	}
	public function loginAction()
	{
		$value = $this->request->getPost('userName');
		if($value)
		{
			echo '登录成功';die();
		}
	}
	public function logincheckAction()
	{
		$this->session->set('userId','1');
		echo '登录成功,请关闭窗口';die();
	}
}
