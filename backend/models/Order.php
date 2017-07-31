<?php

namespace backend\models;

use Yii;
use common\models\Customer;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $item_quantity
 * @property integer $date
 * @property string $status
 * @property integer $customer_id
 * @property integer $card_last_digits
 * @property double $price_total
 *
 * @property Contains[] $contains
 * @property Customer $customer
 * @property CreditCard $cardLastDigits
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_quantity', 'date', 'status', 'customer_id', 'card_last_digits', 'price_total'], 'required'],
            [['item_quantity', 'date', 'customer_id', 'card_last_digits'], 'integer'],
            [['price_total'], 'number'],
            [['status'], 'string', 'max' => 18],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['card_last_digits'], 'exist', 'skipOnError' => true, 'targetClass' => CreditCard::className(), 'targetAttribute' => ['card_last_digits' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Order Id',
            'item_quantity' => 'Items in Order',
            'date' => 'Order Date',
            'status' => 'Order Status',
            'customer_id' => 'Customer Id',
            'card_last_digits' => 'Card Last Digits',
            'price_total' => 'Price Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContains()
    {
        return $this->hasMany(Contains::className(), ['order_id' => 'id']);
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
    public function getCardLastDigits()
    {
        return $this->hasOne(CreditCard::className(), ['id' => 'card_last_digits']);
    }

    public function isCartEmpty()
    {
        return (Yii::$app->cart->getCount() == NULL) ? 'btn btn-default disabled' : 'btn btn-default';
    }
}
