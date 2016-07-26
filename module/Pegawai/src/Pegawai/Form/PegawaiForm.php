<?php

/*
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

namespace Pegawai\Form;

/**
 * Description of PegawaiForm
 *
 * @author yanni.wijaya
 */

use Zend\Form\Form;

class PegawaiForm extends Form{
    //put your code here
    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('pegawai');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'nama',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nama',
            ),
        ));
        $this->add(array(
            'name' => 'nip',
            'type' => 'Text',
            'options' => array(
                'label' => 'NIP',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}
