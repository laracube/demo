<?php

namespace App\Laracube\Resources\Refund;

use App\Laracube\Collections\CustomerRefundCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class RefundByCustomer extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = CustomerRefundCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Refunds By Customer';

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
    public $columns = 6;

    /**
     * Get the query for the report.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function query()
    {
        return Order::join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.is_refunded', 1)
            ->groupBy('users.id')
            ->orderBy('total_refund', 'DESC')
            ->selectRaw('
                users.id AS user_id,
                users.name AS user_name,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) AS total_refund
            ');
    }
}
