<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            max-height: 800px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .image-half {
            flex: 1;
            background-image: url('https://i.pinimg.com/736x/c6/3a/89/c63a89ddfeb298f55031cb394b367b57.jpg');
            background-size: cover;
            background-position: center;
            height: 100%;
        }

        .form-half {
            flex: 1;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 20px;
            overflow: scroll;
            height: 100%;
            position: relative;
        }

        .container {
            width: 100%;
            max-width: 400px; 
        }

        .container h1 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 123, 255, 0.3);
        }

        .error {
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 5px;
        }

        
        .logout-btn {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }
    </style>
    <title>Leave Application Form</title>
</head>
<body>

<div class="wrapper">
    <div class="image-half"></div>

    <div class="form-half">
        
        <div class="container">
            <a href="{{ route('logout') }}" class="btn btn-danger" style="margin-left: 420px;">Logout</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1>Apply for Leave</h1>
          
            <form id="leaveForm" method="POST" action="{{ route('employees_store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Employee Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="emp_id" class="form-label">Employee ID:</label>
                    <input type="text" name="emp_id" id="emp_id" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="emp_email" class="form-label">Employee Email:</label>
                    <input type="email" name="emp_email" id="emp_email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Leave Date:</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason for Leave:</label>
                    <textarea name="reason" id="reason" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
          
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#leaveForm").submit(function (e) {
            e.preventDefault();
            $(".error").remove();
            let isValid = true;
            
            const name = $("#name").val().trim();
            if (name === "") {
                isValid = false;
                $("#name").after('<span class="error">Please enter your name.</span>');
            }
            const empId = $("#emp_id").val().trim();
            if (empId === "") {
                isValid = false;
                $("#emp_id").after('<span class="error">Please enter your employee ID.</span>');
            }

            const email = $("#emp_email").val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                isValid = false;
                $("#emp_email").after('<span class="error">Please enter your email.</span>');
            } else if (!emailRegex.test(email)) {
                isValid = false;
                $("#emp_email").after('<span class="error">Please enter a valid email.</span>');
            }

            const date = $("#date").val();
            if (date === "") {
                isValid = false;
                $("#date").after('<span class="error">Please select a leave date.</span>');
            }

            const reason = $("#reason").val().trim();
            if (reason === "") {
                isValid = false;
                $("#reason").after('<span class="error">Please provide a reason for leave.</span>');
            }

            if (isValid) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your leave request has been submitted successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
    });
</script>

</body>
</html>
