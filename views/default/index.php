<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Inflector;

/*
 * @var yii\web\View $this
 */
$controllers = \dmstr\helpers\Metadata::getModuleControllers($this->context->module->id);
$favourites  = [];
$m           = new \areutYii2Wp\components\Options;
$m->getAutoLoad();
echo  $m->get('mailserver_url');

?>

<div class="row">

    <?= 'Провекра вывод' ?>
    <pre>
<!--    --><?php //print_r(\Yii::$app->controller->module->cache) ?>
<!--    --><?php //print_r(\Yii::$app->controller->module) ?>
</pre>

</div>

