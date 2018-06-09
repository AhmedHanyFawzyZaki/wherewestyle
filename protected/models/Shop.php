<?php

/**
 * This is the model class for table "shop".
 *
 * The followings are the available columns in table 'shop':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $image
 * @property integer $seller_id
 * @property string $tags
 * @property integer $sale
 * @property string $sale_desc
 * @property integer $small_featured
 * @property integer $big_featured
 * @property integer $active
 * @property string $policy
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property User $seller
 */
class Shop extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Shop the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{shop}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'unique'),
            array('seller_id, sale, small_featured, big_featured, active, last_update, followers_count, transaction_count', 'numerical', 'integerOnly' => true),
            array('title, tags, slug', 'length', 'max' => 255),
            array('desc, sale_desc, policy', 'safe'),
            array('facebook,twitter,googleplus,youtube,banner', 'safe'),
            array('store_wide_sale', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, desc, image, seller_id, tags, sale, sale_desc, small_featured, big_featured, active, policy, slug, store_wide_sale', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'seller' => array(self::BELONGS_TO, 'User', 'seller_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Shop Name',
            'desc' => 'Description',
            'image' => 'Image',
            'seller_id' => 'Seller',
            'tags' => 'Tags',
            'sale' => 'Sale',
            'sale_desc' => 'Sale Desc',
            'small_featured' => 'Small Featured',
            'big_featured' => 'Big Featured',
            'active' => 'Active',
            'policy' => 'Policy',
            'slug' => 'Slug',
            'store_wide_sale' => 'Store-wide Sale',
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
        $criteria->compare('image', $this->image, true);
        $criteria->compare('seller_id', $this->seller_id);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('sale', $this->sale);
        $criteria->compare('sale_desc', $this->sale_desc, true);
        $criteria->compare('small_featured', $this->small_featured);
        $criteria->compare('big_featured', $this->big_featured);
        $criteria->compare('active', $this->active);
        $criteria->compare('policy', $this->policy, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('store_wide_sale', $this->store_wide_sale);
        
        $criteria->order = "id DESC";

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
		}
		return true;
	}

}
