<?php
namespace Wsig;

use Wsig\Model\WsigColumnConfigModel;

class WsigData{

    public static function getValue($key){
        $model = new WsigColumnConfigModel();
        return $model->where(['key' => $key])->getField('value');
    }
}