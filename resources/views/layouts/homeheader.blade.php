
<!--header-->
<header class="relative z-30 flex items-center justify-between p-2 shadow-md bg-black/80 ">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('assets/images/logo2.png') }}" class="h-[80px]" alt="SLTMobitel Logo">
      </div>
      @auth
      <div class="relative">
        <div onclick="toggleDropdown('profileMenu')" class="flex items-center space-x-3 cursor-pointer">
          <span class="font-medium text-white">{{ Auth::user()->full_name ?? Auth::user()->name }}</span>
          <img
          src="{{ Auth::user()->image && \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->image) ? asset('storage/' . Auth::user()->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
          alt="Profile"
          class="object-cover w-10 h-10 border-2 border-white rounded-full shadow-lg"
        />

        </div>
        <div id="profileMenu" class="absolute right-0 z-40 hidden w-56 mt-2 text-black border-2 border-blue-600 shadow-lg rounded-xl">
          <!-- Banner Section -->
          <div class="flex items-center gap-3 px-4 py-3 text-white rounded-t-xl bg-gradient-to-r from-blue-700 to-blue-400">
          <img
            src="{{ Auth::user()->image && \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->image) ? asset('storage/' . Auth::user()->image) : 'https://randomuser.me/api/portraits/men/75.jpg' }}"
            alt="Profile"
            class="object-cover w-10 h-10 border-2 border-white rounded-full shadow-lg"
          />
            <div>
              <div class="font-semibold">{{ Auth::user()->full_name ?? Auth::user()->name }}</div>
              <div class="text-xs opacity-80">{{ Auth::user()->email }}</div>
            </div>
          </div>
          <!-- Menu Items -->
          <div class="bg-white rounded-b-xl">
            <a href="{{ url('/profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ url('/logout') }}">
              @csrf
              <button type="submit" class="block w-full px-4 py-2 text-left hover:bg-gray-100">Logout</button>
            </form>
          </div>
        </div>
      </div>
      @endauth
  </header>