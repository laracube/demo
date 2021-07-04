<?php

namespace App\Laracube\Resources\Product;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;
use function number_format;

class ProductBestSeller extends ResourceBigNumber
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
    public $columns = 8;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $number = Order::join('products', 'orders.product_id', 'products.id')
            ->where('is_refunded', 0)
            ->groupBy('products.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                products.name AS product_name,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ')
            ->first();

        $productName = $number->product_name;
        $netRevenue = '$'.number_format($number->net_revenue);

        return [
            'number' => "{$productName} <span class='text-h5'>with</span> {$netRevenue}",
        ];
    }
}
