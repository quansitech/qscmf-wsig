<?php
namespace Wsig;

use Bootstrap\LaravelProvider;
use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use Wsig\Controller\ExtendQscmfWsigController;

class WsigProvider implements Provider, LaravelProvider {

    public function register()
    {
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/qscmf-wsig', __DIR__ . '/../js/dist');

        RegisterContainer::registerController('admin', 'extendQscmfWsig', ExtendQscmfWsigController::class);
    }

    public function registerLara()
    {
        RegisterContainer::registerMigration(__DIR__.'/Database');
    }
}