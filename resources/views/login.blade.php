<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ede2fa, #c5d8fa);
            color:#ede2fa;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }

        .card {
            border-radius: 15px;
            background:  #d0ddf3;
            color: #333;
            animation: fadeIn 1s ease-in-out;
            padding: 40px;
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
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #6a11cb;
        }

        .form-label {
            font-weight: bold;
        }

        .link {
            color: #6a11cb;
        }

        .link:hover {
            color: #4e0b9a;
            text-decoration: underline;
        }

        .image-container {
            flex: 1;
            background:url('storage/images/login_img.png') no-repeat;
            background-size: cover;
            height: 100%;
            border-radius: 15px 0 0 15px;
            animation: fadeInImage 1s ease-in-out;
        }

        .login-section {
            flex: 1;
            padding: 20px;
            max-width: 400px;
        }
        .image-container{
            max-width: 641px;
            height: 500px;
            border-radius: 10px;
        }

        .card{
            width: 392px;
            height: 470px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 0; }
        }

        @keyframes fadeInImage {
            from { opacity: 0; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="image-container"></div>
        <div class="login-section">
            <div class="card shadow p-4">
                <h2 class="text-center text-primary mb-4">Login</h2>

                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="loginForm" action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" >
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="text-center mt-3">
                        <a href="{{ url('admin-login') }}" class="link">Admin Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                const email = $('#email').val();
                const password = $('#password').val();
                let isValid = true;

                $('input').removeClass('is-invalid');

                if (!email) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                }
                if (!password) {
                    $('#password').addClass('is-invalid');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>


