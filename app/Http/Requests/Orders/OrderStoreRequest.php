<?php

namespace App\Http\Requests\Orders;
use App\Http\Requests\WebRequest;
use Illuminate\Support\Facades\Password;

class OrderStoreRequest extends WebRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'title' => 'required|string',
        'location' => 'required|string',
        'size' => 'required|string',
        'weight' => 'required|numeric',
        'pickup_time' => 'required|date',
        'delivery_time' => 'required|date|after:pickup_time',
      ];
    }

}
