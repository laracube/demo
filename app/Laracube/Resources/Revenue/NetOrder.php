<?php

namespace App\Laracube\Resources\Revenue;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class NetOrder extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Net Orders';

    /** {@inheritdoc} */
    public $subHeading = 'Net Orders (excludes refunds)';

    /** {@inheritdoc} */
    public $columns = 6;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('COUNT(id) AS value')
            ->first();

        if (! $line1->value) {
            return $this->noRecordsFoundOutput();
        }

        $line2 = $this->getBaseQuery($request)
            ->where('created_at', '<', $this->getLastOrderDate($request)->subDays(30))
            ->selectRaw('COUNT(id) AS value')
            ->first();

        $trendValue = $this->getTrendValue($line1, $line2);

        $sparkline = $this->getBaseQuery($request)
            ->selectRaw('
                strftime("%Y", created_at) AS year,
                strftime("%m", created_at) AS month,
                (COUNT(id)) AS value
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
                        'value' => number_format($line1->value),
                    ],
                    'line2' => [
                        'value' => 'from '.number_format($line2->value),
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
