<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/WEBD" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img class="bi me-2" width="40" height="32" src="img/_8c57455a-bd11-4b52-af7d-1652585a6dbd.jpeg" alt="logo">
            <span class="fs-4">Browse 4 Beyblades</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Login</a></li>
        </ul>
    </header>
    <div class="container">

        <div class="row mb-3">
            <div class="col-3">
                <img src="img/bb1.jpg" width="200" height="200" alt="bb 1" srcset="">
                <p>Beyblade Burst QuadStrike Xcalius Power Speed Launcher Pack Battle Set with Xcalius Launcher and Spinning Spool</p>
                <button type="button" class="btn btn-primary">Buy</button>
            </div>
            <div class="col-3">
                <img src="img/bb2.jpg" width="200" height="200" alt="bb 1" srcset="">
                <p>EBKCQ Bey Blade Gyro Metal Super Combat, Beyblade Metal Fusion Toll for Children from 4, 5, 6, 7 Years, for Children and Adults with Launcher</p>
                <button type="button" class="btn btn-primary">Buy</button>
            </div>
            <div class="col-3">
                <img src="img/bb1.jpg" width="200" height="200" alt="bb 1" srcset="">
                <p>Beyblade N</p>
                <button type="button" class="btn btn-primary">Buy</button>
            </div>
            <div class="col-3">
                <img src="img/bb1.jpg" width="200" height="200" alt="bb 1" srcset="">
                <p>Beyblade N</p>
                <button type="button" class="btn btn-primary">Buy</button>
            </div>
            <div class="col-3">
                <img src="img/bb1.jpg" width="200" height="200" alt="bb 1" srcset="">
                <p>Beyblade N</p>
                <button type="button" class="btn btn-primary">Buy</button>
            </div>
        </div>


        <footer>
            <p>&copy; <?php echo date("d/m/Y"); ?> Beyblade webshop</p>
        </footer>
    </div>


    <!-- reload page on click for easy debugging -->
    <script>
        window.addEventListener('focus', () => {
            document.location = document.location
        })
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</body>

</html>