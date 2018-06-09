<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Subscribers', 'url' => array('index')),
    array('label' => 'Create Subscriber', 'url' => array('create')),
);
?>

<h1>Manage Newsletter Subscribers</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'newsletter-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'email',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
