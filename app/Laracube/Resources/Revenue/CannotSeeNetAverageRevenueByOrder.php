<?php

namespace App\Laracube\Resources\Revenue;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class CannotSeeNetAverageRevenueByOrder extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Cannot See, Average Net Revenue/Order';

    /** {@inheritdoc} */
    public $subHeading = 'Cannot See, Average net revenue per order';

    /** {@inheritdoc} */
    public $columns = 4;

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(id) AS value')
            ->first();

        if (! $line1->value) {
            return $this->noRecordsFoundOutput();
        }

        $line2 = $this->getBaseQuery($request)
            ->where('created_at', '<', $this->getLastOrderDate($request)->subDays(30))
            ->selectRaw('(SUM(total_amount)-SUM(fees))/COUNT(id) AS value')
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
