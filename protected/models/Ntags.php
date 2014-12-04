<?php

/**
 * This is the model class for table "{{ntags}}".
 *
 * The followings are the available columns in table '{{ntags}}':
 * @property string $id
 * @property string $name
 * @property string $count
 */
class Ntags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ntags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>16),
			array('count', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, count', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'count' => 'Count',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ntags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function addTags($addTags){
        if(is_array($addTags)){
            foreach($addTags as $tagName){
                $objTags = Ntags::model()->find('name=:name',array(':name'=>$tagName));
                if($objTags){
                    $objTags->count += 1;
                }else{
                    $objTags = new Ntags;
                    $objTags->name = $tagName;
                    $objTags->count = 1;
                }
                $objTags->save();
            }
        }else{
            return false;
        }

        return true;
    }

    public function delTags(array $delTags){
        if(is_array($delTags)){
            foreach($delTags as $tagName){
                $objTags = Ntags::model()->find('name=:name',array(':name'=>$tagName));
                if(!$objTags){
                    continue;
                }elseif($objTags && $objTags->count<=1){
                    $objTags->delete();
                }else{
                    $objTags->count -= 1;
                    $objTags->save();
                }
            }
            return true;
        }else{
            return false;
        }
    }
}
