<?php

/*
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

namespace Pegawai;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Pegawai\Model\Pegawai;
use Pegawai\Model\PegawaiTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Description of Module
 *
 * @author yanni.wijaya
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface{
    //put your code here
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__.'/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' .__NAMESPACE__,  
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Pegawai\Model\PegawaiTable' => function ($sm) {
                    $tableGateway = $sm->get('PegawaiTableGateway');
                    $table = new PegawaiTable($tableGateway);
                    return $table;
                },
                'PegawaiTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Pegawai());
                    return new TableGateway('pegawai', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
