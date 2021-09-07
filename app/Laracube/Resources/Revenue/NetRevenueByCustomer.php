<?php

namespace App\Laracube\Resources\Revenue;

use App\Laracube\Collections\CustomerNetRevenueCollection;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceTable;

class NetRevenueByCustomer extends ResourceTable
{
    use RevenueResourceHelperTrait;

    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = CustomerNetRevenueCollection::class;

    /** {@inheritdoc} */
    public $heading = 'Net Revenue By Customer';

    /** {@inheritdoc} */
    public $subHeading = null;

    /** {@inheritdoc} */
    public static $perPageOptions = 5;

    /** {@inheritdoc} */
    public $columns = 12;

    /** {@inheritdoc} */
    public function query(Request $request)
    {
        return $this->getBaseQuery($request)
            ->join('users', 'orders.user_id', '=', 'users.id')
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
