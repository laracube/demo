<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\AverageRefundByOrder;
use App\Laracube\Resources\TotalRefundAmount;
use App\Laracube\Resources\TotalRefundOrder;
use Laracube\Laracube\Base\Report;

class RefundReport extends Report
{
    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'Refund Report';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'Refund Report';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'This reports shows the Refunds.';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    public function resources()
    {
        return [
            (new TotalRefundAmount())->setColumns(4),
            (new TotalRefundOrder())->setColumns(4),
            (new AverageRefundByOrder())->setColumns(4),
            // Refund Table
        ];
    }
}
