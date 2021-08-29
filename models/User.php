<?php

namespace app\models;
use app\models\Users;
use app\models\Berita;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $user_id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $role;
    public $name;
    public $email;
    public $phone;


    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($user_id)
    {
        $user = Users::findOne($user_id);
        if (count([$user])) {
            return new static($user);
        }
        return null;

        
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = Users::find()->where(['accessToken' => $token])->one();
        if (count([$user])) {
            return new static($user);
        }
        return null;
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = Users::find()->where(['username' => $username])->one();
        if (count([$user])) {
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
