<x-dashboard-layout>
    <div class="container mt-4">
        <h2>Edit Venue</h2>

        <form action="{{ route('venues.update', $venue->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Venue Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $venue->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $venue->capacity) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $venue->location) }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('venues.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-dashboard-layout>
