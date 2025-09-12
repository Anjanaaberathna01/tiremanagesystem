<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Tire;
use App\Models\Vehicle;

class MasterdataController extends Controller
{
    
    // Supplier List
    public function showSupplierData(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::when($search, function($query, $search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('id', $search);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('MasterData.supplierdashboard', compact('suppliers', 'search'));
    }

    // Add Supplier
    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tire_size' => 'required|string|max:15',
            'brand' => 'required',
            'address' => 'required',
            'country' => 'required',
            'phone_number' => 'required|integer|max:10',
            'email' => 'required|email',
            'comment' => 'nullable',
        ]);

        Supplier::create($request->all());
        return redirect()->route('supplierdashboard')->with('success', 'Supplier added successfully!');
    }

    // Delete Supplier
    public function destroySupplier($id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect()->route('supplierdashboard')->with('success', 'Supplier deleted successfully!');
    }



    // Tire Dashboard
    public function showTireDashboard()
    {
        $tires = Tire::with('supplier')->get();
        // For selects: get unique sizes and brands from suppliers
        $sizes = Supplier::select('tire_size')->distinct()->pluck('tire_size');
        return view('masterdata.tiredashboard', compact('tires', 'sizes'));
    }

    //  Get brands for a tire size
    public function getBrandsBySize(Request $request)
    {
        $brands = Supplier::where('tire_size', $request->size)
            ->pluck('brand')
            ->unique()
            ->values();
        return response()->json($brands);
    }

    //  Get supplier for size and brand
    public function getSupplierBySizeBrand(Request $request)
    {
        $supplier = Supplier::where('tire_size', $request->size)
            ->where('brand', $request->brand)
            ->first();
        return response()->json($supplier);
    }

    // Store Tire
    public function storeTire(Request $request)
    {
        $request->validate([
            'size' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'warranty_distance' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
            'reference_no' => 'required|integer',
            'date' => 'required|date',
           
            
        ]);

        Tire::create($request->all());
        return redirect()->route('tiredashboard')->with('success', 'Tire added successfully!');
    }



    // Vehicle Dashboardpublic function showVehicleData()
    public function showVehicleData()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->get();
        return view('masterdata.vehicledashboard', compact('vehicles'));
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|string|max:8',
            'model' => 'required',
            'brand' => 'required',
            'register_year' => 'required|integer|min:1900|max:' . date('Y'),
            'engine_number' => 'required|string|max:25',
            'chassis_number' => 'required|string|max:18',
            'branch' => 'required',
            'department' => 'required|string|max:255',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('vehicledashboard')->with('success', 'Vehicle added successfully!');
    }

    // Delete Vehicle
    public function destroyVehicle($id)
    {
        Vehicle::findOrFail($id)->delete();
        return redirect()->route('vehicledashboard')->with('success', 'Vehicle deleted successfully!');
    }


}