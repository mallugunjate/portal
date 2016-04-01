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
            if($response['validation_result'] == 'false'){
                return $response;    
            }
            
        }   


        if (! array_key_exists("allStores", $data) || (array_key_exists("allStores", $data) && $data["allStores"] == NULL)) {
            if (array_key_exists('target_stores', $data)) {
                $storeValidatorResult = $this->validateTargetStores($data['target_stores']);
                \Log::info('^^^^^^^^');
                \Log::info($storeValidatorResult);
                \Log::info('^^^^^^^^');
                if($storeValidatorResult['validation_result'] == 'false') {
                    return $storeValidatorResult;        
                }
                return  ['validation_result' => 'true'] ;
            
            }
            
        }

        
    }

    private function validateTargetStores($target_stores)
    {
        $storeRule = [ 
            'store' => 'regex: /\"(A-Z)\d{4}\"/' 
        ];

        foreach ($target_stores as $store) {

            $validateThis = ['store' => $store];
            $sv = \Validator::make($validateThis, $storeRule);
            if ($sv->fails())
            {
                $response =  ['validation_result' => 'false', 'errors' => $sv->errors()];
                return $response;
            }

        }
        return ;
    }

    public function errors()
    {
        return $this->errors;
    }
}
