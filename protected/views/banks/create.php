<?php
$this->breadcrumbs = array(
    'Banks' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Bank Accounts', 'url' => array('index')),
);
?>

<h1>Create Bank Account</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>