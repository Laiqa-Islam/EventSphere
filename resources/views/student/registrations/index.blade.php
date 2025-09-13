<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">My Event Registrations</h2>

        @foreach($registrations as $registration)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 border border-gray-100">
                <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    {{-- Left Side --}}
                    <div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $registration->event->title }}
                        </h5>
                        <p class="text-gray-500 flex items-center text-sm mb-2">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10m-11 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-1V3H6v2H5a2 2 0 00-2 2v10a2 2 0 002 2h2">
                                </path>
                            </svg>
                            {{ \Carbon\Carbon::parse($registration->event->date)->format('M d, Y') }} at
                            {{ $registration->event->time }}
                        </p>

                        {{-- Status Badge --}}
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                            @if($registration->status == 'confirmed') bg-green-100 text-green-700
                            @elseif($registration->status == 'waitlist') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>

                    {{-- Right Side --}}
                    @if($registration->status === 'confirmed')
                        <form action="{{ route('events.user.cancel', $registration->id) }}" method="POST"
                            class="mt-4 sm:mt-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                Cancel
                            </button>
                        </form>
                    @endif
                </div>

                {{-- QR Code Section --}}
                @if($registration && $registration->status === 'confirmed')
                    <div class="bg-gray-50 p-6 border-t flex flex-col items-center">
                        <h4 class="text-md font-semibold text-gray-800 mb-3">Your Check-in QR Code</h4>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=event_{{ $registration->event->id }}_user_{{ Auth::id() }}"
                            alt="QR Code" class="w-40 h-40 rounded-lg border shadow">
                    </div>
                @endif
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="flex justify-center mt-8">
            {{ $registrations->links() }}
        </div>
    </div>
</x-app-layout>
