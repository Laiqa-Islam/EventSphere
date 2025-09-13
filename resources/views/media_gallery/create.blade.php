<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-primary">📸 Upload Media</h2>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('media-gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Select Event --}}
                    <div class="mb-3">
                        <label for="event_id" class="form-label fw-semibold">Event <span class="text-danger">*</span></label>
                        <select name="event_id" class="form-select form-select-lg" required>
                            <option value="">-- Select Event --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- File Type --}}
                    <div class="mb-3">
                        <label for="file_type" class="form-label fw-semibold">File Type <span class="text-danger">*</span></label>
                        <select name="file_type" class="form-select form-select-lg" required>
                            <option value="image">🖼️ Image</option>
                            <option value="video">🎥 Video</option>
                        </select>
                    </div>

                    {{-- Upload File --}}
                    <div class="mb-3">
                        <label for="file" class="form-label fw-semibold">Upload File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control form-control-lg" required>
                        <small class="text-muted">Supported formats: JPG, PNG, MP4</small>
                    </div>

                    {{-- Caption --}}
                    <div class="mb-3">
                        <label for="caption" class="form-label fw-semibold">Caption</label>
                        <input type="text" name="caption" class="form-control form-control-lg"
                               placeholder="Write a short caption...">
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 rounded-pill">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success px-4 rounded-pill">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
