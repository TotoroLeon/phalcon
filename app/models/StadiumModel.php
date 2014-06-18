<?php

class StadiumModel extends Phalcon\Mvc\Model
{
	public $staId;
	public $belongComId;
	public $staPicture;
	public $staName;
	public $staAddress;
	public $staSize;
	public $gpsLong;
	public $gpsDim;
	public $addUser;
	public $addIp;
	public $addTime;
	public $modelsManager;
	
	public function initialize()
    {
    	$this->setSource("ten_stadium");
		$this->modelsManager=$this->getDI()->get('modelsManager');
        
    }
	public function getStadiumList(){
		//return $this->userName;
		$stadium = $this->modelsManager->createBuilder()
		->columns('staId,staName,staPicture,picUrl,staAddress,staSize,companyName')
		->from('StadiumModel')
		->join('CompanyModel','CompanyModel.companyId=StadiumModel.belongComId')
		->join('PictureModel','PictureModel.picId=StadiumModel.staPicture')
		->orderby('staId')
		->getQuery()
		->execute()
		->toArray();
		return $stadium;
	}
	//返回场地列表（一维）
	public function getStadiumNameList(){
		$stadiums= StadiumModel::find(array("columns"=>"staId,staName"))
		->toArray();
		$array=array();
		foreach ($stadiums as $stu) {
    		$array[$stu['staId']]=$stu['staName'];
		}
		return $array;
	}
}
