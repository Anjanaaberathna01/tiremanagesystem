<!-- filepath: resources/views/MasterData/vehicledashboard.blade.php -->
<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

   <!-- Header -->
    @include('layouts.header')

  <!-- Main Layout -->
  <div class="flex flex-col flex-1 overflow-hidden md:flex-row">
    <!-- Sidebar -->
    @include('layouts.side2')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]" style="background-image: url('{{ secure_asset('assets/images/tire13.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6">

        <!-- Title, Search & Add Button -->
        <div class="flex flex-col justify-between mb-6 md:flex-row md:items-center">
          <h2 class="mb-4 text-xl font-extrabold text-blue-800 sm:text-2xl md:mb-0">Vehicle Details</h2>
          <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <div class="relative w-full sm:w-80">
              <input type="text" id="vehicleSearchInput" onkeyup="filterTable('vehicleTable', 'vehicleSearchInput')" placeholder="Search by any field..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 6.65a7.5 7.5 0 010 10.6z" />
                </svg>
              </div>
            </div>
            <button onclick="toggleForm()" class="px-10 py-2 text-sm text-white bg-green-700 rounded-full shadow hover:bg-green-800 sm:text-base">
              + Add Vehicle
            </button>
          </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
          <div class="px-4 py-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
          </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
          <div class="px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
            <ul class="pl-5 list-disc">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Vehicle Form (Initially Hidden) -->
        <div id="tireForm" class="hidden p-4 mb-6 bg-gray-100 border border-gray-300 rounded-xl">
          <form method="POST" action="{{ route('vehicle.store') }}">
            @csrf
            <h3 class="mb-4 text-lg font-bold text-blue-900 ">Add Vehicle Details</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
              <input type="text" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Vehicle Number" class="w-full p-2 border rounded" required maxlength="8" />
              <input type="text" name="model" value="{{ old('model') }}" placeholder="Vehicle Model" class="w-full p-2 border rounded" required />
              <input type="text" name="brand" value="{{ old('brand') }}" placeholder="Vehicle Brand" class="w-full p-2 border rounded" required />
              <input type="number" name="register_year" value="{{ old('register_year') }}" placeholder="Register Year" class="w-full p-2 border rounded" min="1900" max="{{ date('Y') }}" />
              <input type="text" name="engine_number" value="{{ old('engine_number') }}" placeholder="Engine Number" class="w-full p-2 border rounded" maxlength="25" />
              <input type="text" name="chassis_number" value="{{ old('chassis_number') }}" placeholder="Chassis Number" class="w-full p-2 border rounded" maxlength="18" />
              <input type="text" name="branch" value="{{ old('branch') }}" placeholder="Branch" class="w-full p-2 border rounded" required />
              <input type="text" name="department" value="{{ old('department') }}" placeholder="Department" class="w-full p-2 border rounded" />
            </div>
            <div class="flex justify-end mt-4">
              <button type="submit" class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Submit</button>
            </div>
          </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table id="vehicleTable" class="min-w-full border border-gray-200">
            <thead>
              <tr class="text-left text-white bg-blue-800">
                <th class="px-4 py-2 border">Vehicle Number</th>
                <th class="px-4 py-2 border">Vehicle Model</th>
                <th class="px-4 py-2 border">Vehicle Brand</th>
                <th class="px-4 py-2 border">Register Year</th>
                <th class="px-4 py-2 border">Engine Number</th>
                <th class="px-4 py-2 border">Chassis Number</th>
                <th class="px-4 py-2 border">Branch</th>
                <th class="px-4 py-2 border">Department</th>
                <th class="px-4 py-2 border">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($vehicles as $vehicle)
                <tr class="text-gray-700">
                  <td class="px-4 py-2 border">{{ $vehicle->vehicle_number }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->model }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->brand }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->register_year }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->engine_number }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->chassis_number }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->branch }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->department }}</td>
                  <td class="px-4 py-2 border">
                    <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="px-2 py-1 text-sm text-white bg-red-600 rounded">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="py-4 text-center">No vehicles found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>


  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>