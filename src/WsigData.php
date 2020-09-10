<?php
namespace Wsig;

use Wsig\Model\WsigColumnConfigModel;

class WsigData{

    static protected $save;

    public static function getValue($key){
        $model = new WsigColumnConfigModel();
        return $model->where(['key' => $key])->getField('value');
    }

    public static function registerSave(\Closure $save){
        self::$save = $save;
    }

    public static function callSave($wsig_data){
        if(self::$save instanceof \Closure){
            call_user_func(self::$save, $wsig_data);
        }
    }
}