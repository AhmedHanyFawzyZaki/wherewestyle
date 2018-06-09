<?php
$this->breadcrumbs = array(
    'Comments' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Comments', 'url' => array('index')),
    array('label' => 'Create Comment', 'url' => array('create')),
);
?>

<?php
$columns = array(
    array(
        'name' => 'user_id',
        'filter' => array_merge(array('0' => 'unregistered users'), CHtml::listData(User::model()->findAll(), 'id', 'username')),
        'value' => '$data->user_id ? $data->user->username : "not a registered user"',
    ),
    array(
        'name' => 'name',
        'value' => '$data->name ? $data->name : $data->user->fname . " " . $data->user->lname',
    ),
);

if ($post) {
    $title = "Manage All Comments Of ' " . $post->title . " '";
} else {
    $title = "Manage All Comments";
    $columns[] = array(
        'name' => 'post_id',
        'filter' => CHtml::listData(Posts::model()->findAll(), 'id', 'title'),
        'value' => '$data->post->title',
    );
}
$columns[] = array(
    'name' => 'content',
    'filter' => '',
    'value' => 'mb_substr($data->content,0,40)."...."'
);
$columns[] = array(
    'name' => 'status',
    'filter' => array('1' => 'Approved', '0' => 'Refused'),
    'value' => '$data->status ? "Approved" : "Refused"'
);
$columns[] = array(
    'name' => 'date',
    'filter' => '',
    'value' => 'date("Y-m-d", $data->date)',
);
$columns[] = array(
    'class' => 'bootstrap.widgets.TbButtonColumn',
);
?>

<h1><?php echo $title; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'comments-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => $columns,
));
?>
