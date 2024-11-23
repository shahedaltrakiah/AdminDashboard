@extends('layouts.adminNavigation')

@section('page-title', 'Manage Orders')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Orders</h4>

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
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'completed' ? 'active bg-success text-white font-weight-bold' : 'text-success' }}"
                       href="?status=completed" role="tab"
                       style="background-color: {{ $search_status === 'completed' ? '#28a745' : 'transparent' }}; color: {{ $search_status === 'completed' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-check-circle"></i> Completed
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'canceled' ? 'active bg-danger text-white font-weight-bold' : 'text-danger' }}"
                       href="?status=canceled" role="tab"
                       style="background-color: {{ $search_status === 'canceled' ? '#dc3545' : 'transparent' }}; color: {{ $search_status === 'canceled' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-times-circle"></i> Canceled
                    </a>
                </nav>

                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-primary">
                        <tr>
                            <th>User ID</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->user->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->order_status === 'completed' ? 'success' :
                                         ($order->order_status === 'canceled' ? 'danger' : 'warning') }}" style="font-size: 14px;">
                                            {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->total_amount }}JD</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>{{ $order->user->phone_number }}</td>
                                <td>
                                    <form id="form-{{ $order->id }}" action="{{ route('admin.manageOrders.update', $order->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="currentStatus" value="{{ $order->order_status }}">
                                        <select name="status" class="form-select form-select-sm"
                                                {{ in_array($order->order_status, ['completed', 'canceled']) ? 'disabled' : '' }}
                                                onchange="this.form.submit()">
                                            <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}>Completed</option>
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
