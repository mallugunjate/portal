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

        $response = ['validation_result' => 'true'] ;

        if ($v->fails())
        {
            $this->errors = $v->errors();
            $response =  ['validation_result' => 'false', 'errors' => $v->errors()];
        }

        return $response;
    }

    public function errors()
    {
        return $this->errors;
    }
}
