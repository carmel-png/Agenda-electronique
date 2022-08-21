<?php
namespace Calendar;

use App\Validator;

class EventValidator extends Validator{
    public function validates(array $data){
    parent::validates($data);
    $this->validate('name', 'minLength', 5);
    $this->validate('date', 'date');
    $this->validate('start', 'beforeTime', 'end');
    return $this->errors;
    }
}