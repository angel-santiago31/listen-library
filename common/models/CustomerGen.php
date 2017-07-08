<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $initial
 * @property integer $age
 * @property string $email
 * @property integer $phone_number_1
 * @property integer $phone_number_2
 * @property string $auth_key
 * @property string $password_hash
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CreditCard[] $creditCards
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'age', 'email', 'phone_number_1', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['age', 'phone_number_1', 'phone_number_2', 'status', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 18],
            [['initial'], 'string', 'max' => 1],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Customer Id',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'initial' => 'Initial',
            'age' => 'Age',
            'email' => 'E-mail',
            'phone_number_1' => 'Primary Phone Number',
            'phone_number_2' => 'Secondary Phone Number(Optional)',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditCards()
    {
        return $this->hasMany(CreditCard::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
