<x-dashboard-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary mb-0">👥 Attendees for "{{ $event->title }}"</h2>
            <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                ← Back to Events
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                @if($attendees->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-people fs-1"></i>
                        <p class="mt-3 fs-5">No attendees recorded for this event.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="fw-semibold">🙍 Name</th>
                                    <th class="fw-semibold">✉️ Email</th>
                                    <th class="fw-semibold">🕒 Registered On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendees as $attendance)
                                    <tr class="text-center">
                                        <td class="fw-medium">{{ $attendance->student->name }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark px-3 py-2">
                                                {{ $attendance->student->email }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $attendance->created_at->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
