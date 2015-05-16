<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scheduling\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\scheduling\form\CalendarBuilder;
use components\scheduling\serialization\CalendarSerializer;
use Gossamer\CMS\Forms\FormBuilder;
use components\scheduling\serialization\StaffSchedulingSerializer;

class SchedulesController extends AbstractController
{
    public function calendar($year, $month) {
        $dateRange = $this->formatDates($year, $month);
    
        $results = $this->model->getSchedule($dateRange);
        
        $this->render(array('calendar' => $this->drawCalendar($dateRange, $results), 'schedule' => $this->drawSchedule($dateRange, $results)));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        
        $builder = new FormBuilder($this->logger, $model);
        $calendarBuilder = new CalendarBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
             
//        $departments = $this->httpRequest->getAttribute('Departments');
//        $serializer = new DepartmentSerializer();        
//        $selectedOptions = array($staffBuilder->getValue('Departments_id', $values));
//        $options['departments'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($departments), $selectedOptions);
        
        
        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }
    
    private function drawSchedule(array $dateRange, array $schedule) {
        $scheduleSerializer = new StaffSchedulingSerializer();
               
        return  $scheduleSerializer->formatSchedule($dateRange, $schedule);
    }

    private function drawCalendar(array $dateRange, array $schedule) {
        
        $calendarSerializer = new CalendarSerializer();
                
        return array(
            'rearPadding' => $calendarSerializer->getRearPadding($dateRange), 
            'frontPadding' => $calendarSerializer->getFrontPadding($dateRange),
            'currentMonth' => $calendarSerializer->formatDateRange($dateRange),
            'months' => $calendarSerializer->getMonths(),
            'month' => $calendarSerializer->getCurrentMonth($dateRange)
            );
    }
    
    private function formatDates($year, $month) {
        $fromDate = date_create("$year-$month-1");
        //set it to this month for now
        $toDate = date('Y-m-t');
        
        if(!$fromDate) {
            $from = date("Y-m-01");
            $to = date("Y-m-t");
        } else {
            $from = date_format($fromDate, "Y-m-01");
            $to = date_format($fromDate, "Y-m-t");
        }
        
        return array('fromDate' => $from, 'toDate' => $to);       
    }
}
