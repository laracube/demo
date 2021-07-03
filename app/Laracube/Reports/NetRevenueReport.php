<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\AverageNetRevenueByOrder;
use App\Laracube\Resources\NetRevenue;
use App\Laracube\Resources\NonRefundedOrders;
use App\Laracube\Resources\PurchaseAndRefundsByCustomer;
use App\Laracube\Resources\PurchaseAndRefundsByProduct;
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
            (new NetRevenue())->setColumns(4),
            (new NonRefundedOrders())->setColumns(4),
            (new AverageNetRevenueByOrder())->setColumns(4),
            (new PurchaseAndRefundsByCustomer())->setColumns(12),
            (new PurchaseAndRefundsByProduct())->setColumns(12),
        ];
    }
}
