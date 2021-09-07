<?php

namespace App\Laracube\Filters;

use App\Models\User;
use Laracube\Laracube\Base\Filter;

class CustomerFilter extends Filter
{
    /** {@inheritdoc} */
    public $heading = 'Select Customer';

    /** {@inheritdoc} */
    public $key = 'customer_id';

    /** {@inheritdoc} */
    public static $type = 'single-select';

    /** {@inheritdoc} */
    public function options()
    {
        return User::orderBy('name')
            ->selectRaw('id AS value, name AS text')
            ->get();
    }
}
