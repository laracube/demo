<?php

namespace App\Laracube\Resources;

use App\Laracube\Collections\ProductCollection;
use App\Models\Order;
use Laracube\Laracube\Base\ResourceTable;

class PurchaseAndRefundsByProduct extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = ProductCollection::class;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Total Purchase and Refunds by Product';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Table that shows gross and net revenue generated by Product';

    /**
     * The type of the resource.
     *
     * @var string
     */
    public static $type = 'simple';

    /**
     * Get the query for the report.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function query()
    {
        return Order::join('products', 'products.id', '=', 'orders.product_id')
            ->groupBy('products.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                products.id AS products_id,
                products.name AS product_name,
                COUNT(orders.id) AS total_orders,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(CASE WHEN orders.is_refunded = 1 THEN 1 ELSE 0 END) AS refunded_orders,
                SUM(CASE WHEN orders.is_refunded = 1 THEN orders.total_amount ELSE 0 END) AS refunded_amount,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(CASE WHEN orders.is_refunded = 1 THEN orders.total_amount ELSE 0 END) - SUM(orders.fees) AS net_revenue
            ');
    }
}
