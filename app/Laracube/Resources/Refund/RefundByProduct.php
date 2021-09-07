<?php

namespace App\Laracube\Resources\Refund;

use App\Laracube\Collections\ProductRefundCollection;
use App\Models\Order;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceTable;

class RefundByProduct extends ResourceTable
{
    use RefundResourceHelperTrait;

    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = ProductRefundCollection::class;

    /** {@inheritdoc} */
    public $heading = 'Refund By Product';

    /** {@inheritdoc} */
    public $subHeading = null;

    /** {@inheritdoc} */
    public static $perPageOptions = 10;

    /** {@inheritdoc} */
    public $columns = 6;

    /** {@inheritdoc} */
    public function query(Request $request)
    {
        return $this->getBaseQuery($request)
            ->join('products', 'products.id', '=', 'orders.product_id')
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
