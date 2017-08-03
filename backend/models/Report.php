<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $from_date
 * @property string $to_date
 * @property string $refers_to
 * @property string $item_selected
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title', 'description', 'type', 'refers_to'], 'required'],
            [['title'], 'string', 'max' => 250],
            [['type'], 'string', 'max' => 11],
            [['from_date', 'to_date'], 'string', 'max' => 128],
            [['refers_to'], 'string', 'max' => 58],
            [['item_selected'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'refers_to' => 'Refers To',
            'item_selected' => 'Item Selected',
        ];
    }

    public function getFromDate()
    {
        return Yii::$app->formatter->asDate($this->from_date, 'php:m-d-Y');
    }

    public function getToDate()
    {
        return Yii::$app->formatter->asDate($this->to_date, 'php:m-d-Y');
    }
}
