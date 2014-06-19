<?php
/**
 * =============================
 * 
 * 日志操作 -控制器
 * 
 * =============================
 */
class LogController extends Phalcon\Mvc\Controller 
{

	public function indexAction()
	{

	}
	public function logListAction()
	{
		$model=new LogModel();
		$data=$model->logList();
		foreach ($data as $key=>$value){
				$data[$key]['insertIp']=long2ip($value['insertIp']);
				$data[$key]['insertTime']=date("Y-m-d H:i:s",$value['insertTime']);
		}
		
		$jsonData=json_encode($data);
		//var_dump($data);die();
		$this->view->setVar('jsonData',$jsonData);		
	}

}
