<?php
$this->breadcrumbs = array(
    'Comments' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Comments', 'url' => array('index')),
    array('label' => 'Create Comment', 'url' => array('create')),
    array('label' => 'Update Comment', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Comment', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Comment #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'post_id',
            'value' => $model->post->title,
        ),
        array(
            'name' => 'user_id',
            'value' => $model->user_id ? $model->user->username : "not a registered user",
        ),
        array(
            'name' => 'name',
            'value' => $model->name ? $model->name : $model->user->fname." ".$model->user->lname,
        ),
        array(
            'name' => 'email',
            'value' => $model->email ? $model->email : $model->user->email,
        ),
        array(
            'name' => 'date',
            'value' => date("Y-m-d", $model->date),
        ),
        array(
            'name' => 'status',
            'value' => $model->status ? "Approved" : "Refused",
        ),
        array(
            'name' => 'content',
            'type' => 'raw',
        ),
    ),
));
?>
