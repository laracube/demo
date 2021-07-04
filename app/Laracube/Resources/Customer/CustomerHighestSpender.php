<?php

namespace App\Laracube\Resources\Customer;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;
use function number_format;

class CustomerHighestSpender extends ResourceBigNumber
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
    public $columns = 8;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $number = Order::join('users', 'orders.user_id', 'users.id')
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

        $name = $number->name;
        $netRevenue = '$'.number_format($number->net_revenue);

        return [
            'number' => "{$name} <span class='text-h5'>with</span> {$netRevenue}",
        ];
    }
}
