<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-dark vh-100">
    <div class="container-fluid d-flex h-100 justify-content-center align-items-center">
        <section class="login bg-primary p-3 shadow-lg rounded">
            <h1 class="text-center mb-3">gymting Login</h1>

            <form action="./php/auth.php" method="POST" class="p-0">
                <div class="mb-2">
                    <label for="txtEmail" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="txtEmail" required>
                </div>

                <div class="mb-2">
                    <label for="txtPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="txtPassword" required>
                </div>

                <button type="submit" class="btn btn-secondary w-100">Login</button>
            </form>

            <button class="btn btn-secondary mt-3 w-100" data-toggle="modal" data-target="#exampleModalLong">Register</button>

        </section>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Welcome!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="./php/createNewUser.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="txtEmail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="txtFirst">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="txtLast">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="txtPassword">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="txtPassword">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Go!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=6LdT5bIeAAAAAE-I0BW3zPVDJI-dm72y-xry9Grc"></script>

    <script>
        function Login() {
            grecaptcha.ready(function () {
                grecaptcha.execute('6LdT5bIeAAAAAE-I0BW3zPVDJI-dm72y-xry9Grc', {
                    action: 'create_comment'
                }).then(function (token) {
                    $.ajax({
                        //Populates the AJAX request.
                        url: './php/auth.php',
                        type: 'POST',
                        data: $('#login-form').serialize() + "&token=" + token,
                        success: function (response) {
                            //This function will run if the request was successful.

                            //If the server replies with 'true', redirect them to another page.
                            if (response == "true") {
                                window.location.href = "index.php";
                            } else {
                                //Otherwise, display an error message.
                                alert("Error: " + response);
                            }
                        },
                        error: function () {
                            //This function will run if the request failed.
                            alert("Something went wrong with the AJAX call.");
                        }
                    });
                });
            });
        }

        $('#login-form').submit(function (e) {
            e.preventDefault();

            Login();
        });
    </script>
</body>

</html>