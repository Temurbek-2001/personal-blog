<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Security;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password; // For storing plain password during signup
    public $rememberMe;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['username', 'password'], 'required'], // Mark fields as required
            [['username'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6], // Minimum password length
            [['username'], 'unique'], // Ensure username is unique
        ];


    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Implement IdentityInterface methods
     *
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id); // Find user by id in the database
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]); // Find user by access token
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]); // Find user by username
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey; // Validate auth key
    }

    /**
     * Validates password
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash); // Validate hashed password
    }

    /**
     * Set password hash before saving
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password); // Hash password before saving
    }

    /**
     * Generates a new auth key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString(32); // Generate auth key
    }

    /**
     * Generates a new access token
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString(); // Generate access token
    }

    /**
     * Signup method to register new users
     *
     * @param array $data
     * @return bool
     */
    public function signup($data)
    {
        if ($this->load($data) && $this->validate()) {
            // Hash the password
            $this->setPassword($this->password);
            // Generate auth key and access token
            $this->generateAuthKey();
            $this->generateAccessToken();
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
            return $this->save(); // Save user to the database
        }
        return false;
    }

    /**
     * Login method to authenticate users
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function login($username, $password)
    {
        $user = static::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            // Set the identity in the session
            Yii::$app->user->login($user);
            return true;
        }
        return false;
    }
}
