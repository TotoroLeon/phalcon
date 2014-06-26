<?php
use \Phalcon\Mvc\Model ;
class UserModel extends Model
{
	public $userId;
	public $userName;
	public $userPower;
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
		$array['userPower']=$user->userPower;
		return $array;
	}
}
