<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "publisher".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Audiobook[] $audiobooks
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publisher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Publisher Id',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiobooks()
    {
        return $this->hasMany(Audiobook::className(), ['publisher_id' => 'id']);
    }
}
