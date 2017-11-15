<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tos_translate_coment".
 *
 * @property integer $id
 * @property integer $tran_id
 * @property integer $user_id
 * @property string $coment
 * @property string $status
 * @property string $creado
 * @property string $modificado
 *
 * @property TosTranslate $tran
 * @property User $user
 */
class TosTranslateComent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tos_translate_coment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tran_id', 'user_id', 'coment', 'status'], 'required'],
            [['tran_id', 'user_id'], 'integer'],
            [['coment', 'status'], 'string'],
            [['creado', 'modificado'], 'safe'],
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
            'coment' => 'Coment',
            'status' => 'Status',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
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
