<x-dashboard-layout>
    <div class="container mt-4">
        <h2>Registrations for {{ $event->title }}</h2>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table">
                    <tr>
                        <th>ID</th>
                        <th>Participant</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $registration->id }}</td>
                            <td>{{ $registration->student->name }}</td>
                            <td>{{ $registration->student->email }}</td>
                            <td>
                                <span class="badge bg-{{ $registration->status === 'confirmed' ? 'success' : ($registration->status === 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>{{ $registration->registered_on }}</td>
                            {{-- <td>
                                @if($registration->status !== 'confirmed')
                                    <form action="{{ route('registrations.approve', $registration->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                @endif
                                @if($registration->status !== 'cancelled')
                                    <form action="{{ route('registrations.reject', $registration->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @endif
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No registrations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
