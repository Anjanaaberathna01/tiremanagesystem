<!-- filepath: resources/views/MasterData/editvehicle.blade.php -->
<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

   <!-- Header -->
   @include('layouts.header')

   <!-- Main Layout -->
   <div class="flex flex-col flex-1 overflow-hidden md:flex-row">
      <!-- Sidebar -->
      @include('layouts.side2')

      <!-- Main Content -->
      <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]"
           style="background-image: url('{{ secure_asset('assets/images/tire13.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
         <div class="bg-white rounded-[30px] shadow p-4 sm:p-6">

            <!-- Title -->
            <h2 class="mb-6 text-xl font-extrabold text-blue-800 sm:text-2xl">Edit Vehicle Details</h2>

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

            <!-- Edit Vehicle Form -->
            <form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}">
               @csrf
               @method('PUT')

               <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                  <input type="text" name="vehicle_number" value="{{ old('vehicle_number', $vehicle->vehicle_number) }}" placeholder="Vehicle Number" class="w-full p-2 border rounded" required maxlength="8" />
                  <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" placeholder="Vehicle Model" class="w-full p-2 border rounded" required />
                  <input type="text" name="brand" value="{{ old('brand', $vehicle->brand) }}" placeholder="Vehicle Brand" class="w-full p-2 border rounded" required />
                  <input type="number" name="register_year" value="{{ old('register_year', $vehicle->register_year) }}" placeholder="Register Year" class="w-full p-2 border rounded" min="1900" max="{{ date('Y') }}" />
                  <input type="text" name="engine_number" value="{{ old('engine_number', $vehicle->engine_number) }}" placeholder="Engine Number" class="w-full p-2 border rounded" maxlength="25" />
                  <input type="text" name="chassis_number" value="{{ old('chassis_number', $vehicle->chassis_number) }}" placeholder="Chassis Number" class="w-full p-2 border rounded" maxlength="18" />
                  <input type="text" name="branch" value="{{ old('branch', $vehicle->branch) }}" placeholder="Branch" class="w-full p-2 border rounded" required />
                  <input type="text" name="department" value="{{ old('department', $vehicle->department) }}" placeholder="Department" class="w-full p-2 border rounded" />
               </div>

               <div class="flex justify-end mt-6 gap-3">
                  <a href="{{ route('vehicledashboard') }}"
                     class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">
                     Cancel
                  </a>
                  <button type="submit" class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">
                     Update
                  </button>
               </div>
            </form>

         </div>
      </div>
   </div>

   <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>
