<?php

namespace App\Laracube\Resources\Refund;

use App\Laracube\Collections\CustomerRefundCollection;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceTable;

class RefundByCustomer extends ResourceTable
{
    use RefundResourceHelperTrait;

    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = CustomerRefundCollection::class;

    /** {@inheritdoc} */
    public $heading = 'Refunds By Customer';

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
            ->join('users', 'users.id', '=', 'orders.user_id')
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
