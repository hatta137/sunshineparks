<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SunshineParks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/contactBox.css">
    <link rel="stylesheet" href="../assets/css/imprint.css">
    <link rel="stylesheet" href="../assets/css/privacy.css">
    <link rel="stylesheet" href="../assets/css/documentation.css">
    <link rel="stylesheet" href="../assets/css/rental.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/mediaQuerrys.css">
    <link rel="stylesheet" href="../assets/css/authentication.css">
    <link rel="stylesheet" href="../assets/css/employee.css">
    <link rel="stylesheet" href="../assets/css/account.css">




    <link rel="icon" type="image/png" href="../assets/graphics/LogoIconNB.png" >
</head>
<body>


<header class="header">
    <?php
    require_once __DIR__.'/../../models/person.php';
    if(isset($_SESSION['person'])){
        $person = new Person($_SESSION['person']);
        $username = "Hallo, ".$person->FirstName."!";
    }else{
        $username = "Account";
    }
    ?>

    <input type="checkbox" id="nav-check">

        <a href="index.php" class="logo"><img id="Logo" src="../assets/graphics/LogoNB_S.png" alt="LogoSP"></a>
        <div class="headline">
            <a href="index.php"><h1>SunshineParks</h1></a>
        </div>


    <div class="nav-btn">
        <label class="hamburger" for="nav-check">&#9776;</label>
    </div>
    <div class="nav-links">
        <a href="#home" class="active">About</a>
        <a href="#news">Help</a>
        <a href="index.php?page=authentication&view=authenticationGuest"><?=$username?></a>
    </div>


</header>

