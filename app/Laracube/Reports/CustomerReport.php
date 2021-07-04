<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Customer\CustomerAverageNetRevenue;
use App\Laracube\Resources\Customer\CustomerHighestSpender;
use App\Laracube\Resources\Customer\CustomerPaying;
use App\Laracube\Resources\Customer\CustomerPurchaseAndRefunds;
use App\Laracube\Resources\Revenue\NetOrders;
use App\Laracube\Resources\Revenue\NetRevenue;
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
            (new CustomerPaying()),
            (new NetRevenue()),
            (new NetOrders()),
            (new CustomerAverageNetRevenue()),
            (new CustomerHighestSpender()),
            (new CustomerPurchaseAndRefunds()),
        ];
    }
}
