<?php
try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
	$config = new Phalcon\Config\Adapter\Ini('../app/config/config.ini');
	$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->pluginsDir,
        $config->application->libraryDir,
        $config->application->modelsDir
    )
)->register();
    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    //Set the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" =>'localhost',
            "username" => 'root',
            "password" => '',
            "dbname" => 'tennis',
            "charset" =>'utf8'
        ));
    });

    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });
	$di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

	 $di->set('modelsManager', function() {
	      return new Phalcon\Mvc\Model\Manager();
	 });
	

    //Handle the request
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
