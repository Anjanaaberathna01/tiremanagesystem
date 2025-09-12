<!-- filepath: resources/views/editprofile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="h-full w-full relative flex items-center justify-center px-4 py-8 bg-cover bg-center min-h-screen overflow-hidden" style="background-image: url('{{ asset('assets/images/background3.png') }}');">

  <div class="absolute top-6 left-6 flex flex-col items-start z-10">
    <a href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo2.png') }}" class="h-[80px]" alt="Logo" />
    </a>
  </div>
  <div class="absolute inset-0 backdrop-blur bg-black/30 z-0"></div>
  <div class="relative z-10 flex items-center justify-center min-h-screen ease-out forwards">
    <div class="bg-white bg-opacity-60 backdrop-blur-lg rounded-3xl shadow-xl p-10 w-full max-w-4xl fade-in">
      <div class="flex flex-col items-center text-center relative">
        <div class="relative">
          <img id="profileImagePreview"
            src="{{ $user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image) ? asset('storage/' . $user->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
            alt="Profile"
            class="w-28 h-28 rounded-full border-4 border-white shadow-lg object-cover"
          />
          <label for="imageInput" class="absolute bottom-0 right-0 bg-white rounded-full p-1 border shadow-md cursor-pointer">
            <i class="fas fa-pen text-blue-600 text-sm"></i>
          </label>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-900 mt-4">{{ $user->full_name }}</h2>
      </div>
      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 text-left px-4 md:px-16">
          <div>
            <label class="text-gray-500 font-semibold">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="w-full mt-1 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-400" required />
            @error('full_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="text-gray-500 font-semibold">Role</label>
            <input type="text" value="{{ $user->role }}" disabled class="w-full mt-1 px-4 py-2 rounded border bg-gray-200 text-gray-700 cursor-not-allowed" />
            <p class="text-sm text-red-600 mt-1">You can't edit</p>
          </div>
          <div>
            <label class="text-gray-500 font-semibold">Department</label>
            <input type="text" value="{{ $user->department }}" disabled class="w-full mt-1 px-4 py-2 rounded border bg-gray-200 text-gray-700 cursor-not-allowed" />
            <p class="text-sm text-red-600 mt-1">You can't edit</p>
          </div>
          <div>
            <label class="text-gray-500 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-400" required />
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="text-gray-500 font-semibold">Phone Number</label>
            <input type="tel" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full mt-1 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('phone_number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="text-gray-500 font-semibold">Address</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="w-full mt-1 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('address') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
          <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
          @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="flex justify-end mt-10 gap-4">
          <a href="{{ route('profile') }}" class="hover:bg-gray-100 text-black font-semibold py-2 px-6 rounded-full border border-black shadow-sm transition duration-300">
            Cancel
          </a>
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-full transition duration-300 shadow-md">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        document.getElementById('profileImagePreview').src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
    document.querySelector('label[for="imageInput"]').onclick = function() {
      document.getElementById('imageInput').click();
    }
  </script>
</body>
</html>