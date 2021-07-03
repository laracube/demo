<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\AverageNetRevenueByCustomer;
use App\Laracube\Resources\NetRevenue;
use App\Laracube\Resources\PayingCustomer;
use App\Laracube\Resources\PurchaseAndRefundsByCustomer;
use Laracube\Laracube\Base\Report;

class CustomerReport extends Report
{
    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'Customer Report';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'Customer Report';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'This reports shows the customer purchases and refunds';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    public function resources()
    {
        return [
            (new NetRevenue())->setColumns(4),
            (new PayingCustomer())->setColumns(4),
            (new AverageNetRevenueByCustomer())->setColumns(4),
            (new PurchaseAndRefundsByCustomer())->setColumns(12),
        ];
    }
}
