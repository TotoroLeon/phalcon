<?php
/**
 * =============================
 * 
 * 日志操作 -控制器
 * 
 * =============================
 */
 use Phalcon\Mvc\Controller;
class LogController extends Controller 
{
	public function initialize(){
		$userId=$this->session->get('userId');
		if(empty($userId)){
			echo '<script type="text/javascript">window.open("../TestLogin/userState","newwindow","height=100,width=400,top=300,left=500,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no");</script>';
			//$this->session->set('userId','1');
			die();
		}
	}

	public function indexAction()
	{

	}
	public function logListAction()
	{
		$model=new LogModel();
		//总条数
		//$countnum=$model->countlog();
		//当前页
		//if($this->request->get('currentPage')){
		//$currentpage=$this->request->get('currentPage');
		//}
		//else{
		//	$currentpage='0';
		//}
		//总页数
		//$countpage=ceil($countnum/$pagesize);
		//$pagesize=20;
		$data = $model->logList();
		foreach ($data as $key=>$value)
		{
		    $data[$key]['insertIp'] = long2ip($value['insertIp']);
			$data[$key]['insertTime'] = date("Y-m-d H:i:s",$value['insertTime']);
		}
		
		$jsonData = json_encode($data);
		$this->view->setVar('jsonData',$jsonData);

	}

}
