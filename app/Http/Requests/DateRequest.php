<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(){
            if (strlen($this->bday_month) < 2) {
                $this->bday_month = 0 . $this->bday_month;
            }
            if (strlen($this->bday_day) < 2) {
                $this->bday_day = 0 . $this->bday_day;
            }

            $birthday = $this->bday_year . '-' . $this->bday_month . '-' . $this->bday_day;
            $this->merge(compact('birthday'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
