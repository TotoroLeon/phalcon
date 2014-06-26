<?php
use \Phalcon\Mvc\Model ;
class PictureModel extends Model
{
	public $picId;
	public $stadiumId;
	public $picName;
	public $isCover;
	public $picUrl;
	public $addUser;
	public $addTime;
	public $addIp;
	public $modelsManager;
	
	public function initialize()
    {
        $this->setSource("ten_picture");
		//$this->hasMany("stadiumId", "Stadium", "staId");
		$this->belongsTo("stadiumId", "StadiumModel", "staId");
		$this->modelsManager=$this->getDI()->get('modelsManager');
		
    }
	
	public function insertPicInfo($date=array())
	{
		//return $this->userName;
		$this->stadiumId = $date['stadiumId'];
		$this->isCover = $date['isCover'];
		$this->picUrl = $date['picUrl'];
		$this->addUser = $date['addUser'];
		$this->addTime = $date['addTime'];
		$this->addIp = $date['addIp'];
		$result = $this->save();
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function getAllPicInfo($stadiumName)
	{
		$condition = '';
		$condition.="1=1 ";
		if ($stadiumName!='')
		{
			$condition.=' and stadiumId ="'.$stadiumName.'"';
		}
		$result = $this->modelsManager->createBuilder()
			->columns('picId,staName,isCover,picUrl')
		    ->from('PictureModel')
		    ->join("StadiumModel",'StadiumModel.staId=PictureModel.stadiumId')
			->where("$condition")
			->orderby('picId')
		    ->getQuery()
		    ->execute()->toArray();	
		//	echo '<pre>';var_dump($result);die();
		return $result;	
	}
	/**
	 * return  statiumId  picId  picUrl
	 */
	public function staPicInfo()
	{
		$result=PictureModel::find(array("columns"=>"picId,stadiumId,picUrl"))->toArray();		
		return $result;			
	}
}
