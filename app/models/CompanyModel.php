<?php
use Phalcon\Mvc\Model\Validator\PresenceOf;
use	Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
class CompanyModel extends Phalcon\Mvc\Model
{
	public $companyId;
	public $companyName;
	public function initialize()
    {
        $this->setSource("ten_company");
    }
    //插入公司名称
	public function insertCompany(){
		if($this->check($this->companyName)){
			$this->save();
			return true;
		}
		else{
			foreach ($this->getMessages() as $message) {
        		echo $message, "\n";
    		}
		}
	}
	//返回公司列表(二维)
	public function companyList(){
		$companylist= CompanyModel::find()->toArray();
		return $companylist;
	}
	//返回公司名称列表
	public function CompanyListOne(){
		$company= CompanyModel::find()->toArray();
		$array=array();
		foreach ($company as $stu) {
    		$array[$stu['companyId']]=$stu['companyName'];
		}
		return $array;
	}
	//Search
	public function searchCompanyName($value){
		$company= CompanyModel::find(array("conditions" => "companyName LIKE '%".$value."%' "))->toArray();
		//$array=array();
		
		return $company;
	}
	
	public function check()
    {
		//不能为空
        $this->validate(new PresenceOf(array(
          'field' => 'companyName',
          'message' => '名称不可为空!'
      )));
	  //判断重复
     	 $this->validate(new Uniqueness(
            array(
                "field"   => "companyName",
                "message" => "名称重复,请重新添加!"
            )
        ));
		//判断一个字符串的长度
		$this->validate(new StringLengthValidator(array(
			'field' => 'companyName',
            'max' => 50,
            'min' => 2,
            'messageMaximum' => '您的输入的名字超出长度限制！',
            'messageMinimum' => '您输入的名字太短！'
		)));
        return $this->validationHasFailed() != true;
    }
	
}
