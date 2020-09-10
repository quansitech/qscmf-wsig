<?php
namespace Wsig\Model;

use Qscmf\Core\QsModel;
use Wsig\WsigData;

class WsigColumnConfigModel extends QsModel{

    public function saveColumn($data){
        $this->startTrans();
        try{
            collect($data)->each(function($item, $key){
                $ent = $this->where(['key' => $key])->find();
                if($ent){
                    $ent['type'] = $item['type'];
                    $ent['value'] = $item['value'];
                    $ent['update_date'] = microtime(true);

                    $this->save($ent);
                }
                else{
                    $time = microtime(true);

                    $ent['key'] = $key;
                    $ent['type'] = $item['type'];
                    $ent['value'] = $item['value'];
                    $ent['update_date'] = $time;
                    $ent['create_date'] = $time;

                    $this->add($ent);
                }
            });

            WsigData::callSave($data);

            $this->commit();
            return true;
        }
        catch(\Exception $ex){
            $this->rollback();
            $this->error = $ex->getMessage();
            return false;
        }

    }
}