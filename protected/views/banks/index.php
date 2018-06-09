<?php
$this->breadcrumbs = array(
    'Banks' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Bank Accounts', 'url' => array('index')),
    array('label' => 'Create Bank Account', 'url' => array('create')),
);
?>

<h1>Manage Bank Accounts</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'banks-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'account_name',
        'account_number',
        array(
            'name' => 'status',
            'filter' => array('1' => 'Active','0' => 'Not active'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
