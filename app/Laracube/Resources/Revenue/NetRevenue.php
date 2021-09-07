<?php

namespace App\Laracube\Resources\Revenue;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class NetRevenue extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Net Revenue';

    /** {@inheritdoc} */
    public $subHeading = 'Net revenue (excludes refunds and fees)';

    /** {@inheritdoc} */
    public $columns = 6;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('SUM(total_amount) - SUM(fees) AS value')
            ->first();

        if (! $line1->value) {
            return $this->noRecordsFoundOutput();
        }

        $line2 = $this->getBaseQuery($request)
            ->where('created_at', '<', $this->getLastOrderDate($request)->subDays(30))
            ->selectRaw('SUM(total_amount) - SUM(fees) AS value')
            ->first();

        $trendValue = $this->getTrendValue($line1, $line2);

        $sparkline = $this->getBaseQuery($request)
            ->selectRaw('
                strftime("%Y", created_at) AS year,
                strftime("%m", created_at) AS month,
                (SUM(total_amount) - SUM(fees)) AS value
            ')
            ->groupBy('year', 'month')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->limit(6)
            ->get();

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
            [
                'type' => 'sparkline',
                'data' => $this->getSparkLineData($sparkline),
            ],
        ];
    }
}
