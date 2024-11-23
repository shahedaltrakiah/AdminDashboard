@extends('layouts.adminNavigation')

@section('page-title', 'Manage Recipes')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title"> Recipes </h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addUserModal">
                    <img src="{{ URL::asset('images/add.png')}}"
                         style="max-width: 18px; margin-right: 5px; margin-top: -5px">
                    Add Recipe
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class=" text-primary">
                        <th> Image</th>
                        <th> Category</th>
                        <th> Title</th>
                        <th> Author</th>
                        <th> Active</th>
                        <th> Action</th>
                        </thead>
                        <tbody>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td>
                                    <img
                                        src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/category.png') }}"
                                        alt="Category Image"
                                        style="width: 50px; height: 50px; border-radius: 50%;">
                                </td>
                                <td>{{ $recipe->category->name ?? 'N/A' }}</td>  <!-- Fixed: using the relationship -->
                                <td>{{ $recipe->title }}</td>
                                <td>{{ $recipe->user->full_name }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox"
                                               onchange="toggleStatus(event, {{ $recipe->id }})" {{ $recipe->is_active ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('admin.manageRecipes.view', ['id' => $recipe->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="#" class="btn btn-success btn-sm"
                                       data-bs-toggle="modal" data-bs-target="#editUserModal"
                                       onclick="loadUserData({{ $recipe->id }}, '{{ $recipe->title }}', '{{ $recipe->description }}' , '{{ $recipe->time }}' , '{{ $recipe->category->name }}')">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.manageRecipes.destroy', $recipe->id) }}" method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete(event, this)">
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
            <form action="{{ route('admin.manageRecipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New Recipe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Category</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="number" class="form-control" id="time" placeholder="minuet" name="time" required>
                        </div>

                        <div class="mb-3">
                            <label for="recipe_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="recipe_image" name="recipe_image">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Recipe</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryForm" action="{{ route('admin.manageRecipes.update', ':id') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Recipe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editCategoryId" name="id">

                        <div class="mb-3">
                            <label for="editName" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editName" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="editDescription" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editTime" class="form-label">Time</label>
                            <input type="number" class="form-control" id="editTime" name="time" placeholder="minuet" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Category</label>
                            <select class="form-select" id="type" name="type" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editRecipeImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editRecipeImage" name="recipe_image">
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
        function loadUserData(id, name, description, time) {
            $('#editCategoryId').val(id);
            $('#editName').val(name);
            $('#editDescription').val(description);
            $('#editTime').val(time);

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
            const isActive = event.target.checked ? 1 : 0;

            // Send AJAX request to update the status
            fetch(`/admin/manageRecipes/toggle-status/${categoryId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({is_active: isActive})
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
