<!-- filepath: resources/views/Transport/evaluation.blade.php -->
<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

  <!-- Header -->
  @include('layouts.header')
   
  <div class="flex flex-col flex-1 overflow-hidden sm:flex-row">

    <!-- Sidebar -->
    @include('layouts.side4')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]">

      <a href="{{ route('transport.evaluation') }}" class="flex items-center px-4 py-2 mb-4 space-x-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-max">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span>Back</span>
      </a>

      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6 sm:px-16">
        <h2 class="mt-2 mb-6 text-xl font-extrabold text-blue-800 sm:text-2xl">Tire Request Approval</h2>

        @if(session('success'))
          <div class="px-4 py-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
            {{ $errors->first() }}
          </div>
        @endif

        <form class="space-y-4" method="POST" action="{{ route('transport.evaluation.submit', $request->id) }}">
          @csrf
          <div class="grid grid-cols-1 gap-4">

            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Number</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->vehicle->vehicle_number ?? '' }}" readonly />
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Brand</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->vehicle->brand ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Department</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->vehicle->department ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Model</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->vehicle->model ?? '' }}" readonly />
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">User Section</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->user_section ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Delivery place - Name of the office</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->delivery_place_office ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Delivery place - Town</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->delivery_place_town ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Last Tire Replacement Date</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->last_replacement_date ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Make of Existing Tire</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->existing_tire_make ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Size Required</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->tire_size_required ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Brand Required</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->tire_brand_required ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Total Price</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->total_price ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Warranty Distance</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->warranty ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">No. of Tires Required</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->number_of_tires ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Cost Centre</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->cost_center ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Present km Reading</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->present_km_reading ?? '' }}" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Km at previous tire replacement</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->previous_km_reading ?? '' }}" readonly />
            </div>
            <!-- Tire Wear Pattern -->
            <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-4">
              <label class="mb-2 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Wear Pattern</label>
              <input type="text" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" value="{{ $request->tire_wear_pattern ?? '' }}" readonly />
            </div>
            <!-- Comments -->
            <div class="flex flex-col space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0">
              <label class="mt-1 text-sm font-medium md:w-1/3">Comments</label>
              <textarea class="flex-1 px-4 py-2 bg-gray-200 border rounded-lg" rows="3" readonly>{{ $request->comment ?? '' }}</textarea>
            </div>

             <!-- Mechanic Radio Fields -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Warranty Status</label>
              <div class="flex flex-1 px-4 py-2 space-x-6 bg-gray-200 rounded-full">
                <label class="flex items-center text-sm">
                  <input type="radio" name="warranty_state" value="yes" class="mr-2" {{ old('warranty_state') == 'yes' ? 'checked' : '' }} required /> Yes
                </label>
                <label class="flex items-center text-sm">
                  <input type="radio" name="warranty_state" value="no" class="mr-2" {{ old('warranty_state') == 'no' ? 'checked' : '' }} /> No
                </label>
              </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Incorrect Alignment</label>
              <div class="flex flex-1 px-4 py-2 space-x-6 bg-gray-200 rounded-full">
                <label class="flex items-center text-sm">
                  <input type="radio" name="incorrect_alignment" value="yes" class="mr-2" {{ old('incorrect_alignment') == 'yes' ? 'checked' : '' }} required /> Yes
                </label>
                <label class="flex items-center text-sm">
                  <input type="radio" name="incorrect_alignment" value="no" class="mr-2" {{ old('incorrect_alignment') == 'no' ? 'checked' : '' }} /> No
                </label>
              </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Detective Steering System</label>
              <div class="flex flex-1 px-4 py-2 space-x-6 bg-gray-200 rounded-full">
                <label class="flex items-center text-sm">
                  <input type="radio" name="detective_steering_system" value="yes" class="mr-2" {{ old('detective_steering_system') == 'yes' ? 'checked' : '' }} required /> Yes
                </label>
                <label class="flex items-center text-sm">
                  <input type="radio" name="detective_steering_system" value="no" class="mr-2" {{ old('detective_steering_system') == 'no' ? 'checked' : '' }} /> No
                </label>
              </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Detective Suspension</label>
              <div class="flex flex-1 px-4 py-2 space-x-6 bg-gray-200 rounded-full">
                <label class="flex items-center text-sm">
                  <input type="radio" name="detective_suspension" value="yes" class="mr-2" {{ old('detective_suspension') == 'yes' ? 'checked' : '' }} required /> Yes
                </label>
                <label class="flex items-center text-sm">
                  <input type="radio" name="detective_suspension" value="no" class="mr-2" {{ old('detective_suspension') == 'no' ? 'checked' : '' }} /> No
                </label>
              </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Purchase Tires</label>
              <div class="flex flex-1 px-4 py-2 space-x-6 bg-gray-200 rounded-full">
                <label class="flex items-center text-sm">
                  <input type="radio" name="purchase_tires" value="yes" class="mr-2" {{ old('purchase_tires') == 'yes' ? 'checked' : '' }} required /> Yes
                </label>
                <label class="flex items-center text-sm">
                  <input type="radio" name="purchase_tires" value="no" class="mr-2" {{ old('purchase_tires') == 'no' ? 'checked' : '' }} /> No
                </label>
              </div>
            </div>

            <div class="flex flex-col space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0">
              <label class="mt-1 text-sm font-medium md:w-1/3">Mechanic Comments</label>
              <textarea name="mechanic_comments" class="flex-1 px-4 py-2 bg-gray-200 border rounded-lg" rows="3">{{ old('mechanic_comments') }}</textarea>
            </div>
            <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-x-4 md:space-y-0">
              <label class="text-sm font-medium md:w-1/3">Mechanic Officer Service No</label>
              <input type="text" name="mechanic_officer_services_number" class="flex-1 px-4 py-2 bg-gray-200 border rounded-full" value="{{ old('mechanic_officer_services_number') }}" />
            </div>
          
            <!-- Uploaded Images with Lightbox -->
            @if($request->images)
              <div class="flex flex-col space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0">
                <label class="mt-1 text-sm font-medium md:w-1/3">Uploaded Images</label>
                <div class="grid flex-1 grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-6">
                  @foreach(json_decode($request->images, true) as $img)
                    <div class="flex items-center justify-center p-1 bg-gray-100 border rounded-lg">
                      <img src="{{ asset('storage/' . $img) }}" class="object-cover w-20 h-20 transition rounded cursor-pointer hover:scale-105"
                           alt="Tire Image"
                           onclick="showImageModal('{{ asset('storage/' . $img) }}')">
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <div class="flex justify-end pt-6 space-x-4">
            <button type="submit" name="approval_status" value="approved"
              class="px-6 py-2 font-semibold text-white bg-green-600 rounded-full hover:bg-green-700">
              Approval
            </button>
            <button type="submit" name="approval_status" value="rejected"
              class="px-6 py-2 font-semibold text-white bg-red-500 rounded-full hover:bg-red-700">
              Reject
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Modal for Image Preview -->
  <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70">
    <span class="absolute text-3xl text-white cursor-pointer top-6 right-8" onclick="closeImageModal()">&times;</span>
    <img id="modalImage" src="" class="max-h-[80vh] max-w-[90vw] rounded-lg shadow-2xl border-4 border-white" alt="Preview">
  </div>

  <script>
    function showImageModal(src) {
      document.getElementById('modalImage').src = src;
      document.getElementById('imageModal').classList.remove('hidden');
    }
    function closeImageModal() {
      document.getElementById('imageModal').classList.add('hidden');
      document.getElementById('modalImage').src = '';
    }
    document.getElementById('imageModal').addEventListener('click', function(e) {
      if (e.target === this) closeImageModal();
    });
  </script>

  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>