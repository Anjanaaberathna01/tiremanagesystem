<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">
  @include('layouts.header')

  <div class="flex flex-col flex-1 overflow-hidden md:flex-row">
    @include('layouts.side2')

    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]"
         style="background-image: url('{{ secure_asset('assets/images/tire13.png') }}');
                background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6">

        <!-- Title + Navigation Buttons -->
        <div class="flex flex-col justify-between mb-6 md:flex-row md:items-center">
          <h2 class="mb-4 text-xl font-extrabold text-blue-800 sm:text-2xl md:mb-0">Vehicle Dashboard</h2>
          <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <!-- Navigation Buttons -->
            <a href="{{ route('vehicledashboard') }}"
               class="px-6 py-2 text-white bg-blue-700 rounded-full shadow hover:bg-blue-800">Vehicle Details</a>
            <a href="{{ route('tiredashboard') }}"
               class="px-6 py-2 text-white bg-green-700 rounded-full shadow hover:bg-green-800">Tire Details</a>
          </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
          <div class="px-4 py-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
          </div>
        @endif

        <!-- Add Vehicle Form (Initially Hidden) -->
        <div id="vehicleForm" class="hidden p-4 mb-6 bg-gray-100 border border-gray-300 rounded-xl">
          <form method="POST" action="{{ route('vehicle.store') }}">
            @csrf
            <h3 class="mb-4 text-lg font-bold text-blue-900">Add Vehicle Details</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
              <input type="text" name="vehicle_no" placeholder="Vehicle No" class="w-full p-2 border rounded" required />
              <input type="text" name="vehicle_type" placeholder="Vehicle Type" class="w-full p-2 border rounded" required />
              <input type="text" name="owner_name" placeholder="Owner Name" class="w-full p-2 border rounded" />
              <input type="text" name="department" placeholder="Department" class="w-full p-2 border rounded" />
            </div>
            <div class="flex justify-end mt-4">
              <button type="submit" class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Submit</button>
            </div>
          </form>
        </div>

        <!-- Search + Table -->
        <div class="overflow-x-auto">
          <input id="vehicleSearchInput" onkeyup="filterTable('vehicleTable', 'vehicleSearchInput')"
                 placeholder="Search by any field..."
                 class="w-full mb-4 py-2 pl-4 pr-4 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>

          <table id="vehicleTable" class="min-w-full border border-gray-200">
            <thead>
              <tr class="text-left text-white bg-blue-800">
                <th class="px-4 py-2 border">Vehicle ID</th>
                <th class="px-4 py-2 border">Vehicle No</th>
                <th class="px-4 py-2 border">Vehicle Type</th>
                <th class="px-4 py-2 border">Branch</th>
                <th class="px-4 py-2 border">Department</th>
                <th class="px-4 py-2 border text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($vehicles as $vehicle)
                <tr class="text-gray-700">
                  <td class="px-4 py-2 border">{{ $vehicle->id }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->vehicle_number }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->model }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->branch }}</td>
                  <td class="px-4 py-2 border">{{ $vehicle->department }}</td>
                  <td class="px-4 py-2 border flex justify-center gap-3">
                    <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit Vehicle">
                      <i class="fas fa-edit" style="font-size:24px;"></i>
                    </a>
                    <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-800" title="Delete Vehicle">
                        <i class="fas fa-trash" style="font-size:24px;"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="py-4 text-center">No vehicles found.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <script>
    function toggleForm() {
      document.getElementById('vehicleForm').classList.toggle('hidden');
    }
  </script>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>
