<?php

namespace App\Laracube\Resources\Refund;

use App\Models\Order;
use Illuminate\Http\Request;

trait RefundResourceHelperTrait
{
    /**
     * Get base query.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    private function getBaseQuery(Request $request)
    {
        return clone Order::where('is_refunded', 1)
            ->when($request->get('customer_id'), function ($query, $filter) {
                return $query->where('orders.user_id', $filter);
            })
            ->when($request->get('product_ids'), function ($query, $filter) {
                return $query->whereIn('orders.product_id', $filter);
            });
    }

    /**
     * No records found output.
     *
     * @return array[]
     */
    private function noRecordsFoundOutput()
    {
        return [
            [
                'type' => 'customHtml',
                'data' => [
                    'value' => 'No records found',
                ],
            ],
        ];
    }
}
