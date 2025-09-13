<x-dashboard-layout>
    <div class="container">
        <h2>Edit Media</h2>

        <form action="{{ route('media-gallery.update', $mediaGallery->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label for="event_id" class="form-label">Event</label>
                <select name="event_id" class="form-control" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $event->id == $mediaGallery->event_id ? 'selected' : '' }}>
                            {{ $event->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="file_type" class="form-label">File Type</label>
                <select name="file_type" class="form-control" required>
                    <option value="image" {{ $mediaGallery->file_type === 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ $mediaGallery->file_type === 'video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Current File:</label><br>
                @if($mediaGallery->file_type === 'image')
                    <img src="{{ asset('storage/' . $mediaGallery->file_url) }}" width="200">
                @else
                    <video width="200" controls>
                        <source src="{{ asset('storage/' . $mediaGallery->file_url) }}">
                    </video>
                @endif
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Replace File</label>
                <input type="file" name="file" class="form-control">
            </div>

            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" name="caption" class="form-control" value="{{ $mediaGallery->caption }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</x-dashboard-layout>