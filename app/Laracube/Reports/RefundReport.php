<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\Refund\RefundAverageOrder;
use App\Laracube\Resources\Refund\RefundByCustomer;
use App\Laracube\Resources\Refund\RefundByProduct;
use App\Laracube\Resources\Refund\RefundOrder;
use App\Laracube\Resources\Refund\RefundTotal;
use Laracube\Laracube\Base\Report;

class RefundReport extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'Refund Report';

    /** {@inheritdoc} */
    public static $heading = 'Refund Report';

    /** {@inheritdoc} */
    public static $subHeading = 'This reports shows the Refunds.';

    /** {@inheritdoc} */
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

    /** {@inheritdoc} */
    public function filters()
    {
        return [];
    }
}
