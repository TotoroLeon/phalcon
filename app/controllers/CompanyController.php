<?php
/**
 * =============================
 * 
 * 公司操作 -控制器
 * 
 * =============================
 */
 use Phalcon\Mvc\Controller;
class CompanyController extends Controller 
{
	public function initialize()
	{
		
	}

	public function indexAction()
	{

	}
	//添加公司页面
	public function addCompanyAction()
	{
		
	}
	//添加公司功能
	public function addCompanyFuncAction()
	{
		$companyName = $this->request->getPost('companyName');
		$model = new CompanyModel();
		$model->companyName = $companyName;
		$res = $model->insertCompany();
		if($res == 'true')
		{
			$log = new LogModel();
			//操作记录数据
			$log->insertLog($this->session->get('userId'),$content='添加一个公司名称');
			echo '1';
		}
		else
		{
			echo $res;
		}
	}
	//公司列表
	public function companyListAction()
	{
		
		$model = new CompanyModel();
		if($this->request->getPost('search') AND $this->request->getPost('companyName'))
		{
			$data = $model->searchCompanyName($this->request->getPost('companyName'));
		}
		else
		{
			$data = $model->companyList();
		}
		$jsonData = json_encode($data);
		//die($jsonData);
		$this->view->setVar('jsonData',$jsonData);
	}
	//公司名称修改
	public function editCompanyAction()
	{
		$jsonData = $this->request->getPost('jsonData');	
		$result = "";	
		$array=json_decode($jsonData,true);
		foreach ($array as $value) {
			$model = new CompanyModel();
			$model->companyId = $value['companyId'];
			$model->companyName = $value['companyName'];
			if ($model->check($model->companyName)){
				$res = $model->update();
				$result = '1';
			}
			else{
				foreach ($model->getMessages() as $message) {
        		$result.= $message. "\n";
    			}
			}
		}
		if ($result=='1')
		{
			$log=new LogModel();
			//操作记录数据
			$log->insertLog($this->session->get('userId'),$content='修改公司名称');
			echo '1';
		}
		else
		{
			echo $result;
		}
		die();
		
	}
	//公司信息删除
	public function deleteCompanyAction()
	{
		$model=new CompanyModel();
		$model->companyId=$this->request->getPost('id');
		$result=$model->delete();
		if ($result)
		{
			$log=new LogModel();
			//操作记录数据
			$log->insertLog($this->session->get('userId'),$content='删除一个公司信息');
			echo '1';
		}
		else
		{
			echo '0';
		}
		die();
	}

}
