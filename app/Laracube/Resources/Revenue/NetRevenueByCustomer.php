<?php

namespace App\Laracube\Resources\Revenue;

use App\Laracube\Collections\CustomerNetRevenueCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class NetRevenueByCustomer extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = CustomerNetRevenueCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Net Revenue By Customer';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = null;

    /**
     * The per-page options for the resource.
     *
     * @var array
     */
    public static $perPageOptions = 10;

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 12;

    /**
     * Get the query for the report.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function query()
    {
        return Order::join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.is_refunded', 0)
            ->groupBy('users.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                users.id AS user_id,
                users.name AS user_name,
                users.email AS user_email,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ');
    }
}
