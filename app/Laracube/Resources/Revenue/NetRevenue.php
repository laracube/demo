<?php

namespace App\Laracube\Resources\Revenue;

use App\Models\Order;
use Laracube\Laracube\Base\ResourceBigNumber;

class NetRevenue extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Net Revenue';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Net revenue (excludes refunds and fees)';

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 6;

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $line1 = $this->getLine1();

        $line2 = $this->getLine2();

        $trendValue = round((($line1->value - $line2->value) / $line2->value) * 100, 2);

        $sparkline = $this->getSparkLine();

        return [
            'line1' => [
                'value' => '$'.number_format($line1->value),
            ],
            'line2' => [
                'value' => 'from $'.number_format($line2->value),
            ],
            'trend' => [
                'value' => $trendValue.'%',
                'icon' => $trendValue > 0 ? 'fa-arrow-up' : 'fa-arrow-down',
                'class' => $trendValue > 0 ? 'green lighten-5' : 'red lighten-5',
            ],
            'sparkline' => [
                'autoDraw' => true,
                'autoDrawDuration' => 2000,
                'autoDrawEasing' => 'ease',
                'autoLineWidth' => false,
                'color' => 'text--secondary',
                'fill' => false,
                'gradient' => ['#9B0000', '#FF0000', '#FFB3B3'],
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
            ],
        ];
    }

    /**
     * Get line 1.
     *
     * @return mixed
     */
    private function getLine1()
    {
        return Order::where('is_refunded', 0)
            ->selectRaw('SUM(total_amount) - SUM(fees) AS value')
            ->first();
    }

    /**
     * Get line 2.
     *
     * @return mixed
     */
    private function getLine2()
    {
        $lastOrderDate = Order::where('is_refunded', 0)
            ->orderBy('created_at', 'DESC')
            ->first()
            ->created_at;

        return Order::where('is_refunded', 0)
            ->where('created_at', '<', $lastOrderDate->subDays(30))
            ->selectRaw('SUM(total_amount) - SUM(fees) AS value')
            ->first();
    }

    /**
     * Get Sparkline.
     *
     * @return mixed
     */
    private function getSparkLine()
    {
        return Order::where('is_refunded', 0)
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
}
