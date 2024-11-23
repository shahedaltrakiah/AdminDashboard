@extends('layouts.adminNavigation')

@section('page-title', 'Manage Users')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Users</h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add User Button -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <img src="{{ URL::asset('images/add.png')}}" style="max-width: 18px; margin-right: 5px; margin-top: -5px" >
                    Add User
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class=" text-primary ">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/user.png') }}"
                                         alt="User Image"
                                         style="width: 50px; height: 50px; border-radius: 50%;">
                                </td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="toggleStatus({{ $user->id }})" {{ $user->is_active ? '' : 'checked' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <!-- Action Icons -->
                                    <a href="#" class="btn btn-success btn-sm"
                                       data-bs-toggle="modal" data-bs-target="#editUserModal"
                                       onclick="loadUserData({{ $user->id }}, '{{ $user->full_name }}', '{{ $user->email }}')">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.manageUser.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(event, this)">
                                            <i class="fa fa-trash"></i> <!-- Delete Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.manageUser.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm" action="{{ route('admin.manageUser.update', ':id') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" placeholder="Leave blank to keep current password">
                        </div>
                        <div class="mb-3">
                            <label for="editProfileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="editProfileImage" name="profile_image">
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
        function loadUserData(id, full_name, email,password) {
            $('#editUserId').val(id);
            $('#editName').val(full_name);
            $('#editEmail').val(email);

            const form = $('#editUserForm');
            form.attr('action', form.attr('action').replace(':id', id));
        }
    </script>

    <script>
        function confirmDelete(event, button) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    const form = button.closest('form');
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
        // Automatically hide the alert after 5 seconds (5000 milliseconds)
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease"; // Smooth fade-out effect
                alert.style.opacity = "0"; // Make it invisible
                setTimeout(() => alert.remove(), 500); // Remove it from the DOM after fade-out
            }
        }, 5000); // Adjust the time here if needed

    </script>

@endsection

