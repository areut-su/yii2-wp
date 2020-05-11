<?php

namespace areutYii2Wp;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    /**
     * @var callable cheak acsees
     */
    public $matchCallback;


    public function __construct($id, $parent = null, $config = [])
    {
        parent::__construct($id, $parent, $config);


        if (!isset($config['components']['cache']))
        {
            /** @noinspection PhpUnhandledExceptionInspection */
            $this->set('cache',
                [
                    'class' => 'yii\caching\ArrayCache',
                ]);
        }

    }


    public $controllerNamespace = 'areutYii2Wp\controllers';

    public function init()
    {


        parent::init();
        $this->matchCallback = $this->matchCallback ?? (function($rule, $action) {
                return (isset(\Yii::$app->user->isGuest) && \Yii::$app->user->identity->username === 'admin');
            });

    }

    /**
     * Returns the cache component.
     * @return object|\yii\caching\CacheInterface
     */
    public function getCache1()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->get('cache1', false);
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
