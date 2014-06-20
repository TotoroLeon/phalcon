<?php

class LogModel extends Phalcon\Mvc\Model
{
	public $insertBy;
	public $insertTime;
	public $content;
	public $insertIp;
	public $typeId;
	public $modelsManager;
	public function initialize()
    {
        $this->setSource("ten_log");
		$this->modelsManager=$this->getDI()->get('modelsManager');
    }
	public function insertLog($content='',$typeId='')
	{
		$this->insertBy=2;
		$this->insertTime=time();
		$this->content=$content;
		$this->insertIp=ip2long($_SERVER["REMOTE_ADDR"]);
		$this->typeId=$typeId;
		//echo date('Y-m-d H:i:s',$this->insertTime),$this->insertIp;die();
		$this->save();
	}
	public function logList()
	{
		$loglist= $this->modelsManager->createBuilder()
				 ->columns('lid,userName,insertTime,content,insertIp,typeId')
				 ->from("LogModel")
				 ->join('UserModel','LogModel.insertBy=UserModel.userId')
				 ->getQuery()
		    	 ->execute()
		    	 ->toArray();
		
		return $loglist;
	}
}
