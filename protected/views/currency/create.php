<?php
$this->breadcrumbs = array(
    'Currencies' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Currencies', 'url' => array('index')),
);
?>

<h1>Create Currency</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>