<!-- filepath: resources/views/TireRequest/newrequest.blade.php -->
<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

  @include('layouts.header')
  <div class="flex flex-col flex-1 overflow-hidden sm:flex-row">
    @include('layouts.side1')
    <main class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]">
      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6 sm:px-16">
        <h2 class="mt-2 mb-6 text-xl font-extrabold text-blue-800 sm:text-2xl">New Tire Requests</h2>

        @if(session('success'))
          <div class="px-4 py-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
            <ul class="pl-5 list-disc">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="space-y-4" method="POST" action="{{ route('tirerequest.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="grid grid-cols-1 gap-4">

            <!-- Vehicle Number Dropdown -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Number</label>
              <select name="vehicle_number" id="vehicle_number" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required>
                <option value="">Select Vehicle Number</option>
                @foreach($vehicles as $vehicle)
                  <option value="{{ $vehicle->vehicle_number }}">{{ $vehicle->vehicle_number }}</option>
                @endforeach
              </select>
            </div>

            <!-- Auto-filled Vehicle Details -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Model</label>
              <input type="text" id="vehicle_model" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Brand</label>
              <input type="text" id="vehicle_brand" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Branch</label>
              <input type="text" id="vehicle_branch" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" readonly />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Vehicle Section</label>
              <input type="text" id="vehicle_section" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" readonly />
            </div>

            <!-- User Section (Supervisor/Manager in Department) -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">User Section</label>
              <select name="user_section" id="user_section" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required>
                <option value="">Select User</option>
              </select>
            </div>

            <!-- Delivery Place -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Delivery place - Name of the office</label>
              <input type="text" name="delivery_place_office" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Delivery place - Town</label>
              <input type="text" name="delivery_place_town" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Last Tire Replacement Date -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Last Tire Replacement Date</label>
              <input type="date" name="last_replacement_date" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Existing Tire Make -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Make of Existing Tire</label>
              <input type="text" name="existing_tire_make" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Tire Size Dropdown -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Size Required</label>
              <select name="tire_size_required" id="tire_size_required" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required>
                <option value="">Select Tire Size</option>
                @foreach($tires->unique('size') as $tire)
                  <option value="{{ $tire->size }}">{{ $tire->size }}</option>
                @endforeach
              </select>
            </div>

            <!-- Tire Brand Dropdown -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Brand Required</label>
              <select name="tire_brand_required" id="tire_brand_required" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required>
                <option value="">Select Tire Brand</option>
              </select>
            </div>

            <!-- Total Price Dropdown -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Total Price</label>
              <select name="total_price" id="total_price" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required>
                <option value="">Select Total Price</option>
              </select>
            </div>

            <!-- Warranty Distance (auto-filled) -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Warranty Distance</label>
              <input type="text" name="warranty" id="warranty" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" readonly required />
            </div>

            <!-- Number of Tires -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">No. of Tires Required</label>
              <input type="number" name="number_of_tires" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" min="1" required />
            </div>

            <!-- Cost Centre -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Cost Centre</label>
              <input type="text" name="cost_center" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Present km Reading -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Present km Reading</label>
              <input type="number" name="present_km_reading" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Km at previous tire replacement -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
              <label class="mb-1 text-sm font-medium sm:w-1/3 sm:mb-0">Km at previous tire replacement</label>
              <input type="number" name="previous_km_reading" class="flex-1 px-4 py-2 bg-gray-200 rounded-full" required />
            </div>

            <!-- Tire Wear Pattern -->
            <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-4">
              <label class="mb-2 text-sm font-medium sm:w-1/3 sm:mb-0">Tire Wear Pattern</label>
              <div class="grid flex-1 grid-cols-1 gap-2 px-4 py-2 bg-gray-200 sm:grid-cols-3 rounded-2xl">
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="one_edge" class="mr-2" /> One edge</label>
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="middle" class="mr-2" /> Middle</label>
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="both_edges" class="mr-2" /> Both edges</label>
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="middle_crack" class="mr-2" />  Middle Crack</label>
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="sidewall_crack" class="mr-2" /> Sidewall Crack</label>
                <label class="flex items-center text-sm"><input type="radio" name="tire_wear_pattern" value="normal_wear" class="mr-2" /> Normal Wear</label>
              </div>
            </div>

            <!--Comments-->
            <div class="flex flex-col space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0">
                <label class="mt-1 text-sm font-medium md:w-1/3">Comments</label>
                <textarea name="comment" class="flex-1 px-4 py-2 bg-gray-200 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" rows="3"></textarea>
            </div>

            <!-- Upload 6 Images -->
            <div class="flex flex-col space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0">
              <label class="mt-1 text-sm font-medium md:w-1/3">Upload 6 Images</label>
              <div class="flex-1">
                <div class="p-6 text-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50"
                  onclick="document.getElementById('imageInput').click()">
                  Drag and drop or click here
                </div>
                <input id="imageInput" name="images[]" type="file" accept="image/*" multiple class="hidden" onchange="handleImageUpload(event)" />
                <div id="imagePreview" class="grid grid-cols-6 gap-2 mt-4"></div>
              </div>
            </div>
          </div>

          <div class="flex justify-end pt-6 space-x-4">
            <button type="submit"
              class="px-6 py-2 font-semibold text-white bg-green-600 rounded-full hover:bg-green-700">
              Send Request
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <script>
    // Vehicle auto-fill and department users
    document.getElementById('vehicle_number').addEventListener('change', function() {
      fetch("{{ route('tirerequest.vehicle-details') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ vehicle_number: this.value })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById('vehicle_model').value = data.model || '';
        document.getElementById('vehicle_brand').value = data.brand || '';
        document.getElementById('vehicle_branch').value = data.branch || '';
        document.getElementById('vehicle_section').value = data.department || '';
        // Fetch department users
        fetch("{{ route('tirerequest.department-users') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ department: data.department })
        })
        .then(res => res.json())
        .then(users => {
          let userSelect = document.getElementById('user_section');
          userSelect.innerHTML = '<option value="">Select User</option>';
          users.forEach(user => {
            userSelect.innerHTML += `<option value="${user.id}">${user.full_name} (${user.role})</option>`;
          });
        });
      });
    });

    // Tire brand dropdown
    document.getElementById('tire_size_required').addEventListener('change', function() {
      fetch("{{ route('tirerequest.tire-brands') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ size: this.value })
      })
      .then(res => res.json())
      .then(brands => {
        let brandSelect = document.getElementById('tire_brand_required');
        brandSelect.innerHTML = '<option value="">Select Tire Brand</option>';
        brands.forEach(brand => {
          brandSelect.innerHTML += `<option value="${brand}">${brand}</option>`;
        });
        document.getElementById('total_price').innerHTML = '<option value="">Select Total Price</option>';
        document.getElementById('warranty').value = '';
      });
    });

    // Tire price dropdown
    document.getElementById('tire_brand_required').addEventListener('change', function() {
      let size = document.getElementById('tire_size_required').value;
      fetch("{{ route('tirerequest.tire-prices') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ size: size, brand: this.value })
      })
      .then(res => res.json())
      .then(prices => {
        let priceSelect = document.getElementById('total_price');
        priceSelect.innerHTML = '<option value="">Select Total Price</option>';
        prices.forEach(price => {
          priceSelect.innerHTML += `<option value="${price}">${price}</option>`;
        });
        document.getElementById('warranty').value = '';
      });
    });

    // Tire details auto-fill
    document.getElementById('total_price').addEventListener('change', function() {
      let size = document.getElementById('tire_size_required').value;
      let brand = document.getElementById('tire_brand_required').value;
      fetch("{{ route('tirerequest.tire-details') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ size: size, brand: brand, price: this.value })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById('warranty').value = data.warranty_distance || '';
      });
    });

    // Image upload preview and remove (unchanged)
    let images = [];
    function handleImageUpload(event) {
      const files = Array.from(event.target.files);
      if (images.length + files.length > 6) {
        alert('You can upload up to 6 images only.');
        return;
      }
      files.forEach(file => {
        if (images.length < 6) {
          images.push(file);
        }
      });
      renderImagePreview();
      // Update the input files
      const dataTransfer = new DataTransfer();
      images.forEach(img => dataTransfer.items.add(img));
      event.target.files = dataTransfer.files;
    }

    function renderImagePreview() {
      const preview = document.getElementById('imagePreview');
      preview.innerHTML = '';
      images.forEach((img, idx) => {
        const url = URL.createObjectURL(img);
        preview.innerHTML += `
          <div class="relative group">
            <img src="${url}" class="object-cover w-20 h-20 border rounded" />
            <button type="button" onclick="removeImage(${idx})"
              class="absolute top-0 right-0 bg-red-600 text-white rounded-full px-1 py-0.5 text-xs opacity-80 hover:opacity-100">×</button>
          </div>
        `;
      });
      // Fill empty slots
      for (let i = images.length; i < 6; i++) {
        preview.innerHTML += `<div class="p-4 text-xs text-center text-gray-600 bg-gray-100 border rounded-lg">Image ${i+1}</div>`;
      }
    }

    function removeImage(idx) {
      images.splice(idx, 1);
      renderImagePreview();
      // Update the input files
      const input = document.getElementById('imageInput');
      const dataTransfer = new DataTransfer();
      images.forEach(img => dataTransfer.items.add(img));
      input.files = dataTransfer.files;
    }
  </script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>