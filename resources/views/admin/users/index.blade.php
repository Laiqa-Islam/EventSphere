<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="fw-bold text-primary mb-4">👥 All Users</h2>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                ❌ {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                ⚠️ {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Users Table --}}
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">👤 Name</th>
                            <th scope="col">📧 Email</th>
                            <th scope="col">🎭 Role</th>
                            <th scope="col">⚡ Status</th>
                            <th scope="col">⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_suspended)
                                        <span class="badge bg-danger px-3 py-2">Suspended</span>
                                    @else
                                        <span class="badge bg-success px-3 py-2">Active</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.users.show', $user->id) }}" 
                                       class="btn btn-outline-info btn-sm rounded-pill px-3 me-1">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.users.suspend', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning btn-sm rounded-pill px-3 me-1">
                                            <i class="bi bi-pause-circle"></i> 
                                            {{ $user->is_suspended ? 'Unsuspend' : 'Suspend' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-people" style="font-size:2rem;"></i>
                                    <p class="mt-2">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
