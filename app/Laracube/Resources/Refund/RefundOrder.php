<?php

namespace App\Laracube\Resources\Refund;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class RefundOrder extends ResourceCard
{
    use RefundResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Total Order';

    /** {@inheritdoc} */
    public $subHeading = 'Total orders that was refunded';

    /** {@inheritdoc} */
    public $columns = 4;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->selectRaw('COUNT(id) AS value')
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
