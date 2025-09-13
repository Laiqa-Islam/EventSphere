<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-primary">🎉 Create New Event</h2>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
              class="p-4 border rounded-4 shadow-sm bg-light">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-lg"
                       placeholder="Enter event title" value="{{ old('title') }}" required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                <input type="text" name="category" class="form-control form-control-lg"
                       placeholder="Enter event category" value="{{ old('category') }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control form-control-lg" rows="4"
                          placeholder="Write a brief description..." required>{{ old('description') }}</textarea>
            </div>

            {{-- Venue --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Venue</label>
                <select name="venue_id" class="form-select form-select-lg">
                    <option value="">-- Select Venue --</option>
                    @foreach ($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }} (Capacity: {{ $venue->capacity }})</option>
                    @endforeach
                </select>
            </div>

            {{-- Date & Time --}}
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control form-control-lg"
                           value="{{ old('date') }}" required>
                </div>
                <div class="col">
                    <label class="form-label fw-semibold">Time <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control form-control-lg"
                           value="{{ old('time') }}" required>
                </div>
            </div>

            {{-- Max Participants --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Max Participants</label>
                <input type="number" name="max_participants" class="form-control form-control-lg"
                       placeholder="Enter maximum number of participants"
                       value="{{ old('max_participants') }}">
            </div>

            {{-- Banner --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Banner Image</label>
                <input type="file" name="banner" class="form-control form-control-lg">
                <small class="text-muted">Upload a banner image for the event (optional)</small>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-circle-fill"></i> Create Event
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
