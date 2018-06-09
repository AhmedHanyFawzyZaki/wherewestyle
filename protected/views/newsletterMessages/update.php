<?php
$this->breadcrumbs = array(
    'Newsletter Messages' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Newsletter Messages', 'url' => array('index')),
    array('label' => 'Create Newsletter Message', 'url' => array('create')),
    array('label' => 'View Newsletter Message', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Newsletter Message <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>