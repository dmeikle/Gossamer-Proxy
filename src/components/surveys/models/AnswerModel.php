<?php


namespace components\surveys\models;

use core\AbstractModel;


/**
 * Description of SheetSelectionModel
 *
 * @author davem
 */
class AnswerModel extends AbstractModel{
    
    
    public function search() {
        return array('quesiton 1', 'question 2', 'question 3');
    }
}
