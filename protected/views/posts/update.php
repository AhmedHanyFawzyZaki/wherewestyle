<?php
$this->breadcrumbs = array(
    'Posts' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Posts', 'url' => array('index')),
    array('label' => 'Create Post', 'url' => array('create')),
    array('label' => 'View Post', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Post : <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>