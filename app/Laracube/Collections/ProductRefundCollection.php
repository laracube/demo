<?php

namespace App\Laracube\Collections;

use Laracube\Laracube\Base\ResourceTableCollection;

class ProductRefundCollection extends ResourceTableCollection
{
    /** {@inheritdoc} */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                'product_name' => $item->product_name,
                'total_orders' => number_format($item->total_orders),
                'total_refund' => '$'.number_format($item->total_refund),
            ];
        });
    }

    /** {@inheritdoc} */
    public static function columns()
    {
        return [
            [
                'value' => 'product_name',
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
                'value' => 'total_refund',
                'text' => 'Total Refunds',
                'tooltip' => null,
                'sortable' => false,
            ],
        ];
    }
}
