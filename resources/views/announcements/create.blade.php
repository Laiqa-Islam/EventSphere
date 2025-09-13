<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-primary">📢 Create Announcement</h2>

        <form action="{{ route('announcements.store') }}" method="POST" class="p-4 border rounded-4 shadow-sm bg-light">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control form-control-lg"
                       placeholder="Enter announcement title" value="{{ old('title') }}" required>
            </div>

            {{-- Message --}}
            <div class="mb-3">
                <label for="message" class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                <textarea name="message" id="message" rows="4" class="form-control form-control-lg"
                          placeholder="Write your message here..." required>{{ old('message') }}</textarea>
            </div>

            {{-- If Organizer → Event announcements --}}
            @if(auth()->user()->role === 'organizer')
                <div class="mb-3">
                    <label for="event_id" class="form-label fw-semibold">Select Event</label>
                    <select name="event_id" id="event_id" class="form-select form-select-lg">
                        <option value="">-- Choose Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- If Admin → Target audience options --}}
            @if(auth()->user()->role === 'admin')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Target Audience</label>
                    <select name="target_type" id="target_type" class="form-select form-select-lg" onchange="toggleTargetFields()">
                        <option value="all">All Users</option>
                        <option value="role">By Role</option>
                        <option value="users">Specific Users</option>
                    </select>
                </div>

                <div id="roleField" class="mb-3" style="display:none;">
                    <label for="target_role" class="form-label fw-semibold">Select Role</label>
                    <select name="target_role" id="target_role" class="form-select form-select-lg">
                        <option value="student">Student</option>
                        <option value="organizer">Organizer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                @if(isset($users))
                    <div id="usersField" class="mb-3" style="display:none;">
                        <label for="target_users" class="form-label fw-semibold">Select Users</label>
                        <select name="target_users[]" id="target_users" class="form-select form-select-lg" multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold CTRL (Windows) or CMD (Mac) to select multiple users</small>
                    </div>
                @endif
            @endif

            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-send-fill"></i> Send Announcement
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleTargetFields() {
            let type = document.getElementById('target_type').value;
            document.getElementById('roleField').style.display = type === 'role' ? 'block' : 'none';
            document.getElementById('usersField').style.display = type === 'users' ? 'block' : 'none';
        }
    </script>
</x-dashboard-layout>
