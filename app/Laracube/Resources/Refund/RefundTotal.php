<?php

namespace App\Laracube\Resources\Refund;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class RefundTotal extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Total Refund';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Total amount that was refunded';

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
        $line1 = $this->getLine1();

        return [
            'line1' => [
                'value' => '$'.number_format($line1->value),
            ],
        ];
    }

    /**
     * Get line 1
     *
     * @return mixed
     */
    private function getLine1()
    {
        return Order::where('is_refunded', 1)
            ->selectRaw('SUM(total_amount) AS value')
            ->first();
    }
}
