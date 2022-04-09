<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class KeywordFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    * @param string $value
    * @param Builder $builder
    */
    public $relations = [];

    public function user(string $value, Builder $builder)
    {
        $builder->where('first_name','like',"%$value");
    }
}
