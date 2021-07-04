<?php

namespace App\Laracube\Resources\Revenue;

use App\Laracube\Collections\ProductNetRevenueCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class NetRevenueByProduct extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = ProductNetRevenueCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Net Revenue By Product';

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
            ->where('orders.is_refunded', 0)
            ->groupBy('products.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                products.id AS product_id,
                products.name AS product_name,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ');
    }
}
