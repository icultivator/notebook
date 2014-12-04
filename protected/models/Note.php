<?php

/**
 * This is the model class for table "{{note}}".
 *
 * The followings are the available columns in table '{{note}}':
 * @property string $id
 * @property integer $cat_id
 * @property string $title
 * @property string $cover
 * @property string $summary
 * @property string $content
 * @property string $tags
 * @property string $views
 * @property string $votes
 * @property integer $status
 * @property string $user_id
 * @property string $create_time
 * @property string $publish_time
 * @property string $last_update
 */
class Note extends CActiveRecord
{
	
	const DRAFT = 0;
	const PUBLISHED = 1;

	public $oldTags;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{note}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content,cat_id', 'required'),
			array('cat_id, status', 'numerical', 'integerOnly'=>true),
			array('title, cover, tags', 'length', 'max'=>100),
			array('votes', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cat_id, title, cover, summary, content, tags, views, votes, status, user_id, create_time, publish_time, last_update', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'author'=>array(self::BELONGS_TO,'User','user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => 'Cat',
			'title' => 'Title',
			'cover' => 'Cover',
			'content' => 'Content',
			'tags' => 'Tags',
			'views' => 'Views',
			'votes' => 'Votes',
			'status' => 'Status',
			'user_id' => 'User',
			'create_time' => 'Create Time',
			'publish_time' => 'Publish Time',
			'last_update' => 'Last Update',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('publish_time',$this->publish_time,true);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Note the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave(){
		if($this->isNewRecord){
			$this->create_time = $this->last_update = time();
			$this->user_id = Yii::app()->user->id;
		}
		if($this->scenario=='update'){
			$this->last_update  = time();
		}
		if($this->scenario=='publish'){
			$this->publish_time = time();
			$this->status = self::PUBLISHED;
		}
		if($this->scenario=='draft'){
			$this->status==self::DRAFT;
		}
	}

	public function afterSave(){
		switch($this->scenario){
            case 'publish':
            case 'update':
                //更新tags
                if($this->isNewRecord){
                    $arrNewTags = explode(',',$this->tags);
                    $arrOldTags = array();
                }else{
                    $arrNewTags = explode(',',$this->tags);
                    $arrOldTags = explode(',',$this->oldTags);
                }
                $addTags = array_diff($arrNewTags,$arrOldTags);
                $delTags = array_diff($arrOldTags,$arrNewTags);

                $objTags = new Ntags();
                $objTags->addTags($addTags);
                $objTags->delTags($delTags);
                break;
        }
	}

	public function afterDelete(){
		$delTags = explode(',',$this->tags);
        $objTags = new Ntags();
        $objTags->delTags($delTags);
	}
}
