<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */

     public function beforeSave($insert)
     {
         if (parent::beforeSave($insert)) {
             if ($this->isNewRecord) {
                 $this->created_at = new \yii\db\Expression('NOW()');
                 $this->updated_at = new \yii\db\Expression('NOW()');
             } else {
                 $this->updated_at = new \yii\db\Expression('NOW()');
             }
 
             if ($this->isNewRecord || $this->isAttributeChanged('password')) {
                 $this->password = Yii::$app->security->generatePasswordHash($this->password);
             }
 
             return true;
         }
         return false;
     }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'role', 'status'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            [['role', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return static::findOne(['access_token' => $token]);
        throw new \yii\base\NotSupportedException();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // return $this->auth_key;
    
        throw new \yii\base\NotSupportedException();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // return $this->getAuthKey() === $authKey;
        throw new \yii\base\NotSupportedException();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // $this->password = Yii::$app->security->generatePasswordHash($this->password);
        // dd( $this->password);
        // dd( $password);
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
}
