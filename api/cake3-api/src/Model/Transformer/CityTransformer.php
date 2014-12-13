<?php
namespace App\Model\Transformer;

use App\Model\Entity\City;
use League\Fractal;

/**
 * City Transformer.
 */
class CityTransformer extends Fractal\TransformerAbstract {

	public function transform(City $city)
	{
	    return [
	        'id'      => (int) $city->id,
	        'name'   => $city->name,
	        'district'    => $city->district,
	        'population'    => (int) $city->population,
	    ];
	}

}
