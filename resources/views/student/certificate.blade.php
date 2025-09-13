<x-app-layout>
    <div class="container mx-auto px-4 mt-6">
        <h2 class="text-2xl font-bold mb-4">My Attended Events & Certificates</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @elseif(session('info'))
            <div class="bg-blue-100 text-blue-800 p-3 rounded mb-4">{{ session('info') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2 text-left">Event Title</th>
                        <th class="border border-gray-300 p-2 text-left">Date</th>
                        <th class="border border-gray-300 p-2 text-left">Status</th>
                        <th class="border border-gray-300 p-2 text-left">Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendedEvents as $attendance)
                        @php
                            $certificate = $attendance->event->certificates
                                ->where('student_id', auth()->id())
                                ->first();
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2">{{ $attendance->event->title }}</td>
                            <td class="border border-gray-300 p-2">{{ $attendance->event->date->format('d M Y') }}</td>
                            <td class="border border-gray-300 p-2">
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">Attended</span>
                            </td>
                            <td class="border border-gray-300 p-2">
                                @if($certificate)
                                    @if($certificate->status == 'approved')
                                        <a href="{{ $certificate->certificate_url }}"
                                            class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm"
                                            target="_blank">
                                            Download Certificate
                                        </a>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm font-medium">
                                            Waiting for Approval
                                        </span>
                                    @endif
                                @else
                                    <form action="{{ route('user.requestCertificate', $attendance->event->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Request
                                            Certificate</button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border border-gray-300 p-2 text-center text-gray-600">You haven’t
                                attended any events yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>