<?php
/**
 * UsuarioVeiculo Fixture
 */
class UsuarioVeiculoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'veiculo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'veiculo_id' => 1,
			'usuario_id' => 1,
			'created' => '2017-10-06 13:13:31',
			'modified' => '2017-10-06 13:13:31'
		),
	);

}
