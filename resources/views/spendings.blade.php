<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendings</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>
<body>
    <script>
    $(document).ready(function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('date').value = today;

        // Initialize DataTables
        $('#spendingsTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "responsive": true,
        });

        $('form').submit(function() {
            $('#addButton').prop('disabled', true).text('Enregistrement...');
            return true; // ensure form still submits
        });
    });
    </script>

    <div class="container mt-5">
        <h1 class="mb-4">Spendings</h1>

        <!-- Form for adding a new spending entry -->
        <form action="{{ route('spendings.store') }}" method="POST" class="mb-3">
            @csrf <!-- CSRF protection -->
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="Courses">Courses</option>
                    <option value="Fast Food">Fast Food</option>
                    <option value="Bar">Bar</option>
                    <option value="Restau">Restau</option>
                    <option value="Jeux">Jeux</option>
                    <option value="Carburant">Carburant</option>
                    <option value="Retrait">Retrait</option>
                    <option value="Autre">Autre</option>
                    <option value="Amazon">Amazon</option>
                    <option value="Assurance Moyen de Paiement">Assurance Moyen de Paiement</option>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" step="0.10" required inputmode="decimal">

            </div>

            <div class="form-group form-check">
                <input type="checkbox" id="withdrawn" name="withdrawn" class="form-check-input" value="1" checked>
                <label class="form-check-label" for="withdrawn">Withdrawn</label>
            </div>

            <button type="submit" id="addButton" class="btn btn-primary">Ajouter la dépense</button>
        </form>

        <!-- Display existing spendings -->
        <div class="table-responsive">
            <table id="spendingsTable" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Withdrawn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spendings as $spending)
                        <tr>
                            <td>{{ $spending->category }}</td>
                            <td>{{ $spending->title }}</td>
                            <td>{{ $spending->date }}</td>
                            <td>{{ $spending->amount }}</td>
                            <td>{{ $spending->withdrawn ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
