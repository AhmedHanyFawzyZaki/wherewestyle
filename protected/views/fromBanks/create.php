<?php
$this->breadcrumbs = array(
    'From Banks' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Allowed Paying Banks', 'url' => array('index')),
);
?>

<h1>Create Paying Bank</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>