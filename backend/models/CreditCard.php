<?php

namespace backend\models;

use Yii;
use common\models\Customer;

/**
 * This is the model class for table "credit_card".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $card_last_digits
 * @property integer $expiration_date
 * @property string $card_type
 *
 * @property Customer $customer
 * @property Order[] $orders
 */
class CreditCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credit_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'card_last_digits', 'expiration_date', 'card_type'], 'required'],
            [['customer_id', 'card_last_digits', 'expiration_date'], 'integer'],
            [['card_type'], 'string', 'max' => 18],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Credit Card Id',
            'customer_id' => 'Customer Id',
            'card_last_digits' => 'Card Last Digits',
            'expiration_date' => 'Expiration Date',
            'card_type' => 'Card Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['card_last_digits' => 'id']);
    }
}
