<?php

namespace App\Laracube\Collections;

use Laracube\Laracube\Base\ResourceTableCollection;

class CustomerNetRevenueCollection extends ResourceTableCollection
{
    /** {@inheritdoc} */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                'user_name' => $item->user_name,
                'user_email' => $item->user_email,
                'total_orders' => number_format($item->total_orders),
                'net_revenue' => '$'.number_format($item->net_revenue),
            ];
        });
    }

    /** {@inheritdoc} */
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
                'value' => 'user_email',
                'text' => 'Email',
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
