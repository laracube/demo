<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Product\ProductAverageNetRevenue;
use App\Laracube\Resources\Product\ProductBestSeller;
use App\Laracube\Resources\Product\ProductPurchaseAndRefunds;
use App\Laracube\Resources\Product\ProductTotal;
use App\Laracube\Resources\Order\OrderNet;
use App\Laracube\Resources\Revenue\NetRevenue;
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
            (new ProductTotal()),
            (new NetRevenue()),
            (new OrderNet()),
            (new ProductAverageNetRevenue()),
            (new ProductBestSeller()),
            (new ProductPurchaseAndRefunds()),
        ];
    }
}
