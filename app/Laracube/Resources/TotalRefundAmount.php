<?php

namespace App\Laracube\Resources;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class TotalRefundAmount extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Total Amount';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Total amount that was refunded';

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $number = Order::where('is_refunded', 1)
            ->selectRaw('SUM(total_amount) AS total_refunded')
            ->get()
            ->first();

        return [
            'number' => '$'.number_format($number->total_refunded),
        ];
    }
}
