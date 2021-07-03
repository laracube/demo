<?php

namespace App\Laracube\Reports;

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
            // Refund
            // Orders
            // Average Refund per order
            // Refund Table
        ];
    }
}
