<?php
$this->breadcrumbs = array(
    'Comments' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Comments', 'url' => array('index')),
);
?>

<h1>Create Comment</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>