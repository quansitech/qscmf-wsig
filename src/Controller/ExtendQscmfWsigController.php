<?php
namespace Wsig\Controller;

use Qscmf\Core\QsController;
use Wsig\Model\WsigColumnConfigModel;

class ExtendQscmfWsigController extends QsController{


    public function save(){
        $post_data = I('post.');

        $model = new WsigColumnConfigModel();
        $model->saveColumn($post_data);

        $this->success('保存成功');
    }
}