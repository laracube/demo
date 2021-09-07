<?php

namespace App\Laracube\Resources\Refund;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class RefundTotal extends ResourceCard
{
    use RefundResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Total Refund';

    /** {@inheritdoc} */
    public $subHeading = 'Total amount that was refunded';

    /** {@inheritdoc} */
    public $columns = 4;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('SUM(total_amount) AS value')
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
