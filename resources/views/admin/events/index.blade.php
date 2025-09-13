<x-dashboard-layout>
    <div class="container">
        <h2>Pending Events</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if(session('info'))
        <div class="alert alert-warning">{{ session('info') }}</div> @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Organizer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->organizer->name }}</td>
                        <td>{{ $event->date }} {{ $event->time }}</td>
                        <td><span class="badge bg-warning">{{ ucfirst($event->status) }}</span></td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">Show</a>
                            <form action="{{ route('admin.events.approve', $event->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.events.reject', $event->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                            {{-- <form action="{{ route('admin.events.requestChanges', $event->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <input type="text" name="message" placeholder="Request details" required>
                                <button type="submit" class="btn btn-warning btn-sm">Request Changes</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No pending events</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-dashboard-layout>