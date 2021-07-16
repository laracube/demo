<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;
use function number_format;

class NetRevenueHighestSpender extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Highest Spender';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Customer with the most net revenue';

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 12;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $line1 = $this->getLine1();

        $name = $line1->name;
        $netRevenue = '$'.number_format($line1->net_revenue);

        return [
            'line1' => [
                'value' => "{$name} <span class='text-h5'>with</span> {$netRevenue}",
            ],
        ];
    }

    /**
     * Get line 1.
     *
     * @return mixed
     */
    private function getLine1()
    {
        return Order::join('users', 'orders.user_id', 'users.id')
            ->where('is_refunded', 0)
            ->groupBy('users.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                users.name AS name,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ')
            ->first();
    }
}
