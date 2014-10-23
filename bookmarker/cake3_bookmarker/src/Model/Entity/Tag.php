<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Tag Entity.
 */
class Tag extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'title' => true,
		'bookmarks' => true,
	];

	protected function _getTagString() {
	    if (isset($this->_properties['tag_string'])) {
	        return $this->_properties['tag_string'];
	    }
	    $tags = new Collection($this->tags);
	    $str = $tags->reduce(function ($string, $tag) {
	        return $string . $tag->title . ', ';
	    }, '');
	    return trim($str, ', ');
	}

}
