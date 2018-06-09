<?php
$this->breadcrumbs = array(
    'Comments' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Comments', 'url' => array('index')),
    array('label' => 'Create Comment', 'url' => array('create')),
    array('label' => 'View Comment', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Comment #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>