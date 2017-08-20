<?php
return array(
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            ),
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),

	'router' => array(
		'routes' => array(
			'application' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'=>'[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Produtos\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
            'produtos' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/produtos[/:page]',
                    'constraints' => array(
                        'page'=>'[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Produtos\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'page'          => 1,
                    ),
                ),
            ),
		),
	),
	'controllers' => array(
        'invokables' => array(
            'Produtos\Controller\Index' => 'Produtos\Controller\IndexController',
            'Produtos\Controller\Usuario' => 'Produtos\Controller\UsuarioController'
        ),
    ),
	'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'produtos/index/index' => __DIR__ . '/../view/produtos/index/index.phtml',            
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'FlashHelper' => 'Produtos\View\Helper\FlashHelper',
            'PaginationHelper' => 'Produtos\View\Helper\PaginationHelper',
        ),
    ),
    'doctrine' => array(
      'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Produtos/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Produtos\Entity' => 'application_entities'
                ),
            ),
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Produtos\Entity\Usuario',
                'identity_property' => 'email',
                'credential_property' => 'senha',
                'credentialCallable' => function($user,$senha){
                    return $user->getSenha() == md5($senha);
                }
                
            )
        )
    ),
	
);