<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%options}}".
 *
 * @property int $option_id
 * @property string $option_name
 * @property string $option_value
 * @property string $autoload
 */
class Options extends BaseActiveRecord
{
    const FIELD_OPTION_NAME = 'option_name';
    const FIELD_OPTION_VALUE = 'option_value';
    const FIELD_ID = 'option_id';
    const FIELD_AUTOLOAD = 'autoload';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * @param string|integer|array $key
     *
     * @return false|string|null ;
     */
    public static function findValueByKey($key)
    {
        return static::find()->whereKey( $key )->select( static::FIELD_OPTION_VALUE )->asArray()->scalar();
    }

    /**
     * @param string|integer|array $key
     *
     * @return bool
     */
    public static function existsValueByKey($key)
    {
        return static::find()->whereKey( $key )->exists();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_value'], 'required'],
            [['option_value'], 'string'],
            [['option_name'], 'string', 'max' => 191],
            [['autoload'], 'string', 'max' => 20],
            [['option_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'option_id' => Yii::t( 'app', 'Option ID' ),
            'option_name' => Yii::t( 'app', 'Option Name' ),
            'option_value' => Yii::t( 'app', 'Option Value' ),
            'autoload' => Yii::t( 'app', 'Autoload' ),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionsQuery( get_called_class() );
    }
}
