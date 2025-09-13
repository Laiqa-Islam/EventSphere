<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-primary">📊 Events Attendance Overview</h2>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th class="fw-semibold">📌 Event Title</th>
                                <th class="fw-semibold">📅 Date</th>
                                <th class="fw-semibold">👥 Attended</th>
                                <th class="fw-semibold">⚡ Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr class="text-center">
                                    <td class="fw-medium">{{ $event->title }}</td>
                                    <td>{{ $event->date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-success px-3 py-2">
                                            {{ $event->attendances_count }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('attendance.details', $event->id) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye-fill"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-calendar-x fs-4"></i>
                                        <p class="mb-0 mt-2">No events found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
