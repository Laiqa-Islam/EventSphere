<x-dashboard-layout>
    <div class="container mt-4">
        <h2>Event Details</h2>

        <div class="card">
            <div class="card-header bg-dark text-white">
                {{ $event->title }}
            </div>
            <div class="card-body">
                @if ($event->banner_image)
                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Banner" class="img-fluid mb-3">
                @endif

                <p><strong>Category:</strong> {{ $event->category }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
                <p><strong>Date & Time:</strong> {{ $event->date }} at {{ $event->time }}</p>
                <p><strong>Venue:</strong> {{ $event->venue->name ?? 'N/A' }} (Capacity: {{ $event->venue->capacity ?? '-' }})</p>
                <p><strong>Max Participants:</strong> {{ $event->max_participants ?? 'Unlimited' }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $event->status == 'approved' ? 'success' : ($event->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </p>
                <p><strong>Organizer:</strong> {{ $event->organizer->full_name ?? $event->organizer->name }}</p>
            </div>
            <div class="card-footer">
                @if($event->status == 'approved')
                    <a href="{{ route('registrations.index', $event->id) }}" class="btn btn-warning">Registrations</a>
                @endif
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
                @if (Auth::id() === $event->organizer_id || Auth::user()->role === 'admin')
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
