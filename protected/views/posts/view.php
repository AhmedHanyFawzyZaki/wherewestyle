<?php
$this->breadcrumbs = array(
    'Posts' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Posts', 'url' => array('index')),
    array('label' => 'Create Post', 'url' => array('create')),
    array('label' => 'Update Post', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Post', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Post : <?php echo $model->title; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        array(
            'name' => 'date',
            'value' => date('Y-m-d', $model->date),
        ),
        'views',
        array(
            'name' => 'comments',
            'type' => 'html',
            'value' => CHtml::link($model->comments . " comments", array("comments/index", "id" => $model->id)),
        ),
        array(
            'name' => 'image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/posts/' . $model->image, $model->title, array('width' => 250)),
        ),
        array(
            'name' => 'status',
            'value' => $model->status ? "Published" : "Not Published",
        ),
        array(
            'name' => 'content',
            'type' => 'raw',
        ),
    ),
));
?>
