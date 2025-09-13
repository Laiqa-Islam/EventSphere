<x-dashboard-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary mb-0">📝 Event Feedback Overview</h1>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                @if($events->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-chat-left-text fs-1"></i>
                        <p class="mt-3 fs-5">No feedbacks available yet.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="fw-semibold">📌 Event</th>
                                    <th class="fw-semibold">📅 Date</th>
                                    <th class="fw-semibold">💬 Total Feedbacks</th>
                                    <th class="fw-semibold">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr class="text-center">
                                        <td class="fw-medium">{{ $event->title }}</td>
                                        <td>{{ $event->date->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark px-3 py-2">
                                                {{ $event->feedbacks_count }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.feedback.show', $event->id) }}" 
                                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-eye"></i> View Details
                                            </a>
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
