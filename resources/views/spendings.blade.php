<!-- spendings.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendings</title>
</head>
<body>
    <script>
        window.onload = function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('date').value = today;
        };
    </script>
    <h1>Spendings</h1>

    <!-- Form for adding a new spending entry -->
    <form action="{{ route('spendings.store') }}" method="POST">
        @csrf <!-- CSRF protection -->
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="cat_test_front" required><br><br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="title_test_front" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" value="10" required><br><br>

        <label for="withdrawn">Withdrawn:</label>
        <input type="checkbox" id="withdrawn" name="withdrawn" value="1"><br><br>

        <button type="submit">Add Spending</button>
    </form>

    <!-- Display existing spendings -->
    <table border="1">
        <!-- Table header -->
        <thead>
            <tr>
                <th>Category</th>
                <th>Title</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Withdrawn</th>
            </tr>
        </thead>
        <!-- Table body -->
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
</body>
</html>
