<?php
namespace Wsig\Model;

use Qscmf\Core\QsModel;

class WsigColumnConfigModel extends QsModel{

    public function saveColumn($data){
        collect($data)->each(function($value, $key){
            $ent = $this->where(['key' => $key])->find();
            if($ent){
                $ent['value'] = $value;
                $ent['update_date'] = microtime(true);

                $this->save($ent);
            }
            else{
                $time = microtime(true);

                $ent['key'] = $key;
                $ent['value'] = $value;
                $ent['update_date'] = $time;
                $ent['create_date'] = $time;

                $this->add($ent);
            }
        });
    }
}