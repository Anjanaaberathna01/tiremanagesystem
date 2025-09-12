<x-app-layout>

<body class="overflow-hidden font-sans text-white bg-black bg-opacity-20" style="background-image: url('assets/images/tire9.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">

  <!-- ✅ BLUR OVERLAY -->
  <div class="absolute inset-0 bg-black/40 z-0 backdrop-blur-[8px]"></div>
  <!-- Header Section -->
    @include('layouts.homeheader')


  <!-- Main Content -->
  <main class="relative z-10 flex items-center justify-center min-h-[calc(100vh-160px)] px-4 text-center animate-fadeInSlow mb-20">
    <div class="w-full space-y-6 max-w-7xl">
      <h1 class="text-4xl font-extrabold md:text-6xl drop-shadow-lg">Tire Management System</h1>
      <p class="text-xl font-medium text-gray-300 md:text-2xl">Smart Management for SLT Mobile Vehicles</p>
      <p class="text-sm text-gray-400">© 2025 SLT Mobile Systems</p>

      <!-- Buttons Row -->
      <div class="grid w-full grid-cols-1 gap-6 px-4 mt-10 md:grid-cols-2 lg:grid-cols-4">

        <!-- Master Data -->
        <div class="relative w-full">
          <a href="{{ url('tiredashboard') }}"
            class="w-full h-14 rounded-[10px] font-bold flex items-center justify-center gap-3 shadow-lg hover:scale-105 transition-transform text-base font-serif btn-gradient">
            <img src="https://img.icons8.com/?size=100&id=cUn1sl6y4Whd&format=png&color=000000" class="w-auto h-6" />
            Master Data
        </a>
          
        </div>

        <!-- Tire Request -->
        <div class="relative w-full">
          <button onclick="toggleDropdown('requestDropdown')"
            class="w-full h-14 rounded-[10px] font-bold flex items-center justify-center gap-3 shadow-lg hover:scale-105 transition-transform text-base font-serif btn-gradient">
            <img src="https://img.icons8.com/?size=100&id=25643&format=png&color=000000" class="w-auto h-6" />
            Tire Request
          </button>
          <div id="requestDropdown" class="absolute z-10 hidden w-full mt-2 text-black bg-white shadow-lg dropdown-animation rounded-xl">
            <a href="{{ route('tirerequest.new') }}" class="block px-4 py-2 hover:bg-gray-100">Tire Request</a>
            <a href="{{ route('tirerequest.approval') }}" class="block px-4 py-2 hover:bg-gray-100">Approval</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Tire Receipt</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">User Inquiry</a>
          </div>
        </div>

        <!-- Transport Section -->
        <div class="relative w-full">
          <button onclick="toggleDropdown('transportDropdown')"
            class="w-full h-14 rounded-[10px] font-bold flex items-center justify-center gap-3 shadow-lg hover:scale-105 transition-transform text-base font-serif btn-gradient">
            <img src="https://img.icons8.com/?size=100&id=15126&format=png&color=000000" class="w-auto h-6" />
            Transport Section
          </button>
          <div id="transportDropdown" class="absolute z-10 hidden w-full mt-2 text-black bg-white shadow-lg dropdown-animation rounded-xl">
            <a href="{{ route('transport.evaluation') }}" class="block px-4 py-2 hover:bg-gray-100">Enter Evaluation</a>
            <a href="{{ route('transport.viewtransport') }}" class="block px-4 py-2 hover:bg-gray-100">Approval</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Credit Repair Order</a>
          </div>
        </div>

        <!-- Report -->
        <div class="relative w-full">
          <button onclick="toggleDropdown('reportDropdown')"
            class="w-full h-14 rounded-[10px] font-bold flex items-center justify-center gap-3 shadow-lg hover:scale-105 transition-transform text-base font-serif btn-gradient">
            <img src="https://img.icons8.com/?size=100&id=12150&format=png&color=000000" class="w-auto h-6" />
            Report
          </button>
          <div id="reportDropdown" class="absolute z-10 hidden w-full mt-2 text-black bg-white shadow-lg dropdown-animation rounded-xl">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Tire Report</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Receipt Report</a>
          </div>
        </div>

      </div>
    </div>
  </main>
  
  <!-- Custom JavaScript -->
  <script src="{{ asset('assets/js/script.js') }}"></script>


</body>

</x-app-layout>
