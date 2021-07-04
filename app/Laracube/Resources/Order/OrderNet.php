<?php

namespace App\Laracube\Resources\Order;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class OrderNet extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Net Orders';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Net Orders (excludes refunds)';

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
            ->selectRaw('COUNT(id) AS net_orders')
            ->first();

        return [
            'number' => number_format($number->net_orders),
        ];
    }
}
