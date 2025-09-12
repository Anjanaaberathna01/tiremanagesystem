<!-- filepath: resources/views/MasterData/supplierdashboard.blade.php -->
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
          <h2 class="mb-4 text-xl font-extrabold text-blue-800 sm:text-2xl md:mb-0">Supplier Details</h2>
          <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <div class="relative w-full sm:w-80">
              <input id="supplierSearchInput" onkeyup="filterTable('supplierTable', 'supplierSearchInput')" placeholder="Search by any field..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 6.65a7.5 7.5 0 010 10.6z" />
                </svg>
              </div>
            </div>
            <button onclick="toggleForm()" type="button" class="px-10 py-2 text-sm text-white bg-green-700 rounded-full shadow hover:bg-green-800 sm:text-base">
              + Add Supplier
            </button>
          </div>
        </div>
        @if(session('success'))
          <div class="px-4 py-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
          </div>
        @endif

        <!-- Supplier Form (Initially Hidden) -->
        <div id="tireForm" class="hidden p-4 mb-6 bg-gray-100 border border-gray-300 rounded-xl">
          <form method="POST" action="{{ route('supplier.store') }}">
            @csrf
            <h3 class="mb-4 text-lg font-bold text-blue-900 ">Add Supplier Details</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
              <input type="text" name="name" placeholder="Supplier Name" class="w-full p-2 border rounded" required />
              <input type="text" name="tire_size" placeholder="Tire Size" class="w-full p-2 border rounded" required maxlength="15" />
              <input type="text" name="brand" placeholder="Brand" class="w-full p-2 border rounded" required />
              <input type="text" name="address" placeholder="Address" class="w-full p-2 border rounded" />
              <input type="text" name="country" placeholder="Country" class="w-full p-2 border rounded" required />
              <input type="text" name="phone_number" placeholder="Phone No" class="w-full p-2 border rounded" required maxlength="10" />
              <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required />
              <input type="text" name="comment" placeholder="Comment" class="p-2 border rounded" />
            </div>
            <div class="flex justify-end mt-4">
              <button type="submit" class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Submit</button>
            </div>
          </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table id="supplierTable" class="min-w-full border border-gray-200">
            <thead>
              <tr class="text-left text-white bg-blue-800">
                <th class="px-4 py-2 border">Supplier ID</th>
                <th class="px-4 py-2 border">Supplier Name </th>
                <th class="px-4 py-2 border">Tire Size</th>
                <th class="px-4 py-2 border">Brand </th>
                <th class="px-4 py-2 border">Address</th> 
                <th class="px-4 py-2 border">Country</th>
                <th class="px-4 py-2 border">Phone No</th>   
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Comment</th>
                <th class="px-4 py-2 border">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($suppliers as $supplier)
                <tr class="text-gray-700">
                  <td class="px-4 py-2 border">{{ $supplier->id }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->name }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->tire_size }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->brand }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->address }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->country }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->phone_number }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->email }}</td>
                  <td class="px-4 py-2 border">{{ $supplier->comment }}</td>
                  <td class="px-4 py-2 border">
                    <form method="POST" action="{{ route('supplier.destroy', $supplier->id) }}" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                    </form>
                    <a href="" class="px-2 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="10" class="py-4 text-center">No suppliers found.</td>
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