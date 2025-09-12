<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\Tire;
use App\Models\TireRequest;
use App\Models\User;
use App\Models\SectionApproval;
use Illuminate\Support\Facades\Mail;
use App\Mail\TireRequestNotification;

class TireRequestController extends Controller
{
    public function create()
    {
        $vehicles = Vehicle::all();
        $tires = Tire::all();
        return view('TireRequest.newrequest', compact('vehicles', 'tires'));
    }

    public function getVehicleDetails(Request $request)
    {
        $vehicle = Vehicle::where('vehicle_number', $request->vehicle_number)->first();
        return response()->json($vehicle);
    }

    public function getDepartmentUsers(Request $request)
    {
        $department = $request->department;
        $users = \App\Models\User::where('department', $department)
            ->whereIn('role', ['supervisor', 'manager'])
            ->get(['id', 'full_name', 'email', 'role']);
        return response()->json($users);
    }


    public function getTireBrands(Request $request)
    {
        $brands = \App\Models\Tire::where('size', $request->size)
            ->pluck('brand')
            ->unique()
            ->values();
        return response()->json($brands);
    }

    public function getTirePrices(Request $request)
    {
        $prices = \App\Models\Tire::where('size', $request->size)
            ->where('brand', $request->brand)
            ->pluck('price')
            ->unique()
            ->values();
        return response()->json($prices);
    }

    public function getTireDetails(Request $request)
    {
        $tire = \App\Models\Tire::where('size', $request->size)
            ->where('brand', $request->brand)
            ->where('price', $request->price)
            ->first();
        return response()->json($tire);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|exists:vehicles,vehicle_number',
            'user_section' => 'required',
            'delivery_place_office' => 'required',
            'delivery_place_town' => 'required',
            'last_replacement_date' => 'required|date',
            'existing_tire_make' => 'required',
            'tire_size_required' => 'required',
            'tire_brand_required' => 'required',
            'number_of_tires' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'warranty' => 'required|integer',
            'cost_center' => 'required',
            'present_km_reading' => 'required|integer',
            'previous_km_reading' => 'required|integer',
            'tire_wear_pattern' => 'nullable|string',
            'comment' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find vehicle and tire
        $vehicle = Vehicle::where('vehicle_number', $request->vehicle_number)->first();
        $tire = Tire::where('size', $request->tire_size_required)
            ->where('brand', $request->tire_brand_required)
            ->first();

         $year = date('Y');
        $monthLetter = chr(64 + intval(date('n'))); // 1=A, 2=B, ..., 12=L
        $day = date('d');
        $rand = rand(1, 9);
        $request_code = 'P' . $year . $monthLetter . $day . $rand;

        // Ensure uniqueness
        while (\App\Models\TireRequest::where('request_code', $request_code)->exists()) {
            $rand = rand(1, 9);
            $request_code = 'P' . $year . $monthLetter . $day . $rand;
        }

        // Handle images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imagePaths[] = $img->store('tire_requests', 'public');
            }
        }

        TireRequest::create([
            'user_id' => Auth::id(),
            'request_code' => $request_code,
            'vehicle_id' => $vehicle->id,
            'tire_id' => $tire ? $tire->id : null,
            'user_section' => $request->user_section,
            'delivery_place_office' => $request->delivery_place_office,
            'delivery_place_town' => $request->delivery_place_town,
            'last_replacement_date' => $request->last_replacement_date,
            'existing_tire_make' => $request->existing_tire_make,
            'tire_size_required' => $request->tire_size_required,
            'tire_brand_required' => $request->tire_brand_required,
            'number_of_tires' => $request->number_of_tires,
            'total_price' => $request->total_price,
            'warranty' => $request->warranty,
            'cost_center' => $request->cost_center,
            'present_km_reading' => $request->present_km_reading,
            'previous_km_reading' => $request->previous_km_reading,
            'tire_wear_pattern' => $request->tire_wear_pattern ?? null,
            'comment' => $request->comment ?? null,
            'images' => json_encode($imagePaths),
        ]);

        // Send email to selected user_section
        $user = \App\Models\User::find($request->user_section);
        if ($user && $user->email) {
            Mail::to($user->email)->send(new TireRequestNotification(Auth::user(), $user));
        }

        return redirect()->route('tirerequest.new')->with('success', 'Tire request submitted!');


    }
    public function viewMyRequests()
    {
        $requests = \App\Models\TireRequest::with(['vehicle'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('TireRequest.viewrequest', compact('requests'));
    }


   // Approval list page
    public function approvalPage()
    {
        $user = Auth::user();
        $requests = \App\Models\TireRequest::with(['vehicle', 'user', 'sectionApproval'])
            ->whereHas('vehicle', function($q) use ($user) {
                $q->where('department', $user->department);
            })
            ->whereNull('section_approval_status') // Only pending requests
            ->orderByDesc('created_at')
            ->get();

        return view('TireRequest.approval', compact('requests'));
    }

    // Approval view page
    public function approvalView($id)
    {
        $request = TireRequest::with(['vehicle', 'user', 'sectionApproval'])->findOrFail($id);
        return view('TireRequest.approvalview', compact('request'));
    }

    // Handle approval/reject
    public function sectionApprove(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'supervisor_comments' => 'nullable|string',
            'officer_services_number' => 'nullable|string',
        ]);

        $tireRequest = TireRequest::findOrFail($id);

        // Create or update section approval
        SectionApproval::updateOrCreate(
            ['request_id' => $id],
            [
                'user_id' => Auth::id(),
                'status' => $request->status,
                'supervisor_comments' => $request->supervisor_comments,
                'officer_services_number' => $request->officer_services_number,
                'updated_at' => now(),
            ]
        );

        // Update main request status
        if ($request->status === 'approved') {
            $tireRequest->section_approval_status = 'approved';
        } else {
            $tireRequest->section_approval_status = 'rejected';
        }
        $tireRequest->save();

        
        return redirect()->route('tirerequest.approval')->with('success', 'Request ' . ucfirst($request->status) . ' successfully!');
    }


    // pre-approval list page
    public function preApprovalList()
    {
        $requests = \App\Models\TireRequest::with(['vehicle', 'user'])
            ->whereIn('section_approval_status', ['approved', 'rejected'])
            ->orderByDesc('created_at')
            ->get();

        return view('TireRequest.preapproval', compact('requests'));
    }
}