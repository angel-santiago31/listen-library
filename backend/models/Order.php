<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Customer;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $item_quantity
 * @property integer $purchase_date
 * @property string $status
 * @property integer $customer_id
 * @property integer $credit_card
 * @property double $price_total
 * @property Contains[] $contains
 * @property Customer $customer
 * @property CreditCard $creditCard
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 'Deleted';
    const STATUS_ACTIVE = 'Active';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            // Other behaviors
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'purchase_date',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_quantity', 'status', 'customer_id', 'credit_card', 'price_total'], 'required'],
            [['item_quantity', 'customer_id', 'credit_card'], 'integer'],
            [['price_total'], 'number'],
            [['purchase_date'], 'safe'],
            [['status'], 'string', 'max' => 18],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['credit_card'], 'exist', 'skipOnError' => true, 'targetClass' => CreditCard::className(), 'targetAttribute' => ['credit_card' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Order #',
            'item_quantity' => 'Items in Order',
            'purchase_date' => 'Order Date',
            'status' => 'Order Status',
            'customer_id' => 'Customer Id',
            'credit_card' => 'Credit Card Id',
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
    public function getCreditCard()
    {
        return $this->hasOne(CreditCard::className(), ['id' => 'credit_card']);
    }

    public function isCartEmpty()
    {
        return (Yii::$app->cart->getCount() == NULL) ? 'btn btn-default disabled' : 'btn btn-default';
    }
}
