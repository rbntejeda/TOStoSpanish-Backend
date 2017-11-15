<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_like".
 *
 * @property integer $id
 * @property integer $tran_id
 * @property integer $user_id
 * @property string $type
 * @property string $creado
 *
 * @property TosTranslate $tran
 * @property User $user
 */
class UserLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tran_id', 'user_id', 'type'], 'required'],
            [['tran_id', 'user_id'], 'integer'],
            [['type'], 'string'],
            [['creado'], 'safe'],
            [['tran_id', 'user_id'], 'unique', 'targetAttribute' => ['tran_id', 'user_id'], 'message' => 'The combination of Tran ID and User ID has already been taken.'],
            [['tran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TosTranslate::className(), 'targetAttribute' => ['tran_id' => 'id']],
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
            'tran_id' => 'Tran ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'creado' => 'Creado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTran()
    {
        return $this->hasOne(TosTranslate::className(), ['id' => 'tran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
