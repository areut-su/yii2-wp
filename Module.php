<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace areutYii2Wp;

use areutYii2Wp\components\Options;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    /**
     * @var callable cheak acsees
     */
    public $matchCallback;


    public function __construct($id, $parent = null, $config = [])
    {
        parent::__construct( $id, $parent, $config );


        try {
            if (!isset( $config['components']['cache'] )) {
                $this->set( 'cache',
                    [
                        'class' => 'yii\caching\ArrayCache',
                    ] );
            }
            if (!isset( $config['components']['options'] )) {
                $this->set( 'options',
                    [
                        'class' => 'areutYii2Wp\components\Options',
                    ] );
            }
        } catch (InvalidConfigException $e) {
            /** @noinspection PhpUnhandledExceptionInspection */
            throw new InvalidConfigException( $e );
        }
    }


    public $controllerNamespace = 'areutYii2Wp\controllers';

    public function init()
    {


        parent::init();
        $this->matchCallback = $this->matchCallback ?? (function ($rule, $action) {
                return (isset( \Yii::$app->user->isGuest ) && \Yii::$app->user->identity->username === 'admin');
            });

    }

    /**
     * Returns the cache component.
     * @return object|\yii\caching\CacheInterface
     */
    public function getCache()
    {

        return $this->get( 'cache', false );
    }

    /**
     * @return Options|object|null
     * @throws InvalidConfigException
     */
    public function getOption()
    {

        return $this->get( 'options', false );
    }

    public function behaviors()
    {
        /*if ( $this instanceof \yii\base\Module ) {
            $controller = \Yii::$app->controller;
        } else {
            $controller = $this;
        }*/
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => $this->matchCallback,
                    ],
                ],
            ],
        ];
    }
}
