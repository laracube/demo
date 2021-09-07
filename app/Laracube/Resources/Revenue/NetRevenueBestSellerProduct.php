<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class NetRevenueBestSellerProduct extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Best Seller';

    /** {@inheritdoc} */
    public $subHeading = 'Product with the most net revenue';

    /** {@inheritdoc} */
    public $columns = 6;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->join('products', 'orders.product_id', 'products.id')
            ->groupBy('products.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                products.id AS product_id,
                products.name AS product_name,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ')
            ->first();

        if (! $line1) {
            return $this->noRecordsFoundOutput();
        }

        $productName = $line1->product_name;
        $netRevenue = '$'.number_format($line1->net_revenue);

        $sparkline = $this->getBaseQuery($request)
            ->where('product_id', $line1->product_id)
            ->selectRaw('
                strftime("%Y", created_at) AS year,
                strftime("%m", created_at) AS month,
                SUM(orders.total_amount) - SUM(orders.fees) AS value,
                strftime("%Y-%m", created_at) AS labels
            ')
            ->groupBy('year', 'month', 'labels')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->limit(4)
            ->get();

        return [
            [
                'type' => 'bigNumber',
                'data' => [
                    'line1' => [
                        'value' => "{$productName} <span class='text-h5'>with</span> {$netRevenue}",
                    ],
                ],
            ],
           [
               'type' => 'sparkline',
               'data' => $this->getSparkLineData($sparkline, true),
           ],
        ];
    }
}
