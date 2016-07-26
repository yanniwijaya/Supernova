<?php

/*
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

namespace Pegawai\Controller;

/**
 * Description of PegawaiController
 *
 * @author yanni.wijaya
 */

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pegawai\Model\Pegawai;
use Pegawai\Form\PegawaiForm;

class PegawaiController extends AbstractActionController{
    //put your code here
    
    protected $pegawaiTable;
  
    public function getPegawaiTable() {
        if(!$this->pegawaiTable){
            $sm = $this->getServiceLocator();
            $this->pegawaiTable = $sm->get('Pegawai\Model\PegawaiTable');
        }
        return $this->pegawaiTable;
    }
    
    public function indexAction() {
        return new ViewModel( array(
            'pegawais' => $this->getPegawaiTable()->fetchAll(),
        ));
    }
    
    public function addAction() {
        
    }
    
    public function editAction() {
        
    }
    
    public function deleteAction() {
        
    }
    
}
