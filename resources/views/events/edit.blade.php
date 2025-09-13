<x-dashboard-layout>
    <div class="container mt-4">
        <h2>Edit Event</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $event->category) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Venue</label>
                <select name="venue_id" class="form-select">
                    <option value="">-- Select Venue --</option>
                    @foreach ($venues as $venue)
                        <option value="{{ $venue->id }}" {{ $event->venue_id == $venue->id ? 'selected' : '' }}>
                            {{ $venue->name }} (Capacity: {{ $venue->capacity }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}" required>
                </div>
                <div class="col">
                    <label class="form-label">Time</label>
                    <input type="time" name="time" class="form-control" value="{{ old('time', $event->time) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Max Participants</label>
                <input type="number" name="max_participants" class="form-control" value="{{ old('max_participants', $event->max_participants) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Banner Image</label>
                <input type="file" name="banner" class="form-control">
                @if ($event->banner)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $event->banner) }}" alt="Banner" width="150" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update Event</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-dashboard-layout>
