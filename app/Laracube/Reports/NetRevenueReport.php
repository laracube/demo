<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Order\OrderAverageNetRevenue;
use App\Laracube\Resources\Order\OrderNet;
use App\Laracube\Resources\Revenue\NetRevenue;
use App\Laracube\Resources\Revenue\NetRevenueByCustomer;
use App\Laracube\Resources\Revenue\NetRevenueByProduct;
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
            (new OrderNet()),
            (new OrderAverageNetRevenue()),
            (new NetRevenueByCustomer()),
            (new NetRevenueByProduct()),
        ];
    }
}
