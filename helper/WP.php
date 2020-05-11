<?php


namespace areutYii2Wp\helper;


use yii\caching\CacheInterface;

class WP
{
    /**
     * @return CacheInterface
     */
    static public function cache()
    {
        return \Yii::$app->getModule('wp')->cache;
    }

}