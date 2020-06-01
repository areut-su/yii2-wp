<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace areutYii2Wp\helper;


use areutYii2Wp\Module;
use yii\caching\CacheInterface;

class WP
{
    /**
     * @return CacheInterface
     */
    static public function cache()
    {
        return self::moduleWp()->getCache();
    }

    public static function options()
    {
        return self::moduleWp()->getOption();
    }

    /**
     * @return Module|\yii\base\Module|null
     */
    private static function moduleWp()
    {
        return \Yii::$app->getModule( 'wp' );
    }

}