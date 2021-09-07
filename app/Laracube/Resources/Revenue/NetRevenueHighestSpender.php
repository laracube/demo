<?php

namespace App\Laracube\Resources\Revenue;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;

class NetRevenueHighestSpender extends ResourceCard
{
    use RevenueResourceHelperTrait;

    /** {@inheritdoc} */
    public $heading = 'Highest Spender';

    /** {@inheritdoc} */
    public $subHeading = 'Customer with the most net revenue';

    /** {@inheritdoc} */
    public $columns = 12;

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $line1 = $this->getBaseQuery($request)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('net_revenue', 'DESC')
            ->selectRaw('
                users.name AS name,
                SUM(orders.total_amount) AS gross_revenue,
                SUM(orders.fees) AS total_fees,
                SUM(orders.total_amount) - SUM(orders.fees) AS net_revenue
            ')
            ->first();

        if (! $line1) {
            return $this->noRecordsFoundOutput();
        }

        $name = $line1->name;

        $netRevenue = '$'.number_format($line1->net_revenue);

        return [
            [
                'type' => 'customHtml',
                'data' => [
                    'value' => "<div class=' text-h3 grey--text text--darken-3 font-weight-medium line1'>{$name} <span class='text-h5'>with</span> {$netRevenue}</div>",
                ],
            ],
        ];
    }
}
