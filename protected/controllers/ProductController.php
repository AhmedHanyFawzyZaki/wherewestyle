<?php

class ProductController extends AdminController {

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
                //'accessControl', // perform access control for CRUD operations
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
        $model = new Product;

        if ($model->gallery_id == '') {


            $gallery = new Gallery();
            $gallery->name = true;
            $gallery->description = true;
            $gallery->versions = array(
                'small' => array(
                    'resize' => array(200, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery->save();
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->main_image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/products/thumbs_266X300/' . $fileName);
            }

            //$model->slug = Helper::slugify($model->title);
            $model->start_date = date('Y-m-d H:i:s');

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $model->gallery_id = $gallery->id;
        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('create', array(
            'model' => $model, 'gallery' => $gallery
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

        if (isset($_POST['Product'])) {
            if ($model->main_image != '') {
                $_POST['Product']['main_image'] = $model->main_image;
            }
            
            $model->attributes = $_POST['Product'];
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)) {
                $rnd = rand(0, 9999);
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->main_image = $fileName;

                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/original/' . $model->main_image);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/products/original/' . $model->main_image);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/products/thumbs_266X300/' . $model->main_image);
            }

            //$model->slug = Helper::slugify($model->title);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }



        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('update', array(
            'model' => $model, 'gallery' => $gallery
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
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

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
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCreateproduct($id) {
        $this->layout = '/layouts/main';

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $criteria->addCondition('id=' . $id);
        $shop = Shop::model()->find($criteria);
        if ($shop === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model = new Product;
        if ($model->gallery_id == '') {
            $gallery = new Gallery();
            $gallery->name = true;
            $gallery->description = true;
            $gallery->versions = array(
                'small' => array(
                    'resize' => array(200, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery->save();
        }

        $model->gallery_id = $gallery->id;
        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('product_form', array('model' => $model, 'gallery' => $gallery));
    }

}
