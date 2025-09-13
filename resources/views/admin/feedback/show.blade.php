<x-dashboard-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary mb-0">⭐ Feedback for: {{ $event->title }}</h1>
            <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-secondary rounded-pill">
                ← Back
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                @if($event->feedbacks->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-emoji-frown fs-1"></i>
                        <p class="mt-3 fs-5">No feedback submitted yet.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Submitted On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event->feedbacks as $feedback)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $feedback->student->name }}</div>
                                            <small class="text-muted">{{ $feedback->student->email }}</small>
                                        </td>

                                        {{-- Rating with stars --}}
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                ⭐ {{ $feedback->rating }} / 5
                                            </span>
                                        </td>

                                        {{-- Comment --}}
                                        <td style="max-width: 300px;">
                                            <span class="text-muted">
                                                {{ $feedback->comments ?: '—' }}
                                            </span>
                                        </td>

                                        {{-- Submitted Date --}}
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($feedback->submitted_on)->format('d M Y, h:i A') }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            @if (Auth::user()->role == 'admin')
                                                <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" 
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm rounded-pill">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
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
