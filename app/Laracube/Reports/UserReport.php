<?php

namespace App\Laracube\Reports;

use App\Laracube\Resources\UserTable;
use Laracube\Laracube\Base\Report;

class UserReport extends Report
{
    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'User Report';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'User Report';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'This report shows all the users';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    public function resources()
    {
        return [
            (new UserTable())->setColumns(12),
        ];
    }
}
