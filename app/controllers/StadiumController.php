<?php
/**
 * =============================
 * 
 * 场馆操作 -控制器
 * 
 * =============================
 */
class StadiumController extends Phalcon\Mvc\Controller 
{

	public function indexAction()
	{

	}
	//添加场馆页面
	
	public function addStadiumAction(){
		//添加人
		$model=new UserModel();
		$value=$model->getUserInfo(2);
		//添加人的ip
		$ip=ip2long($_SERVER["REMOTE_ADDR"]);
		$value['userIp']=$ip;
		$this->view->setVar("userInfo", $value);
		//所有公司
		$company=new CompanyModel();
		$companylist=$company->CompanyListOne();
		$this->view->setVar('companyList',$companylist);
	}
	//添加场馆功能
	public function addStadiumFuncAction(){
		$model=new StadiumModel();
		$response = new Phalcon\Http\Response();
		$time=time();
		$model->belongComId=$this->request->getPost('belongComId');
		$model->addUser=$this->request->getPost('addUser');
		$model->addIp=$this->request->getPost('addIp');
		$model->staName=$this->request->getPost('staName');
		$model->staAddress=$this->request->getPost('staAddress');
		$model->staSize=$this->request->getPost('staSize');
		$model->gpsLong=$this->request->getPost('gpsLong');
		$model->gpsDim=$this->request->getPost('gpsDim');
		$model->addTime=$time;
		if($model->staName!=''&&$model->belongComId!=""&&$model->staAddress!=""){
			$model->save();
			if($model->staId){		
			// 保存图片
			if ($this->request->hasFiles() == true) {
	            foreach ($this->request->getUploadedFiles() as $file) {
	                $file->moveTo('images/' . $time.'.jpg');
	            }
	        }
        	$picture = new PictureModel();
			//图片数据
			$data=array('addUser'=>$model->addUser,'addIp'=>$model->addIp,'addTime'=>$model->addTime,'stadiumId'=>$model->staId,'isCover'=>'1','picUrl'=>$time.'.jpg');
			$result=$picture->insertPicInfo($data);
			$picture->save();
			$model->staPicture=$picture->picId;
			$check=$model->update();
			if($check){
			$log=new LogModel();
			//操作记录数据
				$log->insertLog($content='添加场馆，添加封面');
				$response->redirect("pictureList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				alert("添加成功");window.location.href="addStadium";
				</script>
				</body></html>');
				$response->send();
			}
		}
		else{
		    $this->flash->success('false');
		}
		}
		else{
		$response->redirect("pictureList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				alert("添加失败，数据不完整！（名称地址为必填项）");window.location.href="addStadium";
				</script>
				</body></html>');
				$response->send();
		}
		
	}
	//场馆列表
	public function stadiumListAction(){
		//场馆信息
		$model=new StadiumModel();
		$data=$model->getStadiumList();
		//公司信息
		$companyList=new CompanyModel();
		$array=$companyList->companyList();
		//图片列表
		$picture= new PictureModel();
		$pictureList=$picture->staPicInfo();
		//echo json_encode($pictureList); die();
		$this->view->setVar('pictureList',json_encode($pictureList));
		$comList=json_encode($array);
		$this->view->setVar('companyList',$comList);
		$jsonData=json_encode($data);
		$this->view->setVar('jsonData',$jsonData);
		
	}
	//场馆修改页面
	public function editStadiumAction(){
		//$response = new \Phalcon\Http\Response();
		if($this->request->getPost('sub')==''){
		$model=new StadiumModel();
		$staId=$this->request->get('id');
		$staInfo=$model->findFirst('staId='.'"'.$staId.'"'.'')->toArray();
		//公司信息
		$company=new CompanyModel();
		$companyInfo=$company->CompanyListOne();
		//图片信息
		$picture= new PictureModel();
		$pictureInfo=$picture->find('stadiumId='.'"'.$staId.'"'.'')->toArray();;
		$this->view->setVar('staInfo',$staInfo);
		//echo '<pre>';var_dump($staInfo);die();
		$this->view->setVar('companyInfo',$companyInfo);
		//echo '<pre>';var_dump($companyInfo);
		$this->view->setVar('pictureInfo',$pictureInfo);
		//echo '<pre>';var_dump($pictureInfo);
		}
		else{
		$models=new StadiumModel();
		$time=time();
		$models->staId=$this->request->getPost('staId');
		$models->belongComId=$this->request->getPost('belongComId');
		$models->addUser=$this->request->getPost('addUser');
		$models->addIp=$this->request->getPost('addIp');
		$models->staName=$this->request->getPost('staName');
		$models->staPicture=$this->request->getPost('staPicture');
		$models->staAddress=$this->request->getPost('staAddress');
		$models->staSize=$this->request->getPost('staSize');
		$models->gpsLong=$this->request->getPost('gpsLong');
		$models->gpsDim=$this->request->getPost('gpsDim');
		$models->addTime=$time;
		$result=$models->update();
		//echo '<pre>';var_dump($models);
		if($result){
			$log=new LogModel();
			//操作记录数据
				$log->insertLog($content='修改场馆信息');
			 	//$this->flash->success('success');
			 	//跳转
			 	//echo '<script>setTimeout("window.opener = "xxx";window.close();;",1000);</script>';
			 	
			 	$response = new Phalcon\Http\Response();
				$response->redirect("stadiumList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				window.parent.location.reload();
				</script>
				</body></html>');
				$response->send();
			 	
			 	//$response->redirect("stadiumList");
		}
		else{
		
		}
		die();
		}
		
	}
	//场馆修改功能
	public function editFuncAction(){
		
	}
	//场馆信息删除
	public function deleteStadiumAction(){
		$model=new StadiumModel();
		$staid=$this->request->getPost('id');
		$model->staId=$staid;
		//删除场馆
		$checkone=$model->delete();
		//删除场馆图片
		$picture= new PictureModel();
		$array=$picture->find('stadiumId="'.$staid.'"')->toArray();
		//var_dump($array);die();
		foreach ($array as $key => $value) {
				$url='images/'.$value["picUrl"];
				$resouse=@unlink("$url");
		}
		$picture->stadiumId=$staid;
		$checktwo=$picture->delete();
		
		if($checkone && $checktwo){
			$log=new LogModel();
			//操作记录数据
			$log->insertLog($content='删除场馆');
			echo '1';
		}
		else{
			echo '0';
		}
		die();
	}

}
