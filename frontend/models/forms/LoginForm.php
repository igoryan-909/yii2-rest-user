<?php
namespace frontend\models\forms;

use common\models\forms\LoginForm as BaseLoginForm;

/**
 * Форма входа.
 */
class LoginForm extends BaseLoginForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'password'], 'required'],
            ['password', 'safe'],
        ];
    }
}
