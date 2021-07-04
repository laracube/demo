<?php

namespace App\Laracube\Resources\Order;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class OrderRefunded extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Total Order';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Total orders that was refunded';

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
        $number = Order::where('is_refunded', 1)
            ->selectRaw('COUNT(id) AS total_order')
            ->first();

        return [
            'number' => number_format($number->total_order),
        ];
    }
}
