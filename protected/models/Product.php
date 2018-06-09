<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $main_image
 * @property integer $gallery_id
 * @property string $meta
 * @property double $price
 * @property integer $stock
 * @property integer $sold
 * @property string $start_date
 * @property integer $cat_id
 * @property integer $shop_id
 * @property string $slug
 * @property integer $auto_delete
 * @property integer $back_order
 * @property integer $active
 * @property integer $sale
 * @property integer $featured
 */
class Product extends CActiveRecord implements IECartPosition {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{product}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('gallery_id, stock, sold, cat_id, shop_id, auto_delete, back_order, active, sale, featured, sales_count', 'numerical', 'integerOnly' => true),
            array('price, old_price, other_old_price', 'length', 'max' => 20),
            array('title,  main_image, meta, start_date, slug', 'length', 'max' => 255),
            array('title, price, stock, cat_id, shop_id, end_date', 'required'),
            array('desc, end_date', 'safe'),
            //array('main_image', 'file', 'types' => 'jpg, gif, png, jpeg'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, desc, main_image, gallery_id, meta, price, stock, sold, start_date, cat_id, shop_id, slug, auto_delete, back_order, active, sale, featured', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categoryName' => array(self::BELONGS_TO, 'Category', 'cat_id'),
            'shopName' => array(self::BELONGS_TO, 'Shop', 'shop_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Product Name',
            'desc' => 'Description',
            'main_image' => 'Main Image',
            'gallery_id' => 'Gallery',
            'meta' => 'Meta tags',
            'price' => 'Price',
            'stock' => 'Stock Qty',
            'sold' => 'Sold Qty',
            'start_date' => 'Publish Date',
            'cat_id' => 'Category',
            'shop_id' => 'Shop',
            'slug' => 'Slug',
            'auto_delete' => 'Auto Delete',
            'back_order' => 'Back Order',
            'active' => 'Active',
            'sale' => 'Sale',
            'featured' => 'Featured',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('main_image', $this->main_image, true);
        $criteria->compare('gallery_id', $this->gallery_id);
        $criteria->compare('meta', $this->meta, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('stock', $this->stock);
        $criteria->compare('sold', $this->sold);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('shop_id', $this->shop_id);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('auto_delete', $this->auto_delete);
        $criteria->compare('back_order', $this->back_order);
        $criteria->compare('active', $this->active);
        $criteria->compare('sale', $this->sale);
        $criteria->compare('featured', $this->featured);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if($this->title)
            {
                $this->slug=Helper::slugify($this->title);
            }
            if ($this->end_date) {
                $chk = explode("/", $this->end_date);
                $this->end_date = mktime(0, 0, 0, $chk[1], $chk[0], $chk[2]);
//                $this->end_date = strtotime($this->end_date);
            }
            if ($this->price) {
                $this->price = round($this->price, 2);
                
            }
            if ($this->old_price) {
                $this->old_price = number_format($this->old_price, 2);
            }
            return true;
        }
        return false;
    }

    public function afterFind() {
        if ($this->end_date) {
            $this->end_date = date("d/m/Y", $this->end_date);
        } else {
            $this->end_date = "";
        }
        return TRUE;
    }

    public function getProducts() {
        return CHtml::listData(Product::model()->findAll(), 'id', 'title');
    }

    function getId() {
        return $this->id;
    }

    function getPrice() {
        return $this->price;
    }

}