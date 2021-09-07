<?php

namespace App\Laracube\Resources\Refund;

use App\Models\Order;
use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class RefundAverageOrder extends ResourceCard
{
    use RefundResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Average Refund';

    /** {@inheritdoc} */
    public $subHeading = 'Average refund per order';

    /** {@inheritdoc} */
    public $columns = 4;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('SUM(total_amount)/COUNT(id) AS value')
            ->first();

        if (! $line1->value) {
            return $this->noRecordsFoundOutput();
        }

        return [
            [
                'type' => 'bigNumber',
                'data' => [
                    'line1' => [
                        'value' => '$'.number_format($line1->value),
                    ],
                ],
            ],
        ];
    }
}
