<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Subscribers', 'url' => array('index')),
    array('label' => 'Create Subscriber', 'url' => array('create')),
    array('label' => 'Update Subscriber', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Subscriber', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Subscriber #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        'email',
    ),
));
?>
