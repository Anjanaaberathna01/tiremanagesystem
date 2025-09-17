<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">
  @include('layouts.header')
  <div class="flex flex-col flex-1 overflow-hidden md:flex-row">
    @include('layouts.side2')

    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]"
         style="background-image: url('{{ secure_asset('assets/images/tire13.png') }}'); background-size: cover;">
      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6">
        <h2 class="mb-6 text-xl font-extrabold text-blue-800 sm:text-2xl">Edit Supplier</h2>

        <form method="POST" action="{{ route('supplier.update', $supplier->id) }}">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            <input type="text" name="name" value="{{ old('name', $supplier->name) }}" class="w-full p-2 border rounded" required />
            <input type="text" name="tire_size" value="{{ old('tire_size', $supplier->tire_size) }}" class="w-full p-2 border rounded" required maxlength="15" />
            <input type="text" name="brand" value="{{ old('brand', $supplier->brand) }}" class="w-full p-2 border rounded" required />
            <input type="text" name="address" value="{{ old('address', $supplier->address) }}" class="w-full p-2 border rounded" />
            <input type="text" name="country" value="{{ old('country', $supplier->country) }}" class="w-full p-2 border rounded" required />
            <input type="text" name="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}" class="w-full p-2 border rounded" required maxlength="10" />
            <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="w-full p-2 border rounded" required />
            <input type="text" name="comment" value="{{ old('comment', $supplier->comment) }}" class="p-2 border rounded" />
          </div>

          <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('supplierdashboard') }}" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">Cancel</a>
            <button type="submit" class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</x-app-layout>
