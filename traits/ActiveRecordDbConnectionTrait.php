<?php

namespace app\site\modules\yii2wp\traits;

trait ActiveRecordDbConnectionTrait {
	public static function getDb() {
		return \Yii::$app->db;
	}
}
