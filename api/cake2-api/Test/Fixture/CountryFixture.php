<?php
/**
 * CountryFixture
 *
 */
class CountryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 3, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 52, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'region' => array('type' => 'string', 'null' => false, 'length' => 26, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'surface_area' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'independence_year' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6, 'unsigned' => false),
		'population' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'life_expectancy' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '3,1', 'unsigned' => false),
		'gnp' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'gnp_oid' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'local_name' => array('type' => 'string', 'null' => false, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'government_form' => array('type' => 'string', 'null' => false, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'head_of_state' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'capital_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'capital_id' => array('column' => 'capital_id', 'unique' => 0)
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
			'id' => 'L',
			'name' => 'Lorem ipsum dolor sit amet',
			'region' => 'Lorem ipsum dolor sit am',
			'surface_area' => 1,
			'independence_year' => 1,
			'population' => 1,
			'life_expectancy' => 1,
			'gnp' => 1,
			'gnp_oid' => 1,
			'local_name' => 'Lorem ipsum dolor sit amet',
			'government_form' => 'Lorem ipsum dolor sit amet',
			'head_of_state' => 'Lorem ipsum dolor sit amet',
			'capital_id' => 1,
			'code' => ''
		),
	);

}
