<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\Tire;

class MasterdataController extends Controller
{
    // ---------------- VEHICLE METHODS ----------------
    public function showVehicleData()
    {
        $vehicles = Vehicle::all();
        return view('masterdata.vehicledashboard', compact('vehicles'));
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|max:8',
            'model' => 'required',
            'brand' => 'required',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicledashboard')->with('success', 'Vehicle added successfully.');
    }

    public function destroyVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicledashboard')->with('success', 'Vehicle deleted successfully.');
    }

    public function editVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('masterdata.editvehicle', compact('vehicle'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'vehicle_number' => 'required|max:8',
            'model' => 'required',
            'brand' => 'required',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicledashboard')->with('success', 'Vehicle updated successfully.');
    }

    // ---------------- SUPPLIER METHODS ----------------
    public function showSupplierData()
    {
        $suppliers = Supplier::all();
        return view('masterdata.supplierdashboard', compact('suppliers'));
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'tire_size' => 'required|string|max:15',
            'brand' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:10',
            'email' => 'required|email|max:100',
            'comment' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplierdashboard')->with('success', 'Supplier added successfully.');
    }

    public function destroySupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplierdashboard')->with('success', 'Supplier deleted successfully.');
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('masterdata.editsupplier', compact('supplier'));
    }

    public function updateSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'tire_size' => 'required|string|max:15',
            'brand' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:10',
            'email' => 'required|email|max:100',
            'comment' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplierdashboard')->with('success', 'Supplier updated successfully.');
    }

    // ---------------- TIRE METHODS ----------------
    public function showTireDashboard()
    {
        $tires = Tire::with('supplier')->get(); // Include supplier relationship
        $sizes = Tire::distinct()->pluck('size');
        return view('masterdata.tiredashboard', compact('tires', 'sizes'));
    }

    public function storeTire(Request $request)
    {
        $request->validate([
            'size' => 'required|string',
            'brand' => 'required|string',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'price' => 'required|numeric',
            'warranty_distance' => 'required|string',
            'reference_no' => 'required|string',
            'date' => 'required|date',
        ]);

        Tire::create($request->all());

        return redirect()->route('tiredashboard')->with('success', 'Tire added successfully.');
    }

    public function getBrandsBySize(Request $request)
    {
        $brands = Tire::where('size', $request->size)->distinct()->pluck('brand');
        return response()->json($brands);
    }

    public function getSupplierBySizeBrand(Request $request)
    {
        $supplier = Tire::where('size', $request->size)
            ->where('brand', $request->brand)
            ->first()?->supplier;
        return response()->json($supplier);
    }
}