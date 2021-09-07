<?php

namespace App\Laracube\Filters;

use App\Models\User;
use Laracube\Laracube\Base\Filter;

class CannotSeeCustomerFilter extends Filter
{
    /** {@inheritdoc} */
    public $heading = 'Cannot See, Select Customer';

    /** {@inheritdoc} */
    public $key = 'cannot_see_customer_id';

    /** {@inheritdoc} */
    public static $type = 'single-select';

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

    /** {@inheritdoc} */
    public function options()
    {
        return User::orderBy('name')
            ->selectRaw('id AS value, name AS text')
            ->get();
    }
}
