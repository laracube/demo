<?php

namespace App\Laracube\Resources;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class AverageRefundByOrder extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Average Refund';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Average refund per order.';

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $number = Order::where('is_refunded', 1)
            ->selectRaw('SUM(total_amount)/COUNT(id) AS average_revenue')
            ->get()
            ->first();

        return [
            'number' => '$'.number_format($number->average_revenue),
        ];
    }
}
