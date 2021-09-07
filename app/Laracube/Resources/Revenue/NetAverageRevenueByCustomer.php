<?php

namespace App\Laracube\Resources\Revenue;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class NetAverageRevenueByCustomer extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Average Net Revenue/Customer';

    /** {@inheritdoc} */
    public $subHeading = 'Average net revenue per customer';

    /** {@inheritdoc} */
    public $columns = 4;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(DISTINCT user_id) AS value')
            ->first();

        if (! $line1->value) {
            return $this->noRecordsFoundOutput();
        }

        $line2 = $this->getBaseQuery($request)
            ->where('created_at', '<', $this->getLastOrderDate($request)->subDays(30))
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(DISTINCT user_id) AS value')
            ->first();

        $trendValue = $this->getTrendValue($line1, $line2);

        return [
            [
                'type' => 'bigNumber',
                'data' => [
                    'line1' => [
                        'value' => '$'.number_format($line1->value),
                    ],
                    'line2' => [
                        'value' => 'from $'.number_format($line2->value),
                    ],
                    'trend' => $this->getTrendData($trendValue),
                ],
            ],
        ];
    }
}
