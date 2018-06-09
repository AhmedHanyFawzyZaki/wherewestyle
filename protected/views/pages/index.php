<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Pages', 'url' => array('index')),
    array('label' => 'Create Page', 'url' => array('create')),
);
?>

<h1>Manage Pages</h1>

<?php
$this->widget('ext.yiisortablemodel.widgets.SortableCGridView', array(
    'id' => 'pages-grid',
    'dataProvider' => $model->search(),
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
    //'filter' => $model,
    'columns' => array(
        'title',
        array(
            'header' => 'image',
            'type' => 'html',
            'value' => '(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/pages/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
        ),
        /*
          'publish',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
?>
