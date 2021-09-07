<?php

namespace App\Laracube\Filters;

use App\Models\Product;
use Laracube\Laracube\Base\Filter;

class ProductFilter extends Filter
{
    /** {@inheritdoc} */
    public $heading = 'Select Products';

    /** {@inheritdoc} */
    public $key = 'product_ids';

    /** {@inheritdoc} */
    public static $type = 'multiple-select';

    /** {@inheritdoc} */
    public function options()
    {
        return Product::orderBy('name')
            ->selectRaw('id AS value, name AS text')
            ->get();
    }
}
