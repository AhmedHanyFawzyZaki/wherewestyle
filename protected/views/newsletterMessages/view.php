<?php
$this->breadcrumbs = array(
    'Newsletter Messages' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Newsletter Messages', 'url' => array('index')),
    array('label' => 'Create Newsletter Message', 'url' => array('create')),
    array('label' => 'Update Newsletter Message', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Newsletter Message', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Newsletter Message #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'subject',
        array(
            'name' => 'date',
            'value' => date("Y-m-d", $model->date),
        ),
        array(
            'name' => 'content',
            'type' => 'raw',
        ),
    ),
));
?>
