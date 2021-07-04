<?php

namespace App\Laracube\Resources\Customer;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class CustomerPaying extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Paying Customers';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'At-least 1 non-refunded purchase';

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 4;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $number = Order::where('is_refunded', 0)
            ->selectRaw('COUNT(DISTINCT user_id) AS paying_customers')
            ->first();

        return [
            'number' => number_format($number->paying_customers),
        ];
    }
}