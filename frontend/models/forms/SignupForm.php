<?php
namespace frontend\models\forms;

use common\models\User;
use common\models\forms\SignupForm as BaseSignupForm;

/**
 * Форма регистрации пользователя.
 */
class SignupForm extends BaseSignupForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $nameExpression = '/^[А-Я]{1}[а-я]*\-?[а-я]+$/u';
        $passwordExpression = '/[A-Za-z0-9]*/';
        $phoneExpression = '/[0-9]{11,13}/';

        return [
            ['firstName', 'trim'],
            ['firstName', 'required'],
            ['firstName', 'string', 'max' => 255],
            ['firstName', 'match', 'pattern' => $nameExpression],

            ['middleName', 'trim'],
            ['middleName', 'string', 'max' => 255],
            ['middleName', 'match', 'pattern' => $nameExpression],

            ['lastName', 'trim'],
            ['lastName', 'required'],
            ['lastName', 'string', 'max' => 255],
            ['lastName', 'match', 'pattern' => $nameExpression],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string'],
            ['phone', 'unique', 'targetClass' => User::class, 'message' => 'Такой номер телефона уже используется.'],
            ['phone', 'match', 'pattern' => $phoneExpression],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => $passwordExpression],

            ['gender', 'in', 'range' => array_keys(User::genderList())],

            ['birthday', 'date', 'format' => 'php:Y-m-d'],
        ];
    }
}
