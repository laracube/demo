<?php

namespace App\Laracube\Resources\Refund;

use App\Laracube\Collections\ProductRefundCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class RefundByProduct extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = ProductRefundCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Refund By Product';

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
        return Order::join('products', 'products.id', '=', 'orders.product_id')
            ->where('orders.is_refunded', 1)
            ->groupBy('products.id')
            ->orderBy('total_refund', 'DESC')
            ->selectRaw('
                products.id AS product_id,
                products.name AS product_name,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) AS total_refund
            ');
    }
}
