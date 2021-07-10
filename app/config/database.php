
                    <?php
                        return array(
                            'default' => 'mysql',
                            'connections' => array(
                                'mysql' => array(
                                    'driver'    => 'mysql',
                                    'host'      => '127.0.0.1',
                                    'database'  => 'qc',
                                    'username'  => 'root',
                                    'password'  => 'daotientu2801',
                                    'charset'   => 'utf8',
                                    'collation' => 'utf8_unicode_ci',
                                    'prefix'    => '',
                                ),
                            ),
							'redis' => [

								'cluster' => true,

								'default' => ['host' => '127.0.0.1', 'port' => 6379],

							]
                        );
                    ?>
            