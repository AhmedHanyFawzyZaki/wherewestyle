<?php
$this->breadcrumbs = array(
    'Posts' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Posts', 'url' => array('index')),
);
?>

<h1>Create Post</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>