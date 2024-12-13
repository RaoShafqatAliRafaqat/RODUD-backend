<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color: #faf6fd;
            font-family: "Poppins", sans-serif;
            font-weight: normal;
        }
        .form-label {
            font-size: 13px;
            color: #404040;
        }

        .form-control {
            font-size: 12px;
            color: #646464;
            border: solid 1px #e7e7e7;
            border-radius: 5px;
            box-shadow: 0px 0px 3px 0px #0000000d;
        }
        .btn-primary{
            background-color: #7514c5;
            border-color: #7514c5;
            font-size: 12px;
        }
        .btn-primary:hover{
            background-color: #7514c5;
            border-color: #7514c5;
        }
        .card{
            border: solid 1px #e7e7e7;
        }
    </style>
</head>

<body>
    <div class="container vstack justify-content-center align-items-center vh-100">
        <img src="https://cdn.prod.website-files.com/662c95fd6e0e4feedf85ad95/6641b0ea5a0e51161080324b_3%20(1).png" class="mb-4" style="height:30px" alt="">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h6 class="text-center mb-4">Welcome Back! Please Log In</h6>

            <!-- Display Validation Errors -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label ">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Login</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>