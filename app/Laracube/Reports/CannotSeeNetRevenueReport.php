<?php

namespace App\Laracube\Reports;

use App\Laracube\Filters\CannotSeeCustomerFilter;
use App\Laracube\Filters\CustomerFilter;
use App\Laracube\Filters\ProductFilter;
use App\Laracube\Resources\Revenue\CannotSeeNetAverageRevenueByOrder;
use App\Laracube\Resources\Revenue\NetAverageRevenueByOrder;
use Laracube\Laracube\Base\Report;

class CannotSeeNetRevenueReport extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'Cannot See, Net Revenue Report';

    /** {@inheritdoc} */
    public static $heading = 'Cannot See, Net Revenue Report';

    /** {@inheritdoc} */
    public static $subHeading = 'Cannot See, This reports shows the net revenue.';

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

    /** {@inheritdoc} */
    public function resources()
    {
        return [
            (new NetAverageRevenueByOrder()),
            (new CannotSeeNetAverageRevenueByOrder()),
        ];
    }

    /** {@inheritdoc} */
    public function filters()
    {
        return [
            (new CustomerFilter()),
            (new ProductFilter()),
            (new CannotSeeCustomerFilter()),
        ];
    }
}
