<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 */
class CitiesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('cities');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->belongsTo('Countries', [
			'alias' => 'Countries',
			'foreignKey' => 'country_id'
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator instance
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->requirePresence('name', 'create')
			->notEmpty('name')
			->requirePresence('country_id', 'create')
			->notEmpty('country_id')
			->requirePresence('district', 'create')
			->notEmpty('district')
			->add('population', 'valid', ['rule' => 'numeric'])
			->requirePresence('population', 'create')
			->notEmpty('population');

		return $validator;
	}

/**
 * Custom finder for search
 *
 * @param Query instance
 * @param array instance
 * @return Query
 */
	public function findMatched(Query $query, array $options) {
        $query
        	->where(['Cities.name LIKE' => '%' . $options['q'] . '%'])
        	->orWhere(['Cities.district LIKE' => '%' . $options['q'] . '%']);
        return $query;
    }

}
