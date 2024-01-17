<!-- index_json.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Larasocial JSON</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous"
    />
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <h1 class="text-center btn-block">Learning API & JSON</h1>
                <div class="card mt-5">
                    <div class="card-body">
                        <h3>JSON Data:</h3>
                        <pre id="json-data"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        // Fetch JSON data and display it
        fetch('/json')
            .then(response => response.json())
            .then(data => {
                document.getElementById('json-data').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => console.error('Error fetching JSON data:', error));
    </script>
</body>

</html>
