<?php

class NewsletterMessagesController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
        $model = new NewsletterMessages;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NewsletterMessages'])) {
            $model->attributes = $_POST['NewsletterMessages'];
            $model->date = time();
            if ($_POST['send']) {
                $users = Newsletter::model()->findAll();
                $ems = array();
                if ($users) {
                    foreach ($users as $us) {
                        $mail = new YiiMailer();
                        $mail->setFrom(Yii::app()->params['adminEmail'], ' WhereWeStyle MailBoy');
                        $mail->setTo($us->email);
                        $mail->setSubject($model->subject);
                        $mail->setBody($model->content);
                        $mail->send();
                    }
                }
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

        if (isset($_POST['NewsletterMessages'])) {
            $model->attributes = $_POST['NewsletterMessages'];
            if ($_POST['send']) {
                $users = Newsletter::model()->findAll();
                $ems = array();
                if ($users) {
                    foreach ($users as $us) {
                        $mail = new YiiMailer();
                        $mail->setFrom(Yii::app()->params['adminEmail'], ' WhereWeStyle Mailboy');
                        $mail->setTo($us->email);
                        $mail->setSubject($model->subject);
                        $mail->setBody($model->content);
                        $mail->send();
                    }

                }
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new NewsletterMessages('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NewsletterMessages']))
            $model->attributes = $_GET['NewsletterMessages'];

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
        $model = NewsletterMessages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'newsletter-messages-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
