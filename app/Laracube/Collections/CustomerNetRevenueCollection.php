<?php

namespace App\Laracube\Collections;

use Laracube\Laracube\Base\ResourceTableCollection;

class CustomerNetRevenueCollection extends ResourceTableCollection
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
                'value' => 'net_revenue',
                'text' => 'Net Revenue',
                'tooltip' => null,
                'sortable' => false,
            ],
        ];
    }
}
