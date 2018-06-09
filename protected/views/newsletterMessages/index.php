<?php
$this->breadcrumbs = array(
    'Newsletter Messages' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Newsletter Messages', 'url' => array('index')),
    array('label' => 'Create Newsletter Message', 'url' => array('create')),
);
?>

<h1>Manage Newsletter Messages</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'newsletter-messages-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'subject',
        array(
            'name' => 'date',
            'filter' => '',
            'value' => 'date("Y-m-d",$data->date)',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
