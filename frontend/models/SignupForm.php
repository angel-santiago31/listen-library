<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Customer;
use backend\models\CreditCard;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $initial;
    public $age;
    public $phone_number_1;
    public $phone_number_2;
    public $card_last_digits;
    public $expiration_date;
    public $card_type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['first_name', 'last_name', 'age', 'phone_number_1'], 'required'],
            [['first_name', 'last_name', 'age'], 'string', 'max' => 18],
            ['initial', 'string', 'max' => 1, 'min' => 1],
            [['phone_number_1', 'phone_number_2'], 'safe'],

            [['card_last_digits', 'expiration_date'], 'safe'],
            ['card_type', 'string'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $customer = new Customer();
        $customer->email = $this->email;
        $customer->setPassword($this->password);
        $customer->generateAuthKey();
        $customer->first_name = $this->first_name;
        $customer->last_name = $this->last_name;
        $customer->initial = $this->initial;
        $customer->age = $this->age;
        $customer->phone_number_1 = $this->phone_number_1;
        $customer->phone_number_2 = $this->phone_number_2;

        if ($customer->save()) {
            $credit_card = new CreditCard();
            $credit_card->customer_id = $customer->id;
            $credit_card->card_last_digits = $this->card_last_digits;
            $credit_card->expiration_date = $this->expiration_date;
            $credit_card->card_type = $this->card_type;
            $credit_card->save(false);

            return $customer;
        }

        return null;
    }
}
