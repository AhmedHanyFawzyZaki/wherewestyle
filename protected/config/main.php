<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Where We Style',
    'defaultController' => 'home',
    //'homeUrl'=>'home',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
        'ext.yiisortablemodel.models.*',
        /*         * * for gallery extesnion *** */
        'ext.shoppingCart.*',
        'ext.galleryManager.*',
        'ext.galleryManager.models.*',
        'ext.galleryManager.GalleryController',
        'ext.EGMap.*',
    ),
    //'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('*', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'twitter' => array(
            'class' => 'ext.yiitwitteroauth.YiiTwitter',
            'consumer_key' => '03nxF9F0FvpMDzI6oVj1TAa2X',
            'consumer_secret' => '5jYQdT4qXUy17oOshxVOrs9w5WjR5vFvx6sJbN6qYRdjuQOCeT',
            'callback' => 'http://wherewestyle.ukprosoltest.com/profile',
        ),
        'facebook' => array(
            'class' => 'ext.yii-facebook-opengraph.SFacebook',
            'appId' => '409482105858611',
            'secret' => '3b44a86b8e63f59704329530365418d7',
        //'appId' => '224710701038219', // needed for JS SDK, Social Plugins and PHP SDK
        //'secret' => '728172f55f4e587567926e8409646e16', // needed for the PHP SDK
        //'fileUpload'=>false, // needed to support API POST requests which send files
        //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'oauth'=>true,  // JS SDK - enable OAuth 2.0
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
        //'og:title'=>'MY_WEBSITE_NAME',
        //'og:description'=>'MY_WEBSITE_DESCRIPTION',
        //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'phpThumb' => array(
            'class' => 'ext.EPhpThumb.EPhpThumb.EPhpThumb',
        ),
        ///////////// shopping cart
        'shoppingCart' => array(
            'class' => 'ext.shoppingCart.EShoppingCart',
        ),
        /*         * *For gallery extension  ** */
        'widgetFactory' => array(
            'class' => 'CWidgetFactory',
            'widgets' => array(
                'GalleryManager' => array(
                    'controllerRoute' => '/gallery',
                ),
            )
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/var/www/projects/PHPLib/ImageMagick-6.8.6-8'),
        ),
        'mailer' => array(
            'class' => 'ext.mail.Mailer',
        ),
        'Paypal' => array(
            'class' => 'application.components.Paypal',
            'apiUsername' => 'ahmed.hany.fawzy-facilitator_api1.hotmail.com',
            'apiPassword' => 'AA86G2K284HDV3L2', //'1355392425',
            'apiSignature' => 'ArcoIsSBiDf1YkCyrHH34-M8jKo3AhzsU7eWzVM9-3t50NlXZqMw6JiR',
            'apiLive' => false,
            'returnUrl' => 'Controller/confirm/', //regardless of url management component
            'cancelUrl' => 'Controller/cancel/', //regardless of url management component
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '_<slug>' => 'home/page',
                //'home/productDetails/<slug>' => 'home/productDetails',
                'productDetails-<slug>' => 'home/productDetails',
                //'home/shopDetails/<slug>' => 'home/shopDetails',
                'shops' => 'home/shops',
                'sale' => 'home/sale',
                '<slug>_' => 'home/browse',
                'followedProducts' => 'home/followedProducts',
                'followedShops' => 'home/followedShops',
                'shopDetails-<slug>' => 'home/shopDetails',
                'home/user/<username>' => 'home/user/',
                'home/all_followed/<slug>' => 'home/all_followed',
                'home/all_followers/<slug>' => 'home/all_followers',
                'bottoms' => '',
            ),
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=wherewestyle',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'wws_',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'home/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            //array(
//            'class'=>'CWebLogRoute',
//          ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'admin@test.com',
        'webSite' => 'http://www.domains4reg.com',
    ),
);
