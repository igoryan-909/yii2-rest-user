<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы "user".
 *
 * @property int $id
 * @property int $phone Номер телефона
 * @property string $first_name Имя
 * @property string $middle_name Отчество
 * @property string $last_name Фамилия
 * @property int $gender Пол
 * @property string $birthday Дата рождения
 * @property string $password_hash Хеш пароля
 * @property string $auth_key Ключ авторизации
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 * 
 * @property Token[] $tokens
 */
class User extends ActiveRecord
{
    public const GENDER_MALE = 0;
    public const GENDER_FEMALE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'first_name', 'last_name', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['phone', 'gender', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['phone', 'gender', 'created_at', 'updated_at'], 'integer'],
            [['birthday'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Номер телефона',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'gender' => 'Пол',
            'birthday' => 'Дата рождения',
            'password_hash' => 'Хеш пароля',
            'auth_key' => 'Ключ авторизации',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return array
     */
    public static function genderList(): array
    {
        return [
            static::GENDER_MALE => 'Мужской',
            static::GENDER_FEMALE => 'Женский',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::class, ['user_id' => 'id']);
    }
}
