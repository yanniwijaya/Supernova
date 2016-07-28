<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pegawai;

/**
 * Description of Module
 *
 * @author yanni.wijaya
 */

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
 
use Pegawai\Model\Pegawai;
use Pegawai\Model\PegawaiTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
 
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Pegawai\Model\PegawaiTable' =>  function($sm) {
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
