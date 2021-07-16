<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class NetAverageRevenueByOrder extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Average Net Revenue/Order';

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
        $line1 = $this->getLine1();

        $line2 = $this->getLine2();

        $trendValue = round((($line1->value - $line2->value) / $line2->value) * 100, 2);

        return [
            'line1' => [
                'value' => '$'.number_format($line1->value),
            ],
            'line2' => [
                'value' => 'from $'.number_format($line2->value),
            ],
            'trend' => [
                'value' => $trendValue.'%',
                'icon' => $trendValue > 0 ? 'fa-arrow-up' : 'fa-arrow-down',
                'class' => $trendValue > 0 ? 'green lighten-5' : 'red lighten-5',
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
        return Order::where('is_refunded', 0)
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(id) AS value')
            ->first();
    }

    /**
     * Get line 2
     *
     * @return mixed
     */
    private function getLine2()
    {
        $lastOrderDate = Order::where('is_refunded', 0)
            ->orderBy('created_at', 'DESC')
            ->first()
            ->created_at;

        return Order::where('is_refunded', 0)
            ->where('created_at', '<', $lastOrderDate->subDays(30))
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(id) AS value')
            ->first();
    }
}
