<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('created_by', auth()->id())->get();
        
        $orders = OrderResource::collection($orders);

        $response = generateResponse($orders, false, 'Order created successfully', null, 'object');
        
        return response()->json($response, 200); 
    }
    public function store(OrderStoreRequest $request)
    {
        try{
            DB::beginTransaction();

            $order = Order::create([
                'created_by' => auth()->id(),
                'location' => $request->location,
                'title' => $request->title,
                'size' => $request->size,
                'weight' => $request->weight,
                'pickup_time' => $request->pickup_time,
                'delivery_time' => $request->delivery_time,
                'status' => Order::STATUS_PENDING,
            ]);
            // Notify all admins
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }

            $order = new OrderResource($order);
            $response = generateResponse($order, false, 'Order created successfully', null, 'object');
            $code = 201;
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            $errorMsg = 'Error on line '.$e->getLine().' in '.$e->getFile()." ".$e->getMessage();
            $code = 500;
            $response = generateResponse(null, false, $errorMsg, null, 'object');
        }
        return response()->json($response, $code); 
    }
}
