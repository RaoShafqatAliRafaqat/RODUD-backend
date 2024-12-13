<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        // Paginate orders
        $orders = Order::with('createdBy')->paginate(10); // Paginate the orders (10 per page)

        // Optionally, use a resource collection to transform the data
        $ordersData = new OrderCollection($orders);

        $authUser = auth()->user();

        // Pass the paginated data to the view
        return view('admin.orders.index', compact('ordersData', 'authUser'));
    }
    public function updateStatus(UpdateOrderRequest $request, Order $order)
    {

        try {
            DB::beginTransaction();

            $order->status = $request->status;
            $order->updated_by = auth()->id();
            $order->save();

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            $errorMsg = 'Error on line ' . $e->getLine() . ' in ' . $e->getFile() . " " . $e->getMessage();
            return back()->with('error', $errorMsg);
        }
    }
}
