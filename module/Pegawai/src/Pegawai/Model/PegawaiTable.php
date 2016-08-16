<?php

/*
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

namespace Pegawai\Model;

/**
 * Description of PegawaiTable
 *
 * @author yanni.wijaya
 */

use Zend\Db\TableGateway\TableGateway;

 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\Sql\Select;
 use Zend\Paginator\Adapter\DbSelect;
 use Zend\Paginator\Paginator;

class PegawaiTable {
    //put your code here
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll($paginated=false,Select $select=null) {
//        $resultSet = $this->tableGateway->select();
//        return $resultSet;
        
        if ($paginated) {
             // create a new Select object for the table album
             if (null===$select)
                $select = new Select(); // perbaharui select
             
             $select ->from('pegawai');
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Pegawai());
             // create a new pagination adapter object
             $paginatorAdapter = new DbSelect(
                 // our configured select object
                 $select,
                 // the adapter to run it against
                 $this->tableGateway->getAdapter(),
                 // the result set to hydrate
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             return $paginator;
         }
         $resultSet = $this->tableGateway->select();
         return $resultSet;
    }
    
    public function getPegawai($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row){
            throw new Exception("Row tidak ditemukan");
        }
        return $row;
    }
    
    public function savePegawai(Pegawai $pegawai){
        $data = array(
            'nama'  => $pegawai->nama,
            'nip'   => $pegawai->nip
        );
        
        $id = (int) $pegawai->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            //throw new Exception('Data berhasil di tambahkan');
        } else {    
            if ($this->getPegawai($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                //throw new Exception('Data berhasil di update');
            } else {
                throw new Exception('Data pegawai tidak ditemukan');
            }
        }
    }
    
    public function deletePegawai($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
    
}
