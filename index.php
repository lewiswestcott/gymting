<?php

    session_start();

    if (!isset($_SESSION['userID']))
    {
        header("Location: ./login.php");
    }

    //Only 'admins' should be able to access this page.

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gymting | Home</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/pulse/bootstrap.min.css"> -->
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1><a class="navbar-brand" href="#">gymting</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <div class="nav-item">
                        <a class="nav-link" href="./php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <style>
        #carouselExampleFade img {
            height: 350px;
            object-fit: cover;
        }
    </style>

    <div class="container">
        <div class="row pt-3">
            <div class="col-12 ">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./img/3.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/2.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-3">

            <div class="col-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Hello, <?= $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?>!</div>
                    <div class="card-body">
                        <h4 class="card-title">About this site</h4>
                        <p class="card-text">On the right hand side you will see your most recent workouts. It will show
                            you in the table: Workout Time, Distance & Calories Burnt.</p>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Your Workouts</div>
                    <div class="card-body">
                        <h4 class="card-title">Your recent workouts</h4>

                        <table class="table" id="Workouts">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Distance</th>
                                    <th scope="col">Cals Burnt</th>
                                    <th scope="col">Modify</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php 
                                    $uid = $_SESSION["userID"];
                                    $SQL = "SELECT * FROM `tblWorkouts` WHERE `UID` = '$uid' ORDER BY `Date` DESC";
                                    require("php/_connect.php");
                                    $query = mysqli_query($connect, $SQL);
                                while ($user = mysqli_fetch_assoc($query)) {
                                
                                ?>

                            <tr>
                                <td><?php echo $user["Date"]; ?></td>
                                <td><?php echo $user['Duration']; ?></td>
                                <td><?php echo $user['Distance']; ?></td>
                                <td><?php echo $user['CalsBurnt']; ?></td>
                                <td><button class="bg-primary text-light btn-delete" data-id="<?= $user['entryID'] ?>"><i class="fa-solid fa-ban"></button></a></td>
                            </tr>
                            </tbody>
                                    <?php } ?>

                            

                        </table>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalOne">Add a new workout</button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header"><?= $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?>'s Analytics!
                    </div>
                    <div class="card-body">
                        <p class="card-text">Below you will see a chart demonstrating your progress over the last three
                            months!</p>
                        <p class="card-text">Google Charts Api</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2022 LewisWestcott Limited</p>

            <a href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="https://lewiswestcott.co.uk/logo.png">
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">lewiswestcott.co.uk</a></li>
            </ul>
        </footer>
    </div>

    </div>
    <div class="modal" tabindex="-1" id="modalOne">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a new workout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="php/createNewWorkout.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Date of workout</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration(HH:MM)</label>
                            <input type="time" class="form-control" name="duration">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Distance</label>
                            <input type="text" class="form-control" name="distance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Calories Burnt</label>
                            <input type="text" class="form-control" name="calsburnt">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });

        $('#btnOpenModal').click(function () {
            $('#modalOne').modal('show');
        });

        $('.btn-delete').click(function () {
            const userID = $(this).attr('data-id');

            $.ajax({
                url: './php/deleteUser.php',
                type: 'POST',
                data: {
                    userID: userID
                },
                success: function (response) {
                    console.log(response);
                    location.reload();

                }
            });
        });

        $('.')
    </script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

</body>




</html>