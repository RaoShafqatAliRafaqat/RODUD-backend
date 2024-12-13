<?php

namespace App\Http\Requests\Orders;
use App\Http\Requests\WebRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Password;

class UpdateOrderRequest extends WebRequest
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
        'status' => 'required|in:' . implode(',', [Order::STATUS_PENDING, Order::STATUS_IN_PROGRESS, Order::STATUS_DELIVERED]),
      ];
    }

}
