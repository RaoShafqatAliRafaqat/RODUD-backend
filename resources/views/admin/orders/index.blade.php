<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        /* background-color: #faf6fd; */
        font-family: "Poppins", sans-serif;
    }

    .font-sm {
        font-size: 18px;
        color: #7514c5;
    }

    .custom-table thead tr th {
        background-color: #f8f3fc;
        font-size: 12px;
        color: #484848;
        font-weight: 500;
        border: none;
        border-top: solid 1px #d5d5d5;
        border-bottom: solid 1px #d5d5d5;

    }

    .custom-table thead tr th:first-child {
        border-left: solid 1px #d5d5d5;
        border-radius: 5px 0 0 5px;
    }

    .custom-table thead tr th:last-child {
        border-right: solid 1px #d5d5d5;
        border-radius: 0 5px 5px 0;
    }

    .custom-table tbody tr td {
        font-size: 12px;
        color: #484848;
        font-weight: 400;
        border: none;
    }

    .custom-table tbody tr td:nth-child(6) {

        color: #7514c5;
    }

    .table {
        border-collapse: separate;
        /* Important for border-radius to work */
        border-spacing: 0;
        /* Remove any spacing between cells */
        width: 100%;
        /* Adjust based on your layout */
    }

    /* Adding border radius to the <thead> */
    .table thead {
        background-color: #f0f0f0;
        /* Optional background color */
        border-top-left-radius: 10px;
        /* Top-left corner */
        border-top-right-radius: 10px;
        /* Top-right corner */
    }

    /* Optional: Adding a border to the table for clarity */
    .table th,
    .table td {
        border: 1px solid #ccc;
        /* Adjust border color as needed */
    }

    .btn-primary {
        background-color: #7514c5;
        border-color: #7514c5;
        font-size: 12px;
    }

    .btn-primary:hover {
        background-color: #7514c5;
        border-color: #7514c5;
    }

    .pagination {
        margin-left: 10px;
    }

    .page-link {
        padding: 3px 12px;
        color: #7514c5;
    }

    .active>.page-link,
    .page-link.active {
        z-index: 3;
        color: #ffffff;
        background-color: #7514c5;
        border-color: #7514c5;
    }
</style>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="font-sm">Orders</h1>
            <div class="d-flex align-items-center">

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-0 me-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-0 me-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('admin.logout.post') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>


        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle custom-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Pickup Time</th>
                        <th>Delivery Time</th>
                        <th>Created By</th>
                        <th>Status</th>
                        @if ($authUser->is_admin)
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersData as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['title'] }}</td>
                            <td>{{ $order['location'] }}</td>
                            <td>{{ $order['size'] }}</td>
                            <td>{{ $order['weight'] }}</td>
                            <td class="text-nowrap">{{ $order['pickup_time'] }}</td>
                            <td class="text-nowrap">{{ $order['delivery_time'] }}</td>
                            <td>{{ $order->createdBy?->name ?? '-' }}</td>
                            <td>
                                <span
                                    class="badge text-bg-{{ $order['status'] === 'pending' ? 'warning' : ($order['status'] === 'in_progress' ? 'primary' : 'success') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order['status'])) }}
                                </span>
                            </td>
                            @if ($authUser->is_admin)
                                <td>
                                    <form method="POST" class="hstack"
                                        action="{{ route('admin.orders.update', $order['id']) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm mb-0" required>
                                            <option value="pending"
                                                {{ $order['status'] === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="in_progress"
                                                {{ $order['status'] === 'in_progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="delivered"
                                                {{ $order['status'] === 'delivered' ? 'selected' : '' }}>Delivered
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ordersData->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
