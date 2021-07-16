<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Refund\RefundAverageOrder;
use App\Laracube\Resources\Refund\RefundOrder;
use App\Laracube\Resources\Refund\RefundByCustomer;
use App\Laracube\Resources\Refund\RefundByProduct;
use App\Laracube\Resources\Refund\RefundTotal;
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
            (new RefundTotal()),
            (new RefundOrder()),
            (new RefundAverageOrder()),
            (new RefundByCustomer()),
            (new RefundByProduct()),
        ];
    }
}
