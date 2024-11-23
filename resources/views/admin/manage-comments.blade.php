@extends('layouts.adminNavigation')

@section('page-title', 'Manage Comments & Reviews')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Comments & Reviews </h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="card-body">

                <nav id="orders-table-tab"
                     class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === '' ? 'active bg-info text-white font-weight-bold' : 'text-dark' }}"
                       href="?status=" role="tab"
                       style="background-color: {{ $search_status === '' ? '#007bff' : 'transparent' }}; color: {{ $search_status === '' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-list-ul"></i> All
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'pending' ? 'active bg-warning text-white font-weight-bold' : 'text-warning' }}"
                       href="?status=pending" role="tab"
                       style="background-color: {{ $search_status === 'pending' ? '#ffc107' : 'transparent' }}; color: {{ $search_status === 'pending' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-hourglass-half"></i> Pending
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'accepted' ? 'active bg-success text-white font-weight-bold' : 'text-success' }}"
                       href="?status=accepted" role="tab"
                       style="background-color: {{ $search_status === 'accepted' ? '#28a745' : 'transparent' }}; color: {{ $search_status === 'accepted' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-check-circle"></i> Accepted
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'rejected' ? 'active bg-danger text-white font-weight-bold' : 'text-danger' }}"
                       href="?status=rejected" role="tab"
                       style="background-color: {{ $search_status === 'rejected' ? '#dc3545' : 'transparent' }}; color: {{ $search_status === 'rejected' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-times-circle"></i> Rejected
                    </a>
                </nav>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class=" text-primary">
                        <th> User ID</th>
                        <th> Recipes ID</th>
                        <th> Rating</th>
                        <th> Comment</th>
                        <th> Date</th>
                        <th> Status</th>
                        <th> Action</th>
                        </thead>
                        <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td> {{$comment->user_id}} </td>
                                <td>{{ $comment->recipe_id }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $comment->rating)
                                            <i class="fas fa-star" style="color: #FFD700;"></i> <!-- Gold for filled stars -->
                                        @else
                                            <i class="far fa-star" style="color: #FFD700;"></i> <!-- Light gold for empty stars -->
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $comment->comment}}</td>
                                <td> {{$comment->created_at}}</td>
                                <td>
                                    <span class="badge
                                    @if ($comment->comment_status === 'pending') bg-warning
                                    @elseif ($comment->comment_status === 'accepted') bg-success
                                    @elseif ($comment->comment_status === 'rejected') bg-danger
                                    @else bg-secondary @endif" style="font-size: 14px;">
                                        {{ ucfirst($comment->comment_status) }}
                                    </span>
                                </td>

                                <td>
                                    <form id="form-{{ $comment->id }}"
                                          action="{{ route('admin.manageComments.update', $comment->id) }}"
                                          method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="currentStatus"
                                               value="{{ $comment->comment_status }}">
                                        <select name="status" class="form-select form-select-sm"
                                                {{ in_array($comment->comment_status, ['Accepted', 'Rejected']) ? 'disabled' : '' }}
                                                onchange="this.form.submit()">
                                            <option
                                                value="pending" {{ $comment->comment_status === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option
                                                value="accepted" {{ $comment->comment_status === 'accepted' ? 'selected' : '' }}>
                                                Accepted
                                            </option>
                                            <option
                                                value="rejected" {{ $comment->comment_status === 'rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>

                                        </select>
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

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

@endsection
