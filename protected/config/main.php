<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'theme' => 'softobiz',
		'homeUrl'=> 'http://'. $_SERVER['HTTP_HOST'] ,

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
		'application.extensions.PasswordHash',
		'ext.yiiext.components.shoppingCart.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
                        //'ipFilters'=>array('127.0.0.1','192.168.0.*','::1'),
						'ipFilters'=>array('127.0.0.1','*.*.*.*','::1'),
		),
		'rights'=>array( 
                    'install'=>false, // Enables the installer.
                    'superuserName'=>'admin',
                ),
            
	),

	// application components
	'components'=>array(
            
                'session'=>array(
                    'autoStart'=>true,
                    'sessionName'=>'session',
                    //'savePath'=>'tmp', // this is the default, but still needs to be explicitly set
                    'timeout'=>1440
                ),
                
                'applicationselect' => array(
                		'class' => 'ext.yiiext.components.shoppingCart.EShoppingCart',
                ),
                
//                'session'=>array( 
//                        'class'=>'system.web.CDbHttpSession', 
//                        'connectionID' => 'db' 
//                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class'=>'RWebUser',    // Allows super users access implicitly.
		),
                'authManager'=>array(
                    'class'=>'RDbAuthManager',  // Provides support authorization item sorting.
                    'defaultRoles'=>array('Guest'),
                    'assignmentTable'=>'authassignment',
                    'itemChildTable'=>'authitemchild',
                    'itemTable'=>'authitem',
                    'rightsTable'=>'rights'
                ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		/*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mobile_builder',
			'emulatePrepare' => true,
			'username' => 'wpcopier',
			'password' => '4ECH5tru',
			'charset' => 'utf8',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=myappswi_mobile_builder',
			'emulatePrepare' => true,
			'username' => 'myappswi_mobile',
			'password' => 'mobile2012',
			'charset' => 'utf8',
		),
		'db_amember' => array(
            'connectionString' => 'mysql:host=localhost;dbname=myappswi_amemb',
            'emulatePrepare' => true,
            'username' => 'myappswi_ame32',
            'password' => 'uW[.S-_^O}%X',
            'charset' => 'utf8',
            'class' => 'CDbConnection',
        ),*/

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=aappmi_myappswi_mobile_builder',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'A!pPb!G0o',
			'charset' => 'utf8',
		),
		'db_amember' => array(
            'connectionString' => 'mysql:host=localhost;dbname=aappmi_myappswi_panel',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'A!pPb!G0o',
            'charset' => 'utf8',
            'class' => 'CDbConnection',
        ),	

		/* 	'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=aappmi_myappswi_mobile_builder',
			'emulatePrepare' => true,
			'username' => 'aappmi_mobile',
			'password' => 'mobile2012',
			'charset' => 'utf8',
		),
		'db_amember' => array(
            'connectionString' => 'mysql:host=localhost;dbname=aappmi_amemberpanel',
            'emulatePrepare' => true,
            'username' => 'aappmi_dfds',
            'password' => ';]+l+rnZq%dI',
            'charset' => 'utf8',
            'class' => 'CDbConnection',
        ),
          'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=myappswizard',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                //'gitUsername'=>'cgfmedia',
                //'gitPassword'=>'Fb66s8TNEh',
                //'gitPassword'=>'bA14Nbxk2E',
                'gitUsername'=>'jarnailboparai',
                'gitPassword'=>'boparai@2010',
                'phonegapUsername'=>'tested0312@gmail.com',
                'phonegapPassword'=>'softobiz',
	),
);
