<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookmarks Model
 */
class BookmarksTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('bookmarks');
		$this->displayField('title');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		$this->belongsToMany('Tags', [
			'foreignKey' => 'bookmark_id',
			'targetForeignKey' => 'tag_id',
			'joinTable' => 'bookmarks_tags',
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('user_id', 'create')
			->notEmpty('user_id')
			->allowEmpty('title')
			->allowEmpty('description')
			->allowEmpty('url');

		return $validator;
	}

	public function findTagged(Query $query, array $options) {
		$fields = [
	        'Bookmarks.id',
	        'Bookmarks.title',
	        'Bookmarks.url',
	    ];
	    return $this->find()
	        ->distinct($fields)
	        ->matching('Tags', function($q) use ($options) {
	            return $q->where(['Tags.title IN' => $options['tags']]);
	        });
	}

	public function beforeSave($event, $entity, $options) {
	    if ($entity->tag_string) {
	        $entity->tags = $this->_buildTags($entity->tag_string);
	    }
	}

	protected function _buildTags($tagString) {
	    $new = array_unique(array_map('trim', explode(',', $tagString)));
	    $out = [];
	    $query = $this->Tags->find()
	        ->where(['Tags.title IN' => $new]);

	    // Remove existing tags from the list of new tags.
	    foreach ($query->extract('title') as $existing) {
	        $index = array_search($existing, $new);
	        if ($index !== false) {
	            unset($new[$index]);
	        }
	    }
	    // Add existing tags.
	    foreach ($query as $tag) {
	        $out[] = $tag;
	    }
	    // Add new tags.
	    foreach ($new as $tag) {
	        $out[] = $this->Tags->newEntity(['title' => $tag]);
	    }
	    return $out;
	}

}
