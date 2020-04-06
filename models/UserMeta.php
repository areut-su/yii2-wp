<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%usermeta}}".
 *
 * @property int $umeta_id
 * @property int $user_id
 * @property string|null $meta_key
 * @property string|null $meta_value
 *
 * @property User $user
 */
class UserMeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usermeta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umeta_id' => Yii::t('app', 'Umeta ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'meta_value' => Yii::t('app', 'Meta Value'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['ID' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserMetaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMetaQuery(get_called_class());
    }
}
