<x-dashboard-layout>
    <div class="container">
        <h1>Edit Announcement</h1>

        <form action="{{ route('announcements.update', $announcement) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $announcement->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message *</label>
                <textarea name="message" id="message" rows="4" class="form-control"
                    required>{{ old('message', $announcement->message) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Announcement</button>
        </form>
    </div>

</x-dashboard-layout>