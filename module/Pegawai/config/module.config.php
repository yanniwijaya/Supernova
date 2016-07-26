<?php

/* 
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Pegawai\Controller\Pegawai' => 'Pegawai\Controller\PegawaiController', 
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'pegawai' => array(
                'type'      => 'segment',
                'options'   => array(
                    'route'     => '/pegawai[/:action][/:id]',
                    'constraints'   => array(
                        'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'        =>  '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pegawai\Controller\Pegawai',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'pegawai' => __DIR__ . '/../view',
        ),
    ),
);