
<x-app-layout>
<body class="flex flex-col h-screen overflow-hidden bg-gray-100">

	<!-- Header -->
	@include('layouts.header')

	<!-- Main Content Wrapper -->
	<div class="flex flex-col flex-1 overflow-hidden sm:flex-row">

		<!-- Sidebar -->
		@include('layouts.side5')

		<!-- Main Scrollable Content -->
		<div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#999999]">
			<div class="bg-white rounded-[30px] shadow p-4 sm:p-6 max-w-2xl mx-auto">

				<!-- Title -->
				<div class="mb-6 text-center">
					<h2 class="text-2xl font-extrabold text-blue-800">Tire Receipt</h2>
					<p class="text-gray-600">Below is your approved tire order receipt.</p>
				</div>

				@if(isset($order) && $order)
				<div class="space-y-4">
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Request Code:</span>
						<span class="flex-1">{{ $order->tireRequest->request_code ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Vehicle No:</span>
						<span class="flex-1">{{ $order->tireRequest->vehicle->vehicle_number ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Requested By:</span>
						<span class="flex-1">{{ $order->tireRequest->user->full_name ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Tire Size:</span>
						<span class="flex-1">{{ $order->tireRequest->tire_size_required ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Tire Brand:</span>
						<span class="flex-1">{{ $order->tireRequest->tire_brand_required ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">No. of Tires:</span>
						<span class="flex-1">{{ $order->tireRequest->number_of_tires ?? '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Order Date:</span>
						<span class="flex-1">{{ $order->created_at ? $order->created_at->format('Y-m-d') : '-' }}</span>
					</div>
					<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
						<span class="font-medium text-gray-700 sm:w-1/3">Order Status:</span>
						<span class="flex-1">
							@if($order->status === 'arrived')
								<span class="px-2 py-1 text-sm text-green-800 bg-green-200 rounded">Arrived</span>
							@else
								<span class="px-2 py-1 text-sm text-blue-800 bg-blue-100 rounded">Ordered</span>
							@endif
						</span>
					</div>
				</div>
				@else
					<div class="py-8 text-center text-gray-600 font-semibold">No tire order receipt found.</div>
				@endif

				<div class="mt-8 text-center">
					<a href="{{ route('home') }}" class="inline-block px-6 py-2 font-semibold text-white bg-blue-700 rounded-full hover:bg-blue-800">Back to Home</a>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</x-app-layout>
