<?php

namespace app\modules\apiv1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Base controller for the `apiv1` module
 */
class BaseController extends ActiveController
{
    public static function allowedDomains()
    {
        return [$_SERVER["REMOTE_ADDR"], $_ENV['ALOWEDDOMAIN']];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge($behaviors, [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => static::allowedDomains(),
                    'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,
                    'Access-Control-Allow-Headers' => ['authorization', 'X-Request-With', 'content-type'],
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'X-Pagination-Page-Coutn', 'X-Pagination-Total-Coutn']
                ],
            ],
        ]);
    }
}
