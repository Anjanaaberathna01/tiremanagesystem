<!-- filepath: resources/views/Transport/afterevaluation.blade.php -->
<x-app-layout>

<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

  <!-- Header -->
  @include('layouts.header')

  <div class="flex flex-col flex-1 overflow-hidden md:flex-row">

    <!-- Sidebar -->
    @include('layouts.side4')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]">
      <div class="bg-white rounded-[30px] shadow p-4 sm:p-6">

        <!-- Title and Search -->
        <div class="flex flex-col justify-between mb-4 md:flex-row md:items-center sm:mb-6">
          <h2 class="mb-4 text-xl font-extrabold text-blue-800 sm:text-2xl md:mb-0">Mechanic Approved/Rejected Requests</h2>

          <div class="relative w-full md:w-80">
            <input
              type="text"
              id="mechanicSearchInput" onkeyup="filterTable('mechanicTable', 'mechanicSearchInput')"
              placeholder="Search by Vehicle No, Driver..."
              class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 6.65a7.5 7.5 0 010 10.6z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table id="mechanicTable" class="min-w-full border border-gray-200">
            <thead>
              <tr class="text-left text-white bg-blue-800">
                <th class="px-4 py-2 border">Vehicle No</th>
                <th class="px-4 py-2 border">Driver</th>
                <th class="px-4 py-2 border">Tire Size</th>
                <th class="px-4 py-2 border">Tire Brand</th>
                <th class="px-4 py-2 border">No. of Tire</th>
                <th class="px-4 py-2 border">Mechanic Approval Status</th>
                <th class="px-4 py-2 border">Date</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              @forelse($requests as $req)
                @if(
                  $req->section_approval_status === 'approved' &&
                  in_array($req->mechanic_approval_status, ['approved', 'rejected'])
                )
                <tr class="text-gray-700">
                  <td class="px-4 py-2 border">{{ $req->vehicle->vehicle_number ?? '-' }}</td>
                  <td class="px-4 py-2 border">{{ $req->user->full_name ?? '-' }}</td>
                  <td class="px-4 py-2 border">{{ $req->tire_size_required }}</td>
                  <td class="px-4 py-2 border">{{ $req->tire_brand_required }}</td>
                  <td class="px-4 py-2 border">{{ $req->number_of_tires }}</td>
                  <td class="px-4 py-2 border">
                    @if($req->mechanic_approval_status === 'approved')
                      <span class="px-2 py-1 text-sm text-green-800 bg-green-200 rounded">Approved</span>
                    @elseif($req->mechanic_approval_status === 'rejected')
                      <span class="px-2 py-1 text-sm text-red-800 bg-red-200 rounded">Rejected</span>
                    @else
                      <span class="px-2 py-1 text-sm text-yellow-800 bg-yellow-200 rounded">Pending</span>
                    @endif
                  </td>
                  <td class="px-4 py-2 border">{{ $req->created_at ? $req->created_at->format('Y-m-d') : '-' }}</td>
                </tr>
                @endif
              @empty
                <tr>
                  <td colspan="7" class="py-4 text-center">No mechanic approved or rejected requests found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <script>
    function filterTable(tableId, inputId) {
      const input = document.getElementById(inputId);
      const filter = input.value.toLowerCase();
      const table = document.getElementById(tableId);
      const trs = table.getElementsByTagName('tr');
      for (let i = 1; i < trs.length; i++) { // skip header
        let tds = trs[i].getElementsByTagName('td');
        let show = false;
        for (let j = 0; j < tds.length; j++) {
          if (tds[j] && tds[j].textContent.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
        trs[i].style.display = show ? '' : 'none';
      }
    }
  </script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>