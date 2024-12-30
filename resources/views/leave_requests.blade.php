<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Leave Requests</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>

</head>
<body>
<div class="container mt-5">
    <div class="mb-4">
        <h2>Leave Requests</h2>
        <a href="{{ route('file.import')}}" class="btn btn-info text-end">Import</a>

        <a href="{{ route('login') }}" class="btn btn-danger">Logout</a>

        <button id="filter-btn" class="btn btn-primary float-end">Filter</button>   
    </div>

    <form action="{{ route('leave_requests.index') }}" method="get">
        <div id="filter-form" class="mb-4" style="display: none;">
            <div class="row">
                <div class="col-md-4">
                    <label for="filter_name">Employee Name</label>
                    <input type="text" id="filter_name" class="form-control" name="filter_name" placeholder="Search by name">
                </div>
                <div class="col-md-4">
                    <label for="filter_emp_id">Employee ID</label>
                    <input type="text" id="filter_emp_id" class="form-control"  name="filter_emp_id" placeholder="Search by ID">
                </div>
              
                <div class="col-md-4">
                    <label for="filter_emp_id">Date</label>
                    <input type="date" id="filter_date" class="form-control"  name="filter_date" placeholder="Search by ID">
                </div>

            </div>
            <div class="mt-3">
                <button id="filter-submit" class="btn btn-primary">Apply Filters</button>
                <button id="filter-reset" class="btn btn-secondary">Reset Filters</button>
            </div>
        </div>
    </form>

    <table id="leave-requests-table" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Employee ID</th>
                <th>Email</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Status</th>
                
            </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">
       $(function() {
    $('#filter-btn').click(function() {
        $('#filter-form').toggle();
    });

    $.ajaxSetup({
        headers: {
            
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let table = $('#leave-requests-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        pageLength: 10,
        ordering: false,
        language: {
            paginate: {
            next: 'Next',
            previous: 'Previous'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                className: 'btn btn-danger'
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                className: 'btn btn-danger'
            }
        ],
        ajax: {
            url: "{{ route('leave_requests.index') }}",
            data: function(d) {
                d.filter_name = $('#filter_name').val();
                d.filter_emp_id = $('#filter_emp_id').val();
                d.filter_date = $('#filter_date').val();
                d.search = $('input[type="search"]').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'emp_id', name: 'emp_id' },
            { data: 'emp_email', name: 'emp_email' },
            { data: 'date', name: 'date' },
            { data: 'reason', name: 'reason' },
            { data: 'status', name: 'status' }
        ]
    });

    $('#filter-submit').click(function(e) {
        e.preventDefault();
        table.draw();
    });

    $('#filter-reset').click(function(e) {
        e.preventDefault();
        $('#filter_name').val('');
        $('#filter_emp_id').val('');
        $('#filter_date').val('');
        table.draw();
    });

    $('input[type="search"]').keyup(function() {
        table.draw();
    });
});    
    q</script>

</body>
</html>
