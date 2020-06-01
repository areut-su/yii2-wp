<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace areutYii2Wp\components;

use areutYii2Wp\helper\WP;
use areutYii2Wp\models\Options as OptionsModel;
use Yii;
use yii\base\Component;
use yii\base\Model;
use yii\caching\CacheInterface;
use yii\caching\Dependency;


class Options extends Component
//    implements CacheInterface
{

    /**
     * @var  $cache CacheInterface
     */
    protected $cache;
    public $duration = 2400;

    public function init($config = [])
    {
        $this->cache = WP::cache();
        $this->cache->serializer = false;
        $this->getAutoLoad();
    }

    public function getAutoLoad()
    {
        $options = OptionsModel::find()
            ->autoload()
            ->indexBy( function ($model) {
                return $this->buildKey( $model['option_name'] );
            } )
            ->select( ['option_value', 'option_name'] )
            ->asArray()
            ->column();
        /** @var array $options */
        $this->cache->multiAdd( $options, $this->duration );
    }

    /**
     * @inheritDoc
     */
    public function buildKey($key)
    {
        return $key;
    }

    /**
     * @inheritDoc
     */
    public function get($key)
    {
        if (!$value = $this->cache->get( $this->buildKey( $key ) )) {
            $value = OptionsModel::findValueByKey( $key );
            if ($value || $value === false) {
                $this->cache->set( $key, $value );
            }
        }
        return $value;
    }

    /**
     * @param $key
     *
     * @return bool;
     */
    public function exists($key)
    {
        if (!$value = $this->cache->exists( $this->buildKey( $key ) )) {
            $value = OptionsModel::existsValueByKey( $key );

        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function multiGet($keys)
    {
        return [];
        // TODO: Implement multiGet() method.
    }


    /**
     * @param      $key
     * @param      $value
     * @param null $duration
     * @param null $dependency
     *
     * @return bool
     */
    public function set($key, $value, $duration = null, $dependency = null)
    {
        $duration = isset( $duration ) ? $duration : $this->duration;
        $this->cache->set( $this->buildKey( $key ), $value, $duration, $dependency );
        $model = OptionsModel::findValueByKey( $key );
        if ($model) {
            $model->option_name = $value;
        } else {
            $model = new OptionsModel;
            $model->option_name = $key;
            $model->option_value = $value;
        }

        return $model->save();

    }

    /**
     * @inheritDoc
     */
    public function multiSet($items, $duration = 0, $dependency = null)
    {

    }

    /**
     * @inheritDoc
     */
    public function add($key, $value, $duration = 0, $dependency = null)
    {
        // TODO: Implement add() method.
    }

    /**
     * @inheritDoc
     */
    public function multiAdd($items, $duration = 0, $dependency = null)
    {
        // TODO: Implement multiAdd() method.
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritDoc
     */
    public function getOrSet($key, $callable, $duration = null, $dependency = null)
    {
        // TODO: Implement getOrSet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}
