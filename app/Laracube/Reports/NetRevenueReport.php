<?php

namespace App\Laracube\Reports;

use App\Laracube\Filters\CannotSeeCustomerFilter;
use App\Laracube\Filters\CustomerFilter;
use App\Laracube\Filters\ProductFilter;
use App\Laracube\Resources\Revenue\CannotSeeNetAverageRevenueByOrder;
use App\Laracube\Resources\Revenue\NetAverageRevenueByCustomer;
use App\Laracube\Resources\Revenue\NetAverageRevenueByOrder;
use App\Laracube\Resources\Revenue\NetAverageRevenueByProduct;
use App\Laracube\Resources\Revenue\NetOrder;
use App\Laracube\Resources\Revenue\NetRevenue;
use App\Laracube\Resources\Revenue\NetRevenueBestSellerProduct;
use App\Laracube\Resources\Revenue\NetRevenueByCustomer;
use App\Laracube\Resources\Revenue\NetRevenueByProduct;
use App\Laracube\Resources\Revenue\NetRevenueHighestSpender;
use Laracube\Laracube\Base\Report;

class NetRevenueReport extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'Net Revenue Report';

    /** {@inheritdoc} */
    public static $heading = 'Net Revenue Report';

    /** {@inheritdoc} */
    public static $subHeading = 'This reports shows the net revenue.';

    /** {@inheritdoc} */
    public function resources()
    {
        return [
            (new NetAverageRevenueByOrder()),
            (new CannotSeeNetAverageRevenueByOrder()),
            (new NetAverageRevenueByCustomer()),
            (new NetAverageRevenueByProduct()),
            (new NetRevenue()),
            (new NetOrder()),
            (new NetRevenueHighestSpender()),
            (new NetRevenueBestSellerProduct()),
            (new NetRevenueByProduct()),
            (new NetRevenueByCustomer()),
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
