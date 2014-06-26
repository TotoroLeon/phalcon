<?php
use Phalcon\Mvc\Controller;
class IndexController extends Controller 
{
	public function initialize(){
		// $userId=$this->session->get('userId');
		// if(empty($userId)){
			// $this->loginAction();
		// }
		// else{
			// $this->indexAction();
		// }
		//$userId=$this->session->get('userId');
		//if(empty($userId)){
		//	echo '<script type="text/javascript">window.open("TestLogin/userState","newwindow","height=100,width=400,top=300,left=500,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no");</script>';
			//$this->session->set('userId','1');
		//	die();
		//}
	}

	public function indexAction()
	{
		//echo die();
		$userId = $this->session->get('userId');
		$this->view->setVar('userId',$userId);
		/*
		$usermodel=new UserModel();
		$value=$usermodel->getUserInfo();
		$power=$value['userPower'];
		$array=explode(',', $power);
		$menuModel= new MenuModel();
		//查看menu
		$menuInfo=array();
		//父级导航
		$parentMenuInfo=$menuModel->getParentInfo($power);
		//子级导航
		//foreach ($parentMenuInfo as $key => $value) {
		//	$sonMenuInfo[]=$menuModel->getSonInfo($value['mId'], $power);			
		//}
		////合并导航
		$result=array();
		$i=0;
		foreach ($parentMenuInfo as $key => $value) {			
			$result[$i]['text']=$value['menuName'];
			$result[$i]['isexpand']='false';
			//子导航
			$sonMenu=$menuModel->getSonInfo($value['mId'], $power);
			if($sonMenu)
			{
				foreach($sonMenu as $keys=>$values)
				{
					$result[$i]['children'][]['url']=$values['menuLink'];
					$result[$i]['children'][]['text']=$values['menuName'];
				}
			}
			$i++;
		}
		
		echo json_encode($result);die();
		
		echo '<pre>'; print_r($result);die();
		
		$this->view->setVar('parentMenu',$parentMenuInfo);
		$this->view->setVar('menuList',$menuList);
		/*
		echo '<pre>';print_r($menuInfo);die();*/
		if ( $this->request->get('menu')!='' )
		{
			$menu=$this->request->get('menu');
		}
		else
		{
			$menu='0';
		}
		$this->view->setVar('menu',$menu);
	}

}
