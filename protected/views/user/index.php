<?php
$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Users', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
);
?>

<h1>Manage Users</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'type' => 'striped  condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'username',
        'email',
        'fname',
        'lname',
        'groups_id' => array(// display 'author.username' using an expression
            'name' => 'groups_id',
            'value' => '$data->usergroup->group_title',
            'filter' => Groups::model()->getgroups(),
        ),
        /*
          'image',
          'details',
          'group',
          'active',
          'user_details_id',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
