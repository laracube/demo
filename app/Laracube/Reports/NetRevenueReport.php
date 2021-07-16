<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Revenue\NetAverageRevenueByCustomer;
use App\Laracube\Resources\Revenue\NetAverageRevenueByOrder;
use App\Laracube\Resources\Revenue\NetAverageRevenueByProduct;
use App\Laracube\Resources\Revenue\NetOrder;
use App\Laracube\Resources\Revenue\NetRevenue;
use App\Laracube\Resources\Revenue\NetRevenueBellerSellerProduct;
use App\Laracube\Resources\Revenue\NetRevenueByCustomer;
use App\Laracube\Resources\Revenue\NetRevenueByProduct;
use App\Laracube\Resources\Revenue\NetRevenueHighestSpender;
use Laracube\Laracube\Base\Report;

class NetRevenueReport extends Report
{
    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'Net Revenue Report';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'Net Revenue Report';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'This reports shows the net revenue.';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    public function resources()
    {
        return [
            (new NetRevenue()),
            (new NetOrder()),
            (new NetAverageRevenueByOrder()),
            (new NetAverageRevenueByCustomer()),
            (new NetAverageRevenueByProduct()),
            (new NetRevenueHighestSpender()),
            (new NetRevenueByCustomer()),
            (new NetRevenueBellerSellerProduct()),
            (new NetRevenueByProduct()),
        ];
    }
}
