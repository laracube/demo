<?php

namespace App\Laracube\Resources\Customer;

use App\Laracube\Collections\CustomerCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class PurchaseAndRefunds extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = CustomerCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Total Purchase and Refunds';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Table that shows gross and net revenue generated from a customer';

    /**
     * Get the query for the report.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function query()
    {
        return Order::join('users', 'users.id', '=', 'orders.user_id')
            ->groupBy('users.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                users.id AS user_id,
                users.name AS user_name,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(CASE WHEN orders.is_refunded = 1 THEN 1 ELSE 0 END) AS refunded_orders,
                SUM(CASE WHEN orders.is_refunded = 1 THEN orders.total_amount ELSE 0 END) AS refunded_amount,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(CASE WHEN orders.is_refunded = 1 THEN orders.total_amount ELSE 0 END) - SUM(orders.fees) AS net_revenue
            ');
    }
}