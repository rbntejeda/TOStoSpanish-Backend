<?php

namespace app\models;

use Yii;
use \Firebase\JWT\JWT;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const KEYCODE = "BE3B1BBE87831A6D1A777BD7AAC68";

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['name', 'username', 'password', 'email'], 'required'],
            [['creado', 'modificado'], 'safe'],
            [['name', 'email'], 'string', 'max' => 128],
            [['username', 'password'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
        ];
    }

    public function getTranslates()
    {
        return $this->hasMany(TosTranslate::className(), ['user_id' => 'id']);
    }

    public function getBase()
    {
        return $this->hasMany(TosBase::className(), ['id' => 'base_id'])->viaTable('tos_translate', ['user_id' => 'id']);
    }

    public function getTranslateComents()
    {
        return $this->hasMany(TosTranslateComent::className(), ['user_id' => 'id']);
    }

    public function getLikes()
    {
        return $this->hasMany(UserLike::className(), ['user_id' => 'id']);
    }

    public function getTranslatesLikes()
    {
        return $this->hasMany(TosTranslate::className(), ['id' => 'tran_id'])->viaTable('user_like', ['user_id' => 'id']);
    }

    public static function findIdentityByAccessToken($token,$type = null)
    {
        try
        {
            $decoded = JWT::decode($token, static::KEYCODE, array('HS256'));
            return static::findOne($decoded->uid);
        }
        catch(yii\UnexpectedValueException $e){}
        catch(\Firebase\JWT\BeforeValidException $e){}
        catch(\Firebase\JWT\ExpiredException $e){}
        catch(\Firebase\JWT\SignatureInvalidException $e){}
    }

    public function findMultipleMethod($identity,$attributes)
    {
        $query=static::find();
        foreach ($attributes as $attribute)
        {
            $query->orWhere([$attribute=>$identity]);
        }
        return $query;
    }



    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->primaryKey;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($pass)
    {
        return $this->password === $pass;
    }

    public function Token($timeOut = 3600,$type='pwd')
    {
        $token = [
            "uid" => intval($this->primaryKey),
            "typ" => $type,
            'sub' => Yii::$app->security->generateRandomString(4),
            "iat" => time()
        ];
        if($timeOut!==-1){
            $token["exp"]=time()+$timeOut;
        }
        return JWT::encode($token, self::KEYCODE);
    }
    // public function validatePassword($password)
    // {
    //     return Yii::$app->security->validatePassword($password, $this->password);
    // }

    // public function setPassword($password)
    // {
    //     $this->password = Yii::$app->security->generatePasswordHash($password);
    // }
}
