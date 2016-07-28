<?php

/*
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

namespace Pegawai\Model;

/**
 * Description of Pegawai
 *
 * @author yanni.wijaya
 */

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Pegawai implements InputFilterAwareInterface{
    //put your code here
    public $id;
    public $nama;
    public $nip;
    public $mail;
    public $jabatan;
    public $status;
    public $gender;
    public $jenjang_jabatan;
    public $unit;
    public $sub_unit;
    protected $inputFilter;
    
    public function exchangeArray($data) 
    {
        $this->id       = (!empty($data['id']))     ? $data['id']    : null;
        $this->nama     = (!empty($data['nama']))   ? $data['nama']  : null;
        $this->nip      = (!empty($data['nip']))    ? $data['nip']   : null;
        $this->mail     = (!empty($data['mail']))   ? $data['mail']  : null;
        $this->jabatan  = (!empty($data['jabatan']))? $data['jabatan'] : null;
        $this->status   = (!empty($data['status'])) ? $data['status']: null;
        $this->gender   = (!empty($data['gender'])) ? $data['gender']: null;
        $this->jenjang_jabatan   = (!empty($data['jenjang_jabatan'])) ? $data['jenjang_jabatan'] : null;
        $this->unit     = (!empty($data['unit']))   ? $data['unit']  : null;
        $this->sub_unit = (!empty($data['sub_unit'])) ? $data['sub_unit'] : null;
    }
         
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
        $inputFilter = new InputFilter();
        $inputFilter->add(array(
            'name' => 'id',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));
        $inputFilter->add(array(
            'name' => 'nama',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'nip',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
                ),
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
