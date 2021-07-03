<?php

namespace App\Laracube\Reports;

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
            // Total products
            // Active Products (has a sale in the last 12 months)
            // Best Seller
            // Revenue and Refunds by Product simple table
        ];
    }
}
