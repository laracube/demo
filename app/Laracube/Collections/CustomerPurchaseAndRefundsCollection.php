<?php

namespace App\Laracube\Collections;

use Laracube\Laracube\Base\ResourceTableCollection;

class CustomerPurchaseAndRefundsCollection extends ResourceTableCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                'user_name' => $item->user_name,
                'total_orders' => number_format($item->total_orders),
                'gross_revenue' => '$'.number_format($item->gross_revenue),
                'refunded_orders' => number_format($item->refunded_orders),
                'refunded_amount' => '$'.number_format($item->refunded_amount),
                'total_fees' => '$'.number_format($item->total_fees),
                'net_revenue' => '$'.number_format($item->net_revenue),
            ];
        });
    }

    /**
     * Get the columns definition for the report.
     *
     * @return array
     */
    public static function columns()
    {
        return [
            [
                'value' => 'user_name',
                'text' => 'Name',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'total_orders',
                'text' => 'Total Orders',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'gross_revenue',
                'text' => 'Gross revenue',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'refunded_orders',
                'text' => 'Refunded Orders',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'refunded_amount',
                'text' => 'Refunded Amount',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'total_fees',
                'text' => 'Total Fees',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'net_revenue',
                'text' => 'Net Revenue',
                'tooltip' => null,
                'sortable' => false,
            ],
        ];
    }
}
