

<!-- filepath: resources/views/Order/create.blade.php -->
<x-app-layout>
<body class="flex items-center justify-center min-h-screen py-10 bg-gradient-to-br from-blue-50 to-blue-200">
  <div class="w-full max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('transport.afterapproval') }}"
         class="inline-flex items-center px-5 py-2 font-semibold text-blue-700 transition-all bg-white border border-blue-200 rounded-lg shadow hover:bg-blue-100">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Approved Requests
      </a>
    </div>
    <div class="flex flex-col overflow-hidden bg-white shadow-xl rounded-3xl md:flex-row">
      <!-- Left: Main Content -->
      <div class="flex-1 p-8 md:p-12">
        <h2 class="mb-8 text-3xl font-bold tracking-tight text-blue-900">Place Tire Order</h2>
        <!-- User Info -->
        <div class="flex items-center gap-4 mb-6">
          <img
            src="{{ $tireRequest->user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($tireRequest->user->image) ? asset('storage/' . $tireRequest->user->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
            alt="Profile"
            class="object-cover border-2 border-blue-400 rounded-full shadow w-14 h-14"
          />
          <div>
            <div class="text-lg font-semibold text-blue-900">{{ $tireRequest->user->full_name }}</div>
            <div class="text-sm text-gray-500">{{ $tireRequest->user->email }}</div>
          </div>
        </div>
        <!-- Request Details -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
          <div>
            <div class="text-xs text-gray-500">Request Code</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->request_code }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Vehicle No</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->vehicle->vehicle_number }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Driver Phone</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->user->phone_number ?? '-' }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Request Date</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->created_at ? $tireRequest->created_at->format('Y-m-d') : '-' }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Tire Size</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->tire_size_required }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Tire Brand</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->tire_brand_required }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">No. of Tires</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->number_of_tires }}</div>
          </div>
          <div>
            <div class="text-xs text-gray-500">Tire Wear Pattern</div>
            <div class="font-semibold text-blue-800">{{ $tireRequest->tire_wear_pattern ?? '-' }}</div>
          </div>
        </div>
        <!-- Supplier Form -->
        <form method="POST" action="{{ route('order.store', $tireRequest->id) }}" class="mt-8">
          @csrf
          <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">Select Supplier</label>
            <select name="supplier_id" id="supplierSelect" class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
              <option value="">Select Supplier</option>
              @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}"
                  data-email="{{ $supplier->email }}"
                  data-phone="{{ $supplier->phone_number }}"
                >
                  {{ $supplier->name }} ({{ $supplier->brand }}, {{ $supplier->tire_size }})
                </option>
              @endforeach
            </select>
            <!-- Supplier Info -->
            <div id="supplierInfo" class="hidden p-4 mt-4 border border-blue-200 rounded-lg bg-blue-50">
              <div class="mb-2 text-sm font-semibold text-blue-900">Supplier Contact</div>
              <div class="text-xs text-gray-500">Email:</div>
              <div id="supplierEmail" class="mb-2 font-semibold text-blue-800"></div>
              <div class="text-xs text-gray-500">Phone:</div>
              <div id="supplierPhone" class="font-semibold text-blue-800"></div>
            </div>
          </div>
          <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 font-bold text-white transition-all rounded-lg shadow bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-800 hover:to-blue-600">
              Place Order
            </button>
          </div>
        </form>
      </div>
      <!-- Right: Sticky Summary Card -->
      <div class="sticky flex flex-col justify-between flex-shrink-0 w-full p-6 border-l border-blue-100 md:w-80 bg-blue-50 top-10">
        <div>
          <h3 class="mb-4 text-lg font-bold text-blue-700">Order Summary</h3>
          <ul class="space-y-2 text-sm text-blue-900">
            <li><span class="font-semibold">Vehicle:</span> {{ $tireRequest->vehicle->vehicle_number }}</li>
            <li><span class="font-semibold">Tire Size:</span> {{ $tireRequest->tire_size_required }}</li>
            <li><span class="font-semibold">Brand:</span> {{ $tireRequest->tire_brand_required }}</li>
            <li><span class="font-semibold">Qty:</span> {{ $tireRequest->number_of_tires }}</li>
            <li><span class="font-semibold">Requested:</span> {{ $tireRequest->created_at ? $tireRequest->created_at->format('Y-m-d') : '-' }}</li>
          </ul>
        </div>
        <div class="mt-8">
          <img src="{{ asset('assets/images/tire9.jpeg') }}" alt="Tire" class="object-cover w-full shadow rounded-xl h-28">
        </div>
      </div>
    </div>
  </div>
  <script>
    // Show supplier info when selected
    document.addEventListener('DOMContentLoaded', function () {
      const select = document.getElementById('supplierSelect');
      const info = document.getElementById('supplierInfo');
      const email = document.getElementById('supplierEmail');
      const phone = document.getElementById('supplierPhone');
      select.addEventListener('change', function () {
        const option = select.options[select.selectedIndex];
        if (option.value) {
          email.textContent = option.getAttribute('data-email') || '-';
          phone.textContent = option.getAttribute('data-phone') || '-';
          info.classList.remove('hidden');
        } else {
          info.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</x-app-layout>