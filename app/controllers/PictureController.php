<?php
/**
 * =============================
 * 
 * 图片操作 -控制器
 * 
 * =============================
 */
class PictureController extends Phalcon\Mvc\Controller 
{

	public function indexAction()
	{

	}
	//添加图片页面
	public function addPictureAction(){
		//添加人
		$model=new UserModel();
		$value=$model->getUserInfo(2);
		//添加人的ip
		$ip=ip2long($_SERVER["REMOTE_ADDR"]);
		$value['userIp']=$ip;
		$this->view->setVar("userInfo", $value);
		//所属场地
		$stadium=new StadiumModel();
		$stadiumList=$stadium->getStadiumNameList();
		$this->view->setVar("stadiumList", $stadiumList);
		
		
	}
	//添加图片功能
	public function addPictureFuncAction(){
	$response = new Phalcon\Http\Response();
	$addUser=$this->request->getPost('userId');
	$addIp=$this->request->getPost('userIp');
	$stadiumId=$this->request->getPost('stadiumId');
	$isCover=$this->request->getPost('isCover');
	$addTime=time();
	$picUrl=time().'.jpg';
	if($this->request->hasFiles()==true && $stadiumId!=''){
	//上传图片
	 //if ($this->request->hasFiles() == true) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $file->moveTo('images/' . $picUrl);
            }
       // }
	 	$picture = new PictureModel();
		//图片数据
		$data=array('addUser'=>$addUser,'addIp'=>$addIp,'addTime'=>$addTime,'stadiumId'=>$stadiumId,'isCover'=>$isCover,'picUrl'=>$picUrl);
		$result=$picture->insertPicInfo($data);
		if($result){
			//保存操作记录
			$log=new LogModel();
			//操作记录数据
			$log->insertLog($content='增加一张图片');
			
				$response->redirect("pictureList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				alert("添加成功");window.location.href="addPicture";
				</script>
				</body></html>');
				$response->send();
			 $this->flash->success('success');
		}
		else{
			$this->flash->error('error');
		}
		}
		else{
			$response->redirect("pictureList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				alert("添加失败，请上传图片");window.location.href="addPicture";
				</script>
				</body></html>');
				$response->send();
		}
	}
	//图片列表
	public function pictureListAction(){
		$model= new PictureModel();
		$value=$model->getAllPicInfo();
		foreach ($value as $key=>$values){
			$value[$key]['isCover']=$value[$key]['isCover']==1?'是':'否';
		}
		$jsonData=json_encode($value);
		
		$this->view->setVar('jsonData',$jsonData);
		
	}
	//图片信息修改页面
	public function editPictureAction(){
		if($this->request->getPost('sub')==''){
			$picId=$this->request->get('id');
			$stadium= new StadiumModel();
			$stadiumList=$stadium->getStadiumNameList();
			$this->view->setVar('stadiumList',$stadiumList);
			$picture= new PictureModel();
			$pictureInfo=$picture->findFirst('picId='.'"'.$picId.'"')->toArray();
			$this->view->setVar('pictureInfo',$pictureInfo);
		}
		else{
			$picture= new PictureModel();
			$picture->stadiumId=$this->request->getPost('stadiumId');
			$picture->userId=$this->request->getPost('userId');
			$picture->userIp=$this->request->getPost('userIp');
			$picUrl=time().'.jpg';
			if ($this->request->hasFiles() == true) {
            	foreach ($this->request->getUploadedFiles() as $file) {
               		 $file->moveTo('images/' . $picUrl);
            	}
				//删除原图
				$oldpicurl=$this->request->getPost('oldpicUrl');
					if($oldpicurl!=''){
					$url='images/'.$oldpicurl;
					@unlink("$url");
				}
					$picture->picUrl=$picUrl;
			}
			else{
				$picture->picUrl=$this->request->getPost('oldpicUrl');
			}
			$picture->picId=$this->request->getPost('picId');
			//var_dump($picture->picUrl);die();
			$res=$picture->update();
			if($res){
				$log=new LogModel();
			//操作记录数据
				$log->insertLog($content='修改图片信息');
				$response = new Phalcon\Http\Response();
				$response->redirect("pictureList",true);
				$response->setStatusCode(200, "OK");
				$response->setContent('<html><body>
				<script language="JavaScript">
				window.parent.location.reload();
				</script>
				</body></html>');
				$response->send();
			}
			else{
				
			}
			die();
		}
		
	}
	//图片信息修改功能
	public function editPicInfoFuncAction(){
		
	}
	//图片删除功能
	public function deletePicAction(){
		$picId=$this->request->get('id');
		$model= new PictureModel();
		$model->picId=$picId;
		//删除图片资源
		$array=$model->findFirst('picId="'.$picId.'"')->toArray();
		$url='images/'.$array["picUrl"];
		$resouse=@unlink("$url");
		//删除图片信息
		$res=$model->delete();
		if($resouse&&$res){
			$log=new LogModel();
			//操作记录数据
			$log->insertLog($content='删除一张图片');
			echo '1';
		}
		else{
			echo '图片资源可能已不存在，将删除本条数据';
		}
		die();
	}
}
