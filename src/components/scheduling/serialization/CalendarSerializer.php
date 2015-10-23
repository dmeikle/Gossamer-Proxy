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
 * CalendarSerializer
 *
 * @author Dave Meikle
 */
class CalendarSerializer extends Serializer {

    public function formatDateRange(array $dateRange) {

        list($year, $month, $fromDay) = explode('-', $dateRange['fromDate']);

        $date = \DateTime::createFromFormat("Y-m-d", $dateRange['toDate']);
        $toDay = $date->format("d");

        $retval = array();
        for ($i = intval($fromDay); $i <= $toDay; $i++) {
            $key = $year . '-' . $month . '-' . $i;
            $retval[$key] = $i;
        }

        return $retval;
    }

    public function getRearPadding(array $dateRange) {

        $date = strtotime($dateRange['toDate']);
        $day = 1;
        $lastDateOfWeek = date("w", $date);

        $retval = array();
        for ($i = $lastDateOfWeek + 1; $i < 7; $i++) {
            $retval[$i] = $day++;
        }

        return $retval;
    }

    public function getFrontPadding(array $dateRange) {

        $date = strtotime($dateRange['fromDate']);
        $lastMonthDay = date('d', strtotime('last day of previous month'));
        $firstDateOfWeek = date("w", $date);

        $retval = array();
        for ($i = $firstDateOfWeek; $i > -1; $i--) {
            $retval[] = $lastMonthDay - $i;
        }

        array_shift($retval);

        return $retval;
    }

    public function getMonths() {
        return array(
            1 => 'MONTH_JANUARY',
            2 => 'MONTH_FEBRUARY',
            3 => 'MONTH_MARCH',
            4 => 'MONTH_APRIL',
            5 => 'MONTH_MAY',
            6 => 'MONTH_JUNE',
            7 => 'MONTH_JULY',
            8 => 'MONTH_AUGUST',
            9 => 'MONTH_SEPTEMBER',
            10 => 'MONTH_OCTOBER',
            11 => 'MONTH_NOVEMBER',
            12 => 'MONTH_DECEMBER'
        );
    }

    public function getCurrentMonth(array $dateRange) {
        list($year, $month, $fromDay) = explode('-', $dateRange['fromDate']);

        return intval($month);
    }

}
