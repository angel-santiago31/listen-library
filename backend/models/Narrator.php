<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "narrator".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Audiobook[] $audiobooks
 */
class Narrator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'narrator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 18],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiobooks()
    {
        return $this->hasMany(Audiobook::className(), ['narrator_id' => 'id']);
    }
}
