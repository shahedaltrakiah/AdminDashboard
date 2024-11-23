@extends('layouts.adminNavigation')

@section('page-title', 'Manage Categories')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title"> Categories </h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <img src="{{ URL::asset('images/add.png')}}" style="max-width: 18px; margin-right: 5px; margin-top: -5px">
                    Add Category
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class=" text-primary ">
                        <th> Image </th>
                        <th> Category Name </th>
                        <th> Type </th>
                        <th> Active </th>
                        <th> Action </th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/category.png') }}"
                                         alt="Category Image"
                                         style="width: 70px; height: 70px; border-radius: 50%;">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->type }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="toggleStatus(event, {{ $category->id }})" {{ $category->is_active ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-success btn-sm"
                                       data-bs-toggle="modal" data-bs-target="#editUserModal"
                                       onclick="loadUserData({{ $category->id }}, '{{ $category->name }}', '{{ $category->type }}')">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.manageCategory.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(event, this)">
                                            <i class="fa fa-trash"></i>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.manageCategory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="category_image" name="category_image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryForm" action="{{ route('admin.manageCategory.update', ':id') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editCategoryId" name="id">

                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editType" class="form-label">Type</label>
                            <input type="text" class="form-control" id="editType" name="type" required>
                        </div>

                        <div class="mb-3">
                            <label for="editCategoryImage" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="editCategoryImage" name="category_image">
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
        function loadUserData(id, name, type) {
            $('#editCategoryId').val(id);
            $('#editName').val(name);
            $('#editType').val(type);

            const form = $('#editCategoryForm');
            form.attr('action', form.attr('action').replace(':id', id));
        }

        function confirmDelete(event, button) {
            event.preventDefault();

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
                    const form = button.closest('form');
                    if (form) {
                        form.submit();
                    }
                }
            });
        }

        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        function toggleStatus(event, categoryId) {
            const isActive = event.target.checked ? 1 : 0;  // 1 for checked (active), 0 for unchecked (inactive)

            // Send AJAX request to update the status
            fetch(`/admin/manageCategory/toggle-status/${categoryId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: isActive })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Status updated successfully!');
                    } else {
                        console.log('Error updating status');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

    </script>

@endsection
