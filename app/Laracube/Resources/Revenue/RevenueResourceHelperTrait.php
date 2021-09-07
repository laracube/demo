<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Illuminate\Http\Request;

trait RevenueResourceHelperTrait
{
    /**
     * Get base query.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    private function getBaseQuery(Request $request)
    {
        return clone Order::where('is_refunded', 0)
            ->when($request->get('customer_id'), function ($query, $filter) {
                return $query->where('orders.user_id', $filter);
            })
            ->when($request->get('product_ids'), function ($query, $filter) {
                return $query->whereIn('orders.product_id', $filter);
            });
    }

    /**
     * Get last order date.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Carbon
     */
    private function getLastOrderDate(Request $request)
    {
        $lastOrder = $this->getBaseQuery($request)
            ->orderBy('orders.created_at', 'DESC')
            ->first();

        return $lastOrder ? $lastOrder->created_at : now();
    }

    /**
     * Get trend value.
     *
     * @param $line1
     * @param $line2
     *
     * @return float|int
     */
    private function getTrendValue($line1, $line2)
    {
        $trendValue = 0;

        if ($line2->value > 0) {
            $trendValue = round((($line1->value - $line2->value) / $line2->value) * 100, 2);
        }

        return $trendValue;
    }

    /**
     * Get sparkline value.
     *
     * @param $sparkline
     *
     * @return array
     */
    private function getSparklineValue($sparkline)
    {
        $output = [];

        foreach ($sparkline->pluck('value') as $value) {
            $output[] = (int) $value;
        }

        return $output;
    }

    /**
     * Get trend data.
     *
     * @param $trendValue
     *
     * @return array
     */
    private function getTrendData($trendValue)
    {
        return [
            'value' => $trendValue.'%',
            'cssClass' => $trendValue > 0 ? 'green--text text--darken-3' : 'red--text text--darken-3',
            'icon' => [
                'value' => $trendValue > 0 ? 'fa-arrow-up' : 'fa-arrow-down',
                'cssClass' => $trendValue > 0
                    ? 'green lighten-5 rounded-circle px-4 py-2'
                    : 'red lighten-5 rounded-circle px-4 py-2',
            ],
        ];
    }

    /**
     * Get sparkline data.
     *
     * @param $sparkline
     * @param false $fill
     *
     * @return array
     */
    private function getSparkLineData($sparkline, bool $fill = false)
    {
        return [
            'autoDraw' => true,
            'autoDrawDuration' => 2000,
            'autoDrawEasing' => 'ease',
            'autoLineWidth' => false,
            'color' => 'grey--text text--darken-1',
            'fill' => $fill,
            'gradient' => ['#163AFC', '#6079FF', '#B4BFFF'],
            'gradientDirection' => 'top',
            'height' => 75,
            'labelSize' => 7,
            'labels' => $sparkline->pluck('value'),
            'lineWidth' => 3,
            'padding' => 15,
            'showLabels' => false,
            'smooth' => 10,
            'type' => 'trend',
            'value' => $this->getSparklineValue($sparkline),
            'width' => 300,
            'title' => 'Last 6 months',
        ];
    }

    /**
     * No records found output.
     *
     * @return array[]
     */
    private function noRecordsFoundOutput()
    {
        return [
            [
                'type' => 'customHtml',
                'data' => [
                    'value' => 'No records found',
                ],
            ],
        ];
    }
}
