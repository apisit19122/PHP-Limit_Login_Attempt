<?php 

session_start();

if(!isset($_SESSION['IS_LOGIN'])){
    echo "<script>window.location.href='index.php';</script>";
} else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>home</title>
</head>

<body>
    <div class="container">
        <h1 class="display-4 mt-4">Welcome, <?php echo $_SESSION['username'];?></h1>
        <hr>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo repudiandae, voluptates laboriosam aliquam aut nostrum totam repellendus enim iusto nulla quod animi minus beatae esse recusandae excepturi illo ea veritatis quo voluptatum! Nesciunt eligendi doloribus ipsam, non doloremque asperiores explicabo numquam, sunt nam alias a. Doloribus magnam perferendis dolorum quis et aperiam porro voluptatibus pariatur vel. Mollitia aliquid sit aperiam officia inventore sunt quibusdam. Sit adipisci expedita minus id maiores eos aut sunt corrupti et aliquid, impedit cumque a architecto ipsum ipsa beatae optio ratione enim obcaecati blanditiis atque natus fuga. Perferendis harum quis qui architecto, voluptas reprehenderit molestias vero!</p>
        <a href="logout.php" class="btn btn-danger">logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>

<?php } ?>