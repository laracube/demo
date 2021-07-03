<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\BestSellerProduct;
use App\Laracube\Resources\PurchaseAndRefundsByProduct;
use App\Laracube\Resources\TotalProducts;
use Laracube\Laracube\Base\Report;

class ProductReport extends Report
{
    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'Product Report';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'Product Report';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'This reports shows the stats for products.';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    public function resources()
    {
        return [
            (new TotalProducts())->setColumns(4),
            (new BestSellerProduct())->setColumns(8),
            (new PurchaseAndRefundsByProduct())->setColumns(12),
        ];
    }
}
