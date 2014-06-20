<?php

class UserModel extends Phalcon\Mvc\Model
{
	public $userId;
	public $userName;
	public function initialize()
    {
        $this->setSource("ten_user");
    }
	public function getUserInfo($id=1)
	{
		//return $this->userName;
		$user = UserModel::findFirst($id);
		$array['userId']=$user->userId;
		$array['userName']=$user->userName;
		return $array;
	}
}
