<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authKey', 'accessToken'], 'required'],
        ];
    }

    public function register($data)
    {
        if ($this->validate()) {
            $user_email = htmlspecialchars($data[0]);
            $username = htmlspecialchars($data[1]);
            $password = htmlspecialchars($data[2]);
            $link = \yii\helpers\Url::to(['site/accept', 'email' => $user_email, 'pass' => $password], true);

            Yii::$app->mailer->compose()
                ->setTo($user_email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setCc(Yii::$app->params['adminEmail'])
                ->setSubject($username . ' you are successfully registered.')
                ->setHtmlBody('
                    <!doctype html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="format-detection" content="telephone=no"/>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <title>Welcome To Demo Project.</title>
                    </head>
                    <body>
                        <div class="container p-5">
                            <div class="d-flex justify-content-center flex-column">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">Welcome To Demo Project.</h6>
                                        <p class="card-text">We\'re excited to have you on board. To complete your registration and start using our services, please confirm your email address by clicking the button below.</p>
                                        <a href="'. $link .'" class="btn btn-primary mt-3">Confirm</a>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">' . $username . ', Your Registration Data.</h6>
                                        <p class="card-text"><b>User Name : </b>' . $username . '</p>
                                        <p class="card-text"><b>User Email : </b>' . $user_email . '</p>
                                        <p class="card-text"><b>User Password : </b>' . $password . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>
                ')
                ->send();

            return true;
        }
        return false;
    }

    public function account_activation($data)
    {
        if ($this->validate()) {
            $user_email = htmlspecialchars($data['email']);
            $user_name = htmlspecialchars($data['user_name']);

            Yii::$app->mailer->compose()
                ->setTo($user_email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setCc(Yii::$app->params['adminEmail'])
                ->setSubject( $user_name . ' Your Account is activated.')
                ->setHtmlBody('
                    <!doctype html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="format-detection" content="telephone=no"/>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <title>Account Activation</title>
                    </head>
                    <body>
                        <div class="container p-5">
                            <div class="d-flex justify-content-center flex-column">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">'. $user_name .', Your Account is Activated!</h6>
                                        <p class="card-text">Hello '. $user_name .',</p>
                                        <p>We are excited to inform you that your account has been successfully activated. You can now access all features and services available to you.</p>
                                        <p>Thank you for being a part of our community. We are here to support you every step of the way.</p>
                                        <p>Enjoy your experience!</p>
                                        <p>Best regards,<br>The '. Yii::$app->params['projectName'] .' Team</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>
                ')
                ->send();

            return true;
        }
        return false;
    }

    public function forgot($email)
    {
        if ($this->validate()) {
            $user_email = htmlspecialchars($email[0]);
            $link = \yii\helpers\Url::to(['site/new-password', 'email' => $user_email], true);

            Yii::$app->mailer->compose()
                ->setTo($user_email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setCc(Yii::$app->params['adminEmail'])
                ->setSubject('Forgot password.')
                ->setHtmlBody('
                    <!doctype html>
                    <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta name="format-detection" content="telephone=no"/>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                            <title>Click Here to Reset Password.</title>
                        </head>
                        <body>
                            <div class="container p-5">
                                <div class="d-flex justify-content-center flex-column">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">Forgot Password?</h6>
                                            <p class="card-text">
                                                We received a request to reset the password for your account associated with 
                                                '. $user_email .'.
                                                If you did not request this, please ignore this email. Otherwise, click the button below to reset your password.
                                            </p>
                                            <a href="'. $link .'" class="btn btn-primary mt-3">Reset Password</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                ')
                ->send();

            return true;
        }
        return false;
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
     * Finds user by username.
     *
     * @param string $username the username to be looked for.
     * @return static|null the identity object that matches the given username.
     */
    public static function findByEmail($user_email)
    {
        return static::findOne(['email' => $user_email]);
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
