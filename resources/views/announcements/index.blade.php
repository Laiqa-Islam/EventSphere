<x-dashboard-layout>
    <div class="container">
        <h1>Announcements</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-3">Create Announcement</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Sender</th>
                    <th>Target</th>
                    <th>Sent At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->title }}</td>
                        <td>
                            @if($announcement->organizer)
                                Organizer: {{ $announcement->organizer->name }}
                            @elseif($announcement->admin)
                                Admin: {{ $announcement->admin->name }}
                            @endif
                        </td>
                        <td>
                            @if($announcement->event)
                                Event: {{ $announcement->event->title }}
                            @elseif($announcement->target_role)
                                Role: {{ ucfirst($announcement->target_role) }}
                            @elseif($announcement->target_users)
                                Selected Users
                            @else
                                All Users
                            @endif
                        </td>
                        <td>{{ $announcement->sent_at ?? '—' }}</td>
                        <td>
                            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this announcement?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No announcements yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $announcements->links() }}
    </div>

</x-dashboard-layout>