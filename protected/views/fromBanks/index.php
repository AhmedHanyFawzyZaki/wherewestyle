<?php
$this->breadcrumbs = array(
    'From Banks' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Allowed Paying Banks', 'url' => array('index')),
    array('label' => 'Create Paying Bank', 'url' => array('create')),
);
?>

<h1>Manage Allowed Paying Banks</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'from-banks-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'bank_name',
        'internet_banking_nickname',
        array(
            'name' => 'image',
            'type' => 'html',
            'filter' => '',
            'value' => '(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/".$data->image,"",array("style"=>"width:83px;height:65px;")):"no image"',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
