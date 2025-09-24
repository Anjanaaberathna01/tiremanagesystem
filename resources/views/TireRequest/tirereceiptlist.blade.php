<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">
    @include('layouts.header')
    <div class="flex flex-col flex-1 overflow-hidden sm:flex-row">
        @include('layouts.side5')
        <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]">
            <div class="bg-white rounded-[30px] shadow p-4 sm:p-6 max-w-3xl mx-auto">
                <h2 class="mb-6 text-2xl font-extrabold text-blue-800 text-center">My Tire Receipts</h2>
                @if($orders->count())
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="text-left text-white bg-blue-800">
                                <th class="px-4 py-2 border">Request Code</th>
                                <th class="px-4 py-2 border">Vehicle No</th>
                                <th class="px-4 py-2 border">Order Date</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $order->tireRequest->request_code ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $order->tireRequest->vehicle->vehicle_number ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $order->created_at ? $order->created_at->format('Y-m-d') : '-' }}</td>
                                    <td class="px-4 py-2 border">
                                        @if($order->status === 'arrived')
                                            <span class="px-2 py-1 text-sm text-green-800 bg-green-200 rounded">Arrived</span>
                                        @else
                                            <span class="px-2 py-1 text-sm text-blue-800 bg-blue-100 rounded">Ordered</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('tirereceipt.view', ['order_id' => $order->id]) }}" class="text-blue-700 underline">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="py-8 text-center text-gray-600 font-semibold">No tire receipts found.</div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>
