<aside class="relative z-10 w-full p-4 bg-white shadow sm:w-64">
    <div class="absolute inset-0 bg-center bg-cover opacity-40 blur-sm" style="background-image: url('{{ asset('assets/images/tire13.jpeg') }}');"></div>
    <div class="relative z-10 flex flex-col mt-4 space-y-4 sm:mt-8 sm:items-center sm:space-y-6">
        <a href="{{ route('tiredashboard') }}" class="block w-full text-center bg-green-600 text-white py-2 rounded-[10px] hover:bg-green-700 text-sm sm:text-base">
             Tire Details
        </a>
        <a href="{{ route('vehicledashboard') }}" class="block w-full text-center bg-blue-700 text-white py-2 rounded-[10px] hover:bg-blue-800 text-sm sm:text-base">
            Vehicle Details
        </a>
        <a href="{{ route('supplierdashboard') }}" class="block w-full text-center bg-purple-600 text-white py-2 rounded-[10px] hover:bg-purple-800 text-sm sm:text-base">
            Supplier Details
        </a>
    </div>
</aside>