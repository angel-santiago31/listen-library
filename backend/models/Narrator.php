<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "narrator".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $initial
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
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 18],
            [['initial'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Narrator Id',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'initial' => 'Initial',
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
