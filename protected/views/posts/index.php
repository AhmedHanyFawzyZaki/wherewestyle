<?php
$this->breadcrumbs = array(
    'Posts' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Posts', 'url' => array('index')),
    array('label' => 'Create Post', 'url' => array('create')),
);
?>

<h1>Manage Posts</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'posts-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'title',
        array(
            'name' => 'status',
            'filter' => array('1' => 'published', '0' => 'not published'),
            'value' => '$data->status ? "published" : "not published"',
        ),
        array(
            'name' => 'date',
            'filter' => '',
            'value' => 'date("Y-m-d", $data->date)',
        ),
        array(
            'name' => 'views',
            'filter' => '',
        ),
        array(
            'name' => 'comments',
            'filter' => '',
            'type' => 'html',
            'value' => 'CHtml::link($data->comments." comments",array("comments/index","id"=>$data->id))',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
