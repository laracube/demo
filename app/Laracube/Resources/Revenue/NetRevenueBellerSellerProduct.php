<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;
use function number_format;

class NetRevenueBellerSellerProduct extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Best Seller';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Product with the most net revenue';

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 12;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $line1 = $this->getLine1();

        $productName = $line1->product_name;
        $netRevenue = '$'.number_format($line1->net_revenue);

        $sparkline = $this->getSparkLine($line1->product_id);

        return [
            'line1' => [
                'value' => "{$productName} <span class='text-h5'>with</span> {$netRevenue}",
            ],
            'sparkline' => [
                'autoDraw' => true,
                'autoDrawDuration' => 2000,
                'autoDrawEasing' => 'ease',
                'autoLineWidth' => false,
                'color' => 'text--secondary',
                'fill' => true,
                'gradient' => ['#9B0000', '#FF0000', '#FFB3B3'],
                'gradientDirection' => 'top',
                'height' => 75,
                'labelSize' => 7,
                'labels' => $sparkline->pluck('labels'),
                'lineWidth' => 2,
                'padding' => 15,
                'showLabels' => false,
                'smooth' => 10,
                'type' => 'trend',
                'value' => $this->getSparklineValue($sparkline),
                'width' => 300,
                'title' => 'Net Revenue',
            ],
        ];
    }

    /**
     * Get line 1.
     *
     * @return mixed
     */
    private function getLine1()
    {
        return Order::join('products', 'orders.product_id', 'products.id')
            ->where('is_refunded', 0)
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
    }

    /**
     * Get Sparkline.
     *
     * @param $productId
     *
     * @return mixed
     */
    private function getSparkLine($productId)
    {
        return Order::where('is_refunded', 0)
            ->where('product_id', $productId)
            ->selectRaw('
                strftime("%Y", created_at) AS year,
                strftime("%m", created_at) AS month,
                SUM(orders.total_amount) - SUM(orders.fees) AS value,
                strftime("%Y-%m", created_at) AS labels
            ')
            ->groupBy('year', 'month', 'labels')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->limit(6)
            ->get();
    }

    /**
     * Get sparkline value.
     *
     * @param $sparkline
     *
     * @return array
     */
    private function getSparklineValue($sparkline)
    {
        $output = [];

        foreach ($sparkline->pluck('value') as $value) {
            $output[] = (int) $value;
        }

        return $output;
    }
}
