<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'database.php';
    include 'common-functions.php';
    include 'navbar.php';
    ?>

    <div class="flex-container">
        <div class="container">

            <form id="createAccountForm" action="create-account-process.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" class="form-control" id="username" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="priceToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Warning</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Invalid email address.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- reload page on click for easy debugging -->
    <script>
        window.addEventListener('focus', () => {
            document.location = document.location
        })

        document.getElementById('createAccountForm').addEventListener('submit', function(event) {
            var emailInput = document.getElementById('email');
            var emailValue = emailInput.value;

            // Simple pattern for email validation
            var emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

            if (!emailPattern.test(emailValue)) {
                emailInput.classList.add('is-invalid');
                event.preventDefault();
                emailInput.focus();
                var toastEl = document.getElementById('priceToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            } else {
                emailInput.classList.remove('is-invalid');
            }
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>