<?php

class ShopController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                /* 'accessControl', // perform access control for CRUD operations */
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Shop;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Shop'])) {
            $model->attributes = $_POST['Shop'];
            //$model->slug = Helper::slugify($model->title);
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $rnd2 = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile2 = CUploadedFile::getInstance($model, 'banner');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/shops/thumbs_266X300/' . $fileName);
            }
            if (!empty($uploadedFile2)) {
                $fileName2 = "{$rnd2}-{$uploadedFile2}";  // random number + file name
                $model->banner = $fileName2;
                $uploadedFile2->saveAs(Yii::app()->basePath . '/../media/shops/banner/' . $fileName2);
            }

            if (!$_POST['sale_check']) {
                $model->store_wide_sale = 0;
            }

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Shop'])) {
            if ($model->image != '') {
                $_POST['Shop']['image'] = $model->image;
            }
            if ($model->banner != '') {
                $_POST['Shop']['banner'] = $model->banner;
            }

            $tmp_sale = $model->store_wide_sale;

            $model->attributes = $_POST['Shop'];
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $uploadedFile2 = CUploadedFile::getInstance($model, 'banner');

//            $imagevariables = getimagesize($uploadedFile->tempName);
//            echo $imagevariables[0];
//            die();
            if (!empty($uploadedFile)) {
                $rnd = rand(0, 9999);
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;

                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/shops/original/' . $model->image);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/shops/original/' . $model->image);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/shops/thumbs_266X300/' . $model->image);
            }
            if (!empty($uploadedFile2)) {
                $rnd2 = rand(0, 9999);
                $fileName2 = "{$rnd2}-{$uploadedFile2}";
                $model->banner = $fileName2;
                $uploadedFile2->saveAs(Yii::app()->basePath . '/../media/shops/banner/' . $model->banner);
            }

            if (!$_POST['sale_check']) {
                $model->store_wide_sale = 0;
            }



            if ($model->save()) {
                
                //when the store-wide sale changed
                if ($tmp_sale != $model->store_wide_sale) {
                    $products = Product::model()->findAll(array('condition' => 'shop_id = ' . $model->id));
                    if ($model->store_wide_sale != 0) {
                        //update the price of shop products that don't have sale
                        foreach ($products as $product) {
                            if (!$product->sale) {
                                $product->sale = 1;
                                $product->old_price = $product->price;
                                $product->price = $product->price - ($product->price * $model->store_wide_sale / 100);
                                $product->save(false);
                            }
                        }
                    } else {
                        //update the price of shop products to remove the sale
                        foreach ($products as $product) {
                            if ($product->sale) {
                                $product->sale = 0;
                                $product->price = $product->old_price;
                                $product->old_price = 0;
                                $product->save(false);
                            }
                        }
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Shop('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Shop']))
            $model->attributes = $_GET['Shop'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Shop::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'shop-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
