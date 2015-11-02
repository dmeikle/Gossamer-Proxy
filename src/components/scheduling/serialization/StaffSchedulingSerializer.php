<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scheduling\serialization;

use core\serialization\Serializer;

/**
 * StaffSchedulingSerializer
 *
 * @author Dave Meikle
 */
class StaffSchedulingSerializer extends Serializer {

    public function formatSchedule(array $dateRange, array $schedule) {
        if (count($schedule) > 0) {
            $schedule = current($schedule);
        }
        $types = array();
        $daysInMonth = date("t", strtotime($dateRange['toDate']));

        $retval = $this->padCalendar($dateRange['toDate']);

        foreach ($schedule as $row) {
            //placeholder for checking num types during padding
            $types[$row['OnCallTypes_id']] = true;

            list($year, $month, $fromDay) = explode('-', $row['fromDate']);
            $date = \DateTime::createFromFormat("Y-m-d", $row['toDate']);
            $toDay = $date->format("d");

            for ($currentDay = $fromDay; $currentDay <= $toDay; $currentDay++) {
                $retval["$year-$month-" . intval($currentDay)][$row['OnCallTypes_id']][$row['Staff_id']] = $row['staffName'];
            }
        }


        return $retval;
    }

    private function padCalendar($toDate) {
        list($year, $month, $daysInMonth) = explode('-', $toDate);
        $retval = array();
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $retval["$year-$month-$i"] = array();
        }

        return $retval;
    }

    private function drawLengths(array $schedule) {
        $retval = array();
        $lastRow = array();
        $lastKey = '';
        foreach ($schedule as $key => $row) {
            if ($lastRow != $row) {
                $retval[$key] = $row;
                $retval[$key]['length'] = 1;
                $lastRow = $row;
                $lastKey = $key;
            } else {
                $retval[$lastKey]['length'] = $retval[$lastKey]['length'] + 1;
            }
        }

        return $retval;
    }

}
