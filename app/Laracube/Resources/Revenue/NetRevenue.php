<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class NetRevenue extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Net Revenue';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Net revenue (excludes refunds and fees)';

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
            ->selectRaw('SUM(total_amount) - SUM(fees) AS net_revenue')
            ->first();

        return [
            'number' => '$'.number_format($number->net_revenue),
        ];
    }
}
