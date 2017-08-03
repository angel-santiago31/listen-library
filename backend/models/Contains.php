<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contains".
 *
 * @property integer $order_id
 * @property integer $audiobook_id
 *
 * @property Order $order
 * @property Audiobook $audiobook
 */
class Contains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_in_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'audiobook_id'], 'required'],
            [['order_id', 'audiobook_id'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['audiobook_id'], 'exist', 'skipOnError' => true, 'targetClass' => Audiobook::className(), 'targetAttribute' => ['audiobook_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order Id',
            'audiobook_id' => 'Audiobook Id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudiobook()
    {
        return $this->hasOne(Audiobook::className(), ['id' => 'audiobook_id']);
    }

    public function getAudiobookPicture()
    {
        $audiobook = Audiobook::findOne($this->audiobook_id);

        return $audiobook->picture;
    }

    public function getAudiobookPicture2()
    {
        $audiobook = Audiobook::findOne($this->audiobook_id);

        return $audiobook->picture2;
    }

    public function getAudiobookTitle()
    {
        $audiobook = Audiobook::findOne($this->audiobook_id);

        return $audiobook->title;
    }

    public function getAudiobookPrice()
    {
        $audiobook = Audiobook::findOne($this->audiobook_id);

        return $audiobook->price;
    }
}
