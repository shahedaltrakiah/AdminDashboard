@extends('layouts.adminNavigation')

@section('page-title', 'Admin Profile')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">

                <h4 class="card-title">Admin Profile</h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Change Password Button -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">
                    <img src="{{ URL::asset('images/reset-password.png')}}" style="max-width: 25px; margin-right: 5px;">
                    Change Password
                </button>

            </div>

            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')

                    <!-- Email -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ $admin->email }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Created At</label>
                                <input type="text" class="form-control" name="created_at"
                                       value="{{ $admin->created_at }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Updated At -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Updated At</label>
                                <input type="text" class="form-control" name="updated_at"
                                       value="{{ $admin->updated_at }}" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.adminProfile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password"
                                   name="current_password"
                                   placeholder="Enter your current password">
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   id="new_password"
                                   name="new_password"
                                   placeholder="Enter a new password">
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="new_password_confirmation"
                                   name="new_password_confirmation"
                                   placeholder="Confirm your new password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000); // 3 seconds
    </script>

@endsection
