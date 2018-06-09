<?php
$this->breadcrumbs = array(
    'Newsletter Messages' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Newsletter Messages', 'url' => array('index')),
);
?>

<h1>Create Newsletter Message</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>