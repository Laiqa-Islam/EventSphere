<x-dashboard-layout>
    <div class="main-content">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center align-middle">
                        <thead class="table text-white">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->category }}</td>
                                    <td>{{ $event->date }} {{ $event->time }}</td>
                                    <td>{{ $event->venue->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $event->status == 'approved' ? 'success' : ($event->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-success">Update</a>
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-warning">View</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No events found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
