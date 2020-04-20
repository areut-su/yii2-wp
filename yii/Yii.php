<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */


require WP_YII2_PATH_VENDOR . 'yiisoft/yii2/BaseYii.php';


class Yii extends \yii\BaseYii
{
}

spl_autoload_register(['Yii', 'autoload'], true, true);
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Application.php');
Yii::$container = new yii\di\Container();
