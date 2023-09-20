<?php
session_start();
include('db_conn.php');

$menu = $checkout = "";

if (isset($_SESSION['email'])) {
  
}else{
  header("location:index.php");
  die();
}
$show = $info = "";

$email = $_SESSION['email'];
$sql = "SELECT * FROM `orders` WHERE `email` = '$email'";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
    if (!empty($row)) {
      do {
        $status = '<b class="text-warning">En cours</b>';
        if ($row['status'] == 1) {
          $status = '<b class="text-success">Complété</b>';
        }elseif ($row['status'] == 2) {
          $status = '<b class="text-danger">Annulé</b>';
        }
          $show .= '<tr>
                  <td>'.$row['idOrder'].'</td>
                  <td>'.date('d-M-Y', strtotime($row['date'])).'</td>
                  <td>'.$status.'</td>
                  <td><a href="order_details.php?idOrder='.$row['idOrder'].'" class="text-primary">Plus de Détails</a></td>
          </tr>';
      } while ($row = $stmt->fetch());
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SneakStore</title>
  </head>
  <body>
  <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
         
          <a class="navbar-brand d-flex align-items-center mx-auto order-2" href="index.php">
          <img src="images/logo.png" alt="" height="70" class="d-inline-block me-2 align-text-top">
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse ms-auto order-3 flex-grow-0" id="navbarText">
            <?php include('navbar.php'); ?>
        </div>
        
    <form class="d-flex me-auto order-1" action="search.php" method="GET">
      <input class="form-control me-2" type="search" name="q" placeholder="Rechercher" aria-label="Search">
      <button class="btn btn-danger" type="submit">Rechercher</button>
    </form>
        </div>
      </nav>
  </header>
    <div class="wrapper">
        <div class="container">
        <div class="heading my-3">
          <h2>Commandes</h2>
          </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID de commande</th>
                        <th>Date de commande</th>
                        <th>Etat</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $show; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <footer class="py-4 mt-4 footer-dark bg-dark">
      
      <p class="text-center text-muted mb-0">© 2021 SneakStore</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
  </html>