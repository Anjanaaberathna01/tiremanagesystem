<?php
namespace App\Http\Controllers;

use App\Models\TireOrder;
use App\Models\TireRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TireArrivedNotification;

class TireOrderController extends Controller
{
    // Show order form
    public function create($request_id)
    {
        $tireRequest = TireRequest::with(['vehicle', 'user'])->findOrFail($request_id);
        $suppliers = Supplier::where('tire_size', $tireRequest->tire_size_required)
            ->where('brand', $tireRequest->tire_brand_required)
            ->get();
        return view('Order.create', compact('tireRequest', 'suppliers'));
    }

    // Store order
    public function store(Request $request, $request_id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $order = TireOrder::create([
            'tire_request_id' => $request_id,
            'supplier_id' => $request->supplier_id,
            'order_status' => 'ordered',
            'ordered_at' => now(),
        ]);

        // Remove from afterapproval by not showing ordered requests
        return redirect()->route('order.list')->with('success', 'Order placed successfully!');
    }

    // List all orders
    public function index()
    {
        $orders = TireOrder::with(['request.vehicle', 'request.user', 'supplier'])->orderByDesc('created_at')->get();
        return view('Order.index', compact('orders'));
    }

    // Mark as arrived and notify user
    public function markArrived($order_id)
    {
        $order = TireOrder::with('request.user')->findOrFail($order_id);
        $order->order_status = 'arrived';
        $order->arrived_at = now();
        $order->save();

        // Send email to user
        Mail::to($order->request->user->email)->send(new TireArrivedNotification($order));

        return redirect()->route('order.list')->with('success', 'Order marked as arrived and user notified!');
    }
}