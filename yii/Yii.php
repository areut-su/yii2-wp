<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

//require __DIR__ . '/BaseYii.php';

require ABSPATH . '/../yii2-basic/vendor/yiisoft/yii2/BaseYii.php';

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class Yii extends \yii\BaseYii
{
}

//YII2_PATH
spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = array_merge(require ABSPATH . '/../yii2-basic/vendor/yiisoft/yii2/classes.php',
    ['areutYii2Wp\yii\Application' => __DIR__ . DIRECTORY_SEPARATOR . 'Application.php',]);

//Yii::$classMap  = require __DIR__ . '/classes.php';

Yii::$container = new yii\di\Container();
