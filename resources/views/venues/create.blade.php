<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold text-primary">🏛 Add Venue</h2>

        <form action="{{ route('venues.store') }}" method="POST" class="p-4 border rounded-4 shadow-sm bg-light">
            @csrf

            <!-- Venue Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Venue Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter venue name" required>
            </div>

            <!-- Capacity -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Capacity <span class="text-danger">*</span></label>
                <input type="number" name="capacity" class="form-control form-control-lg" placeholder="e.g. 500" required>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Location</label>
                <input type="text" name="location" class="form-control form-control-lg" placeholder="Enter location">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('venues.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
