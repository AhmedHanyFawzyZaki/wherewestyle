<?php
$this->breadcrumbs = array(
    'Currencies' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Currencies', 'url' => array('index')),
    array('label' => 'Create Currency', 'url' => array('create')),
);
?>

<h1>Manage Currencies</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'currency-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'title',
        'rate',
        'iso_code',
        array(
            'name' => 'symbol',
            'filter' => '',
            'type' => 'raw',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
