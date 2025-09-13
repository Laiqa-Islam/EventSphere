<x-dashboard-layout>
    <div class="container mt-4">
        <h2>Venues</h2>
        <div class="mb-3">
            <a href="{{ route('venues.create') }}" class="btn btn-primary">Add Venue</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($venues as $venue)
                        <tr>
                            <td>{{ $venue->id }}</td>
                            <td>{{ $venue->name }}</td>
                            <td>{{ $venue->capacity }}</td>
                            <td>{{ $venue->location }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No venues found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $venues->links() }}
    </div>
</x-dashboard-layout>
