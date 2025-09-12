<!-- Sidebar -->
<aside class="relative z-10 w-full p-4 bg-white shadow sm:w-64">
    <div class="absolute inset-0 bg-center bg-cover opacity-40 blur-sm" style="background-image: url('{{ asset('assets/images/background3.png') }}');"></div>
    <div class="relative z-10 flex flex-col mt-4 space-y-4 sm:mt-8 sm:items-center sm:space-y-6">
        <a href="{{ route('tirerequest.new') }}" class="block w-full text-center bg-green-600 text-white py-2 rounded-[10px] hover:bg-green-700 text-sm sm:text-base">
            Submit Request
        </a>
        <a href="{{ route('tirerequest.view') }}" class="block w-full text-center bg-blue-700 text-white py-2 rounded-[10px] hover:bg-blue-800 text-sm sm:text-base">
            View Requests
        </a>
    </div>
</aside>