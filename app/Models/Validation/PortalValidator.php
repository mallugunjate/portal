<?php

namespace App\Models\Validation;


use Illuminate\Database\Eloquent\Model;

class PortalValidator extends Model
{
    protected $rules = array();

    protected $messages = array();

    protected $errors;

    public function validate($data)
    {
        $v = \Validator::make($data, $this->rules, $this->messages);

        if ($v->fails())
        {
            
            $this->errors = $v->errors();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
