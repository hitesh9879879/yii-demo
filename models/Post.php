<?php

namespace app\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return '{{%posts}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'post_image'], 'required'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param int|string $id the ID to be looked for.
     * @return static|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given access token.
     *
     * @param string $token the access token.
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * @return static|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username.
     *
     * @param string $username the username to be looked for.
     * @return static|null the identity object that matches the given username.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Returns the ID of the current user.
     *
     * @return int|string current user ID.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the authentication key of the current user.
     *
     * @return string the authentication key.
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given authentication key.
     *
     * @param string $authKey the given authentication key.
     * @return bool whether the authentication key is valid.
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates the given password.
     *
     * @param string $password the password to validate.
     * @return bool whether the password is valid.
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

}
