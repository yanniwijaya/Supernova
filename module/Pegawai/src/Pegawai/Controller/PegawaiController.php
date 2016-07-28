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
         $form = new PegawaiForm();
         $form->get('submit')->setValue('Add');
         $request = $this->getRequest();
         if ($request->isPost()) {
             $pegawai = new Pegawai();
             $form->setInputFilter($pegawai->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $pegawai->exchangeArray($form->getData());
                 $this->getPegawaiTable()->savePegawai($pegawai);

                 // Redirect to list of pegawai
                 return $this->redirect()->toRoute('pegawai');
             }
         }
         return array('form' => $form);
    }
    
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('pegawai', array(
                 'action' => 'add'
             ));
         }

         // Get the Pegawai with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $pegawai = $this->getPegawaiTable()->getPegawai($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('pegawai', array(
                 'action' => 'index'
             ));
         }

         $form  = new PegawaiForm();
         $form->bind($pegawai);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($pegawai->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getPegawaiTable()->savePegawai($pegawai);

                 // Redirect to list of pegawai
                 return $this->redirect()->toRoute('pegawai');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }
    
    public function deleteAction() {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('pegawai');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getPegawaiTable()->deletePegawai($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('pegawai');
         }

         return array(
             'id'    => $id,
             'pegawai' => $this->getPegawaiTable()->getPegawai($id)
         );
    }
    
}
