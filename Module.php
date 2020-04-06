<?php

namespace areutYii2Wp;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    /**
     * @var callable cheak acsees
     */
    public $matchCallback;

    public $controllerNamespace = 'areutYii2Wp\controllers';

    public function init()
    {
        parent::init();
        $this->matchCallback = $this->matchCallback ?? (function($rule, $action) {
                return (isset(\Yii::$app->user->isGuest) && \Yii::$app->user->identity->username === 'admin');
            });

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
