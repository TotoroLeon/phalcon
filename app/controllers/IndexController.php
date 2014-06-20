<?php

class IndexController extends Phalcon\Mvc\Controller 
{

	public function indexAction()
	{
		if($this->request->get('menu')!='')
		{
			$menu=$this->request->get('menu');
		}
		else
		{
			$menu='0';
		}
		$this->view->setVar('menu',$menu);
	}

}
