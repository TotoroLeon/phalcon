<?php

class CompanyModel extends Phalcon\Mvc\Model
{
	public $companyId;
	public $companyName;
	public function initialize()
    {
        $this->setSource("ten_company");
    }
    //插入公司名称
	public function insertCompany($date=array()){
		$this->companyName=$date['companyName'];
		$this->save();
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
}
