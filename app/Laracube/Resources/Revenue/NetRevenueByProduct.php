<?php

namespace App\Laracube\Resources\Revenue;

use App\Laracube\Collections\ProductNetRevenueCollection;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceTable;

class NetRevenueByProduct extends ResourceTable
{
    use RevenueResourceHelperTrait;

    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = ProductNetRevenueCollection::class;

    /** {@inheritdoc} */
    public $heading = 'Net Revenue By Product';

    /** {@inheritdoc} */
    public $subHeading = null;

    /** {@inheritdoc} */
    public static $type = 'simple';

    /** {@inheritdoc} */
    public $columns = 6;

    /** {@inheritdoc} */
    public function query(Request $request)
    {
        return $this->getBaseQuery($request)
            ->join('products', 'products.id', '=', 'orders.product_id')
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
