@extends('layouts.adminNavigation')

@section('page-title', 'Dashboard')

@section('panel-header')
    <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                     style="height: 200px;margin-top: 20px; margin-bottom: -20px;">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                    <h5>Total Users</h5>
                    <h3 class="text-primary"><b>{{ $data['totalUsers'] }} </b></h3>
                </div>
            </div>
        </div>
        <!-- Total Categories -->
        <div class="col-lg-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                     style="height: 200px;margin-top: 20px; margin-bottom: -20px;">
                    <i class="fas fa-list fa-3x mb-3 text-success"></i>
                    <h5>Total Categories</h5>
                    <h3 class="text-success"><b>{{ $data['totalCategories'] }}</b></h3>
                </div>
            </div>
        </div>
        <!-- Total Recipes -->
        <div class="col-lg-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                     style="height: 200px;margin-top: 20px; margin-bottom: -20px;">
                    <i class="fas fa-utensils fa-3x mb-3 text-warning"></i>
                    <h5>Total Recipes</h5>
                    <h3 class="text-warning"><b>{{ $data['totalRecipes'] }} </b></h3>
                </div>
            </div>
        </div>
        <!-- Total Orders -->
        <div class="col-lg-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                     style="height: 200px;margin-top: 20px; margin-bottom: -20px;">
                    <i class="fas fa-shopping-cart fa-3x mb-3 text-danger"></i>
                    <h5>Total Orders</h5>
                    <h3 class="text-danger"><b>{{ $data['totalOrders'] }} </b></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Tasks -->
        <div class="col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <h5 class="card-category">Team Progress</h5>

                    <div class="d-flex justify-content-between" style="margin-top: -15px;">
                        <h4 class="card-title">Ongoing Tasks</h4>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Add Task Button -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#addTaskModal">
                            <img src="{{ URL::asset('images/add.png')}}"
                                 style="max-width: 18px; margin-right: 5px; margin-top: -5px">
                            Add Task
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox"
                                                       {{ $task->completed ? 'checked' : '' }} onchange="updateTaskStatus(event, {{ $task->id }})">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-left">{{ $task->title }}</td>
                                    <td> {{$task->created_at}}</td>
                                    <td class="td-actions text-right">

                                        <button type="button"
                                                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-toggle="modal" data-target="#taskDetailsModal"
                                                onclick="loadTaskDetails({{ $task->id }}, '{{ $task->title }}', '{{ $task->description }}',
                                                 '{{ $task->created_at }}' , '{{$task->updated_at}}')">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>

                                        <form action="{{ route('admin.manageTasks.destroy', $task->id) }}" method="POST"
                                              style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                    onclick="confirmDelete(event, this)">
                                                <i class="now-ui-icons ui-1_simple-remove"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Task -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm" action="{{ route('admin.manageTasks.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="taskTitle">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title"
                                   placeholder="Enter task title" required>
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Task Description</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3"
                                      placeholder="Enter task description" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Task Details and edit it -->
    <div class="modal fade" id="taskDetailsModal" tabindex="-1" role="dialog" aria-labelledby="taskDetailsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailsModalLabel">Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="taskDetailsForm" action="{{ route('admin.manageTasks.update', ':id') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="taskDetailsTitle">Task Title</label>
                            <input type="text" class="form-control" id="taskDetailsTitle" name="title">
                        </div>
                        <input type="hidden" id="editTaskId" name="id">

                        <div class="form-group">
                            <label for="taskDetailsDescription">Task Description</label>
                            <textarea class="form-control" id="taskDetailsDescription" name="description"
                                      rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskCreatedAt">Created At</label>
                            <input type="text" class="form-control" id="taskCreatedAt" name="createdAt" readonly>
                        </div>
                        <div class="form-group">
                            <label for="taskUpdatedAt">Updated At</label>
                            <input type="text" class="form-control" id="taskUpdatedAt" name="UpdatedAt" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="taskDetailsForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-category"> Recipes Records</h5>
                    <h4 class="card-title"> Recent Recipes </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-primary">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Author</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['recentRecipes'] as $recipe)
                                <tr>
                                    <td>{{ $recipe->id }}</td>
                                    <td>
                                        <img
                                            src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/category.png') }}"
                                            alt="Category Image"
                                            style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $recipe->category->name }}</td>
                                    <td>{{ $recipe->title }}</td>
                                    <td>{{ $recipe->user->full_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Task Update
        function updateTaskStatus(event, taskId) {
            const isChecked = event.target.checked ? 1 : 0;

            // Send AJAX request to update the status
            fetch(`/admin/manageTasks/${taskId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({completed: isChecked})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Task status updated successfully!');
                    } else {
                        console.log('Error updating task status');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Task Details
        function loadTaskDetails(id, title, description, createdAt, UpdatedAt) {
            $('#editTaskId').val(id);
            $('#taskDetailsTitle').val(title);
            $('#taskDetailsDescription').val(description);
            $('#taskCreatedAt').val(createdAt);
            $('#taskUpdatedAt').val(UpdatedAt);


            const form = $('#taskDetailsForm');
            form.attr('action', form.attr('action').replace(':id', id));
        }

        function confirmDelete(event, button) {
            event.preventDefault(); // Prevent the form from submitting immediately

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
                    const form = button.closest('form'); // Find the closest form
                    form.submit(); // Submit the form
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');

            // Check if there's a success message
            if (successAlert) {
                // Auto-close the alert after 5 seconds
                setTimeout(function () {
                    successAlert.style.display = 'none';
                }, 5000); // 5 seconds
            }
        });

    </script>

@endsection

