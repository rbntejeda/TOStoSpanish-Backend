<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tos_translate".
 *
 * @property integer $id
 * @property integer $base_id
 * @property integer $user_id
 * @property string $body
 * @property string $coment
 * @property string $link
 * @property integer $level
 * @property string $status
 * @property string $creado
 * @property string $modificado
 *
 * @property TosBase $base
 * @property User $user
 * @property TosTranslateComent[] $tosTranslateComents
 * @property UserLike[] $userLikes
 * @property User[] $users
 */
class TosTranslate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tos_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['base_id', 'body'], 'required'],
            [['base_id', 'user_id', 'level'], 'integer'],
            [['body', 'coment', 'status'], 'string'],
            [['creado', 'modificado'], 'safe'],
            [['link'], 'string', 'max' => 128],
            [['base_id', 'user_id'], 'unique', 'targetAttribute' => ['base_id', 'user_id'], 'message' => 'The combination of Base ID and User ID has already been taken.'],
            [['base_id'], 'exist', 'skipOnError' => true, 'targetClass' => TosBase::className(), 'targetAttribute' => ['base_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_id' => 'Base ID',
            'user_id' => 'User ID',
            'body' => 'Body',
            'coment' => 'Coment',
            'link' => 'Link',
            'level' => 'Level',
            'status' => 'Status',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBase()
    {
        return $this->hasOne(TosBase::className(), ['id' => 'base_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTosTranslateComents()
    {
        return $this->hasMany(TosTranslateComent::className(), ['tran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLikes()
    {
        return $this->hasMany(UserLike::className(), ['tran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_like', ['tran_id' => 'id']);
    }
}
