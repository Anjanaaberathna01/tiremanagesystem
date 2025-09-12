<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body class="relative flex items-center justify-center w-full h-full min-h-screen px-4 py-8 overflow-hidden bg-center bg-cover" style="background-image: url('{{ asset('assets/images/background3.png') }}');">

  <!-- Top-left logo -->
  <div class="absolute z-10 flex flex-col items-start top-6 left-6">
    <a href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo2.png') }}" class="h-[80px]" alt="Logo" />
    </a>
  </div>

  <!-- Top-right back button -->
  <div class="absolute z-10 top-6 right-6">
    <button
      onclick="try{ window.history.back(); }catch(e){ window.location.href='{{ url('/') }}'; }"
      title="Back"
      class="flex items-center gap-2 bg-white/90 hover:bg-white text-gray-800 px-4 py-2 rounded-full shadow-lg border border-gray-200 transition transform hover:-translate-y-0.5"
    >
      <i class="fas fa-arrow-left"></i>
      <span class="hidden font-medium sm:inline">Back</span>
    </button>
  </div>

  <div class="absolute inset-0 z-0 backdrop-blur bg-black/30"></div>

  <div class="relative z-10 flex items-center justify-center min-h-screen ease-out forwards">
    <div class="w-full max-w-4xl p-10 bg-white shadow-xl bg-opacity-60 backdrop-blur-lg rounded-3xl fade-in">
      <div class="flex flex-col items-center text-center" x-data="{ showModal: false }">
        <!-- Profile Image with click-to-zoom -->
        <img
          src="{{ $user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image) ? asset('storage/' . $user->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
          alt="Profile"
          class="object-cover transition-transform border-4 border-white rounded-full shadow-lg cursor-pointer w-28 h-28 hover:scale-105"
          @click="showModal = true"
        />
        <h2 class="mt-4 text-2xl font-extrabold text-gray-900">{{ $user->full_name }}</h2>

        <!-- Modal for big image -->
        <div
          x-show="showModal"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black bg-opacity-80"
          style="display: none;"
        >
          <div class="relative">
            <img
              src="{{ $user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image) ? asset('storage/' . $user->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
              alt="Profile Large"
              class="w-[350px] h-[350px] md:w-[450px] md:h-[450px] rounded-2xl object-cover border-4 border-white shadow-2xl"
            />
            <button
              @click="showModal = false"
              class="absolute p-2 text-xl text-gray-700 bg-white rounded-full shadow top-2 right-2 bg-opacity-80 hover:bg-opacity-100"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 px-4 mt-8 text-left md:grid-cols-2 md:px-16">
        <div>
          <p class="font-semibold text-gray-500">Full Name</p>
          <p class="text-lg font-bold text-black">{{ $user->full_name }}</p>
        </div>
        <div>
          <p class="font-semibold text-gray-500">Role</p>
          <p class="text-lg font-bold text-black">{{ $user->role }}</p>
        </div>
        <div>
          <p class="font-semibold text-gray-500">Department</p>
          <p class="text-lg font-bold text-black">{{ $user->department ?? '-' }}</p>
        </div>
        <div>
          <p class="font-semibold text-gray-500">Email</p>
          <p class="text-lg font-bold text-black">{{ $user->email }}</p>
        </div>
        <div>
          <p class="font-semibold text-gray-500">Phone Number</p>
          <p class="text-lg font-bold text-black">{{ $user->phone_number ?? '-' }}</p>
        </div>
        <div>
          <p class="font-semibold text-gray-500">Address</p>
          <p class="text-lg font-bold text-black">{{ $user->address ?? '-' }}</p>
        </div>
      </div>

      <div class="flex justify-end mt-8">
        <a href="{{ route('profile.edit') }}" class="px-6 py-2 font-semibold text-white transition duration-300 bg-blue-800 rounded-full shadow-md hover:bg-blue-700">
          Edit
        </a>
      </div>
    </div>
  </div>


</body>
</html>
