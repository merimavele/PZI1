<?php
session_start();
if (!isset($_SESSION["token"])) header("Location: login.php");
include("db.php"); 
include("korisnikclass.php");

if (isset($_GET["akcija"]) && $_GET["akcija"] == "pobrisi") {
  Korisnik::pobrisi($_GET["id"]);
}

$id = $_SESSION["token"];
$upit = "SELECT * FROM korisnik WHERE ID=".$id;

$rezultat = mysqli_query($konekcija, $upit);
$prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);
$naslov = "Dobrodošli na sustav " . $prijavljeni_korisnik["ime"]. " " .$prijavljeni_korisnik["prezime"];
include("static/header.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Dobrodošli!</title>
    <style>
        html, body {
            height:100% !important;
        }
    </style>
  </head>
  <body>
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col shadow p-5">
                <h3>Dobrodošao <?php echo ($prijavljeni_korisnik["ime"]. " " .$prijavljeni_korisnik["prezime"]) ?> na sustav</h3>
                <a class="btn btn-light float-right" href="logout.php">Odjavite se</a>
            </div>
<div class="container h-100">
    <div class="row shadow p-5">
        <div class="col-12 mb-5">
            <h3 class="float-left">Administracija korisnika</h3>
            <a title="Odjavite se sa sustava" data-toggle="tooltip" data-placement="top"  class="btn btn-light float-right mt-1" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
        <div class="col-12">
          <table class="table table-striped table-hover">
            <tr>
              <th>#ID</th>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>Akcije</th>
            </tr>
            <?php
              foreach(Korisnik::dajSve() as $korisnik):
            ?>
            <tr>
              <td><?= $korisnik["ID"] ?></td>
              <td><?= $korisnik["ime"] ?></td>
              <td><?= $korisnik["prezime"] ?></td>
              <td><?= $korisnik["email"] ?></td>
              <td>
                <a class="btn btn-danger" href="index.php?akcija=pobrisi&id=<?= $korisnik["ID"] ?>"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html> 

</div>
<?php
include("static/header.php");
?>