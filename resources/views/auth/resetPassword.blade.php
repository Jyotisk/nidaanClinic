<x-app-layout>
    <div class="container-fluid">
        <h5 class="card-title fw-semibold mb-4">Change Password</h5>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('passwordChange') }}">
                    @csrf

                    <div>
                        <label for="current_password">Current Password</label>
                        <input class="form-control" id="current_password" type="password" name="current_password" required>
                        @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password">New Password</label>
                        <input class="form-control" id="password" type="password" name="password" required>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation">Confirm New Password</label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-sm rounded-0 mt-4">Change Password</button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>