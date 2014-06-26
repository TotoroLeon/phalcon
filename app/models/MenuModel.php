<?php

/**
 * 
 */
 use \Phalcon\Mvc\Model ;
class MenuModel extends Model {
	
	public $mId;
	public $menuName;
	public $menuType;
	public $menuLink;
	public $parentId;
	public function initialize(){
		$this->setSource("ten_menu");
	}
	//获取父级导航
	public function getParentInfo($array){
		$array=MenuModel::find(array("conditions"=>"parentId = 0  and  mId IN ($array)",))->toArray();
		return $array ;
	}
	//获取子级导航
	public function getSonInfo($mid,$array){
		$array=MenuModel::find(array("conditions"=>"parentId = $mid  and  mId IN ($array)",))->toArray();
		return $array ;
	}

}
