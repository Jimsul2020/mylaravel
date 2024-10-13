<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="centered d-block align-content-center justify-center" style="width: 50%; marggin:10px; padding:20px;">
        <div>
            <h1 class="text-center">Payment callback</h1>
        </div>
        <div class="p-10 bg-info mt-10">
           <table>
            <tr>
                <td>Status</td>
                <td>{{ $data->status }}</td>
            </tr>
            
            <tr>
                <td>Reference</td>
                <td>{{ $data->reference }}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{{ $data->amount }}</td>
            </tr>
            <tr>
                <td>Fee</td>
                <td>{{ $data->fees }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $data->customer->email }}</td>
            </tr>
           </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
