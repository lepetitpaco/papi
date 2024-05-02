<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendings</title>
</head>
<body>
    <h1>Spendings</h1>

    <table border="1">
        <thead>
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
</body>
</html>
