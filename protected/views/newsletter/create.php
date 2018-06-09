<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Subscribers', 'url' => array('index')),
);
?>

<h1>Create Subscriber</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>