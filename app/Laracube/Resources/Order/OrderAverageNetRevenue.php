<?php

namespace App\Laracube\Resources\Order;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class OrderAverageNetRevenue extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Average Revenue';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Average net revenue per order';

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
            ->selectRaw('SUM(total_amount)/COUNT(id) AS average_revenue')
            ->first();

        return [
            'number' => '$'.number_format($number->average_revenue),
        ];
    }
}
