<x-dashboard-layout>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">👤 User Profile</h2>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">
                <h4 class="mb-3">{{ $user->name }}</h4>
                <p><strong>Email:</strong> <span class="text-muted">{{ $user->email }}</span></p>
                <p><strong>Role:</strong> 
                    <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                </p>
                <p><strong>Status:</strong> 
                    @if($user->is_suspended)
                        <span class="badge bg-danger">Suspended</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Role Update Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="d-flex align-items-center gap-2">
                    @csrf
                    <label for="role" class="fw-bold me-2">Change Role:</label>
                    <select name="role" id="role" class="form-select w-auto">
                        <option value="participant" {{ $user->role == 'participant' ? 'selected' : '' }}>Participant</option>
                        <option value="organizer" {{ $user->role == 'organizer' ? 'selected' : '' }}>Organizer</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat"></i> Update Role
                    </button>
                </form>
            </div>
        </div>

        <!-- Reset Password Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">
                <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-shield-lock"></i> Reset Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                ⬅ Back to Users
            </a>
        </div>
    </div>
</x-dashboard-layout>
