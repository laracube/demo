<?php

namespace App\Laracube\Resources\Customer;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class CustomerAverageNetRevenue extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Average Net Revenue';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Average net revenue per customer.';

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
            ->selectRaw('SUM(total_amount)/COUNT(DISTINCT user_id) AS average_revenue')
            ->get()
            ->first();

        return [
            'number' => '$'.number_format($number->average_revenue),
        ];
    }
}
