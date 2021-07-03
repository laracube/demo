<?php

namespace App\Laracube\Collections;

use Illuminate\Support\Carbon;
use Laracube\Laracube\Base\ResourceTableCollection;

class ProductCollection extends ResourceTableCollection
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
                'user_email' => $item->user_email,
                'number_of_orders' => number_format($item->number_of_orders),
                'total_spent' => '$'.number_format($item->total_spent),
                'total_discount' => '$'.number_format($item->total_discount),
                'total_fees' => '$'.number_format($item->total_fees),
                'registered_at' => Carbon::parse($item->registered_at)->longAbsoluteDiffForHumans(),
                'first_order_date' => Carbon::parse($item->first_order_date)->toDateString(),
                'last_order_date' => Carbon::parse($item->last_order_date)->toDateString(),
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
                'tooltip' => 'Name of the user',
                'sortable' => false,
            ],
            [
                'value' => 'user_email',
                'text' => 'Email',
                'tooltip' => 'Email of the user',
                'sortable' => false,
            ],
            [
                'value' => 'number_of_orders',
                'text' => 'Number of Orders',
                'tooltip' => 'Number of Orders made by the user',
                'sortable' => false,
            ],
            [
                'value' => 'total_spent',
                'text' => 'Total Spent',
                'tooltip' => 'Total dollar amount spent by the user',
                'sortable' => false,
            ],
            [
                'value' => 'total_discount',
                'text' => 'Total Discount',
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
                'value' => 'registered_at',
                'text' => 'Relationship Length',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'first_order_date',
                'text' => 'First Order Date',
                'tooltip' => null,
                'sortable' => false,
            ],
            [
                'value' => 'last_order_date',
                'text' => 'Last Order Date',
                'tooltip' => null,
                'sortable' => false,
            ],
        ];
    }
}
