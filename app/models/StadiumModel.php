<?php
use Phalcon\Mvc\Model\Validator\PresenceOf;
use	Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
use Phalcon\Mvc\Model\Validator\Numericality as NumericalityValidator;
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
	public function getStadiumList($stadiumName,$stadiumAddress,$belongComId)
	{
		$condition.="1=1 ";
		if(!empty($stadiumName))
		{
			$condition.=' and staName like "%'.$stadiumName.'%"';
		}
		if(!empty($stadiumAddress))
		{
			$condition.=' and staAddress like "%'.$stadiumAddress.'%"';
		} 
		if(!empty($belongComId))
		{
			$condition.=' and belongComId ="'.$belongComId.'"';
		}
		//return $this->userName;
		//echo $condition;doe();
		$stadium = $this->modelsManager->createBuilder()
		->columns('staId,staName,staPicture,picUrl,staAddress,staSize,companyName')
		->from('StadiumModel')
		->join('CompanyModel','CompanyModel.companyId=StadiumModel.belongComId')
		->join('PictureModel','PictureModel.picId=StadiumModel.staPicture')
		->where("$condition")
		->orderby('staId')
		->getQuery()
		->execute()
		->toArray();
		return $stadium;
	}
	//返回场地列表（一维）
	public function getStadiumNameList()
	{
		$stadiums= StadiumModel::find(array("columns"=>"staId,staName"))
		->toArray();
		$array=array();
		foreach ($stadiums as $stu) {
    		$array[$stu['staId']]=$stu['staName'];
		}
		return $array;
	}
	public function checkstaName()
	{
		$this->validate(new PresenceOf(array(
          'field' => 'staName',
          'message' => '场馆名称不可为空!'
      )));
	  $this->validate(new Uniqueness(
            array(
                "field"   => "staName",
                "message" => "名称重复,请重新添加!"
            )
        ));
	  
	  $this->validate(new StringLengthValidator(array(
			'field' => 'staName',
            'max' => 30,
            'min' => 2,
            'messageMaximum' => '您的输入的场馆名称超出长度限制！',
            'messageMinimum' => '您输入的场馆名称太短！'
		)));
		return $this->validationHasFailed() != true;
	}

	public function checkstaAddress()
	{
		$this->validate(new PresenceOf(array(
          'field' => 'staAddress',
          'message' => '场馆地址不可为空!'
      )));
	  $this->validate(new StringLengthValidator(array(
			'field' => 'staAddress',
            'max' => 100,
            'min' => 6,
            'messageMaximum' => '您的输入的场馆地址超出长度限制！',
            'messageMinimum' => '您输入的场馆地址太短！'
		)));
	  return $this->validationHasFailed() != true;
	}
	public function checkLong()
	{
	  $this->validate(new NumericalityValidator(array(
          'field' => "gpsLong",
          'message'=>'经度必须为数字!'
      )));
		return $this->validationHasFailed() != true;
	}
	public function checkDim()
	{
		$this->validate(new NumericalityValidator(array(
          'field' => "gpsDim",
          'message'=>'纬度必须为数字!'
      )));
	  return $this->validationHasFailed() != true;
	}
	
}
