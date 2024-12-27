<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <style>
        body {
            background: #d0ddf3;
        }
        .login-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .image-section {
            background-image: url('storage/images/admin.jpg');
            background-size: cover;
            background-position: center;
            animation: slideIn 1s ease-out;
        }
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0.9;
            }
            to {
                transform: translateX(0);
                opacity: 0.5;
            }
        }
        .form-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.5;
            }
        }
        .card {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            background: #ffffff;
            color: #333;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: #6a11cb;
            border: none;
        }
        .btn-primary:hover {
            background: #4e0b9a;
        }
        .form-control {
            border-radius: 8px;
        }
        .form-label {
            font-weight: bold;
        }
        .invalid-feedback {
            color: red;
            font-size: 0.9rem;
        }
        .is-invalid {
            border-color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="image-section col-md-6 m-5"></div>
        
        <div class="form-section col-md-6">
            <div class="card p-4" style="margin-right: auto; height: 400px;">
                <h2 class="text-center text-primary mb-4">Admin Login</h2>   
                
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="adminLoginForm" action="{{ url('admin-login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter admin email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter admin password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            
            $("#adminLoginForm").validate({
            rules: {
                email: {
                required: true,
                   email: true
                   },
                password: {
                required: true,
                minlength: 6
                        }
                    },
            messages: {
                    email: {
                        required: "Please enter your email address",
                      email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                },
                errorElement: "div",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".mb-4").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass(validClass);
                }
            });
        });
    </script>
</body>
</html>
