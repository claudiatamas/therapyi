<?php
ob_start();


if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");
$user_id = $_SESSION['user_id'];

$sql = "SELECT m.nume_meniu, o.nume_optiune, o.url_optiune, u.imagine
FROM meniuri m
INNER JOIN optiuni_meniu o ON m.meniu_id = o.meniu_id
INNER JOIN tip_utilizator_meniu tum ON m.meniu_id = tum.meniu_id
INNER JOIN utilizatori u ON tum.tip_utilizator_id = u.tip_utilizator_id
WHERE u.id = $user_id";

$result = $db->query($sql);


if ($result->num_rows > 0) {
    
    $meniuri = array();

    
    while ($row = $result->fetch_assoc()) {
        $meniu = $row["nume_meniu"];
        $optiune = array("nume" => $row["nume_optiune"], "url" => $row["url_optiune"]);

     
        if (array_key_exists($meniu, $meniuri)) {
            array_push($meniuri[$meniu], $optiune);
        } else {
            $meniuri[$meniu] = array($optiune);
        }
        $imagine = $row["imagine"];
    }
} else {
    echo "Nu s-au găsit meniuri sau opțiuni.";
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consiliere Studenți</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
<body>
   
<?php if (isset($meniuri['consilier'])) : ?>

    <div class="top-bar" id="responsive-menu">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="logo"><img src="images/logo.png"></li>
                <?php foreach ($meniuri['consilier'] as $optiune) : ?>
                    <?php if ($optiune["nume"] != "Modifică profilul" && $optiune["nume"] != "Mesaje" && $optiune["nume"] != "Deconectează-te") : ?>
                        <li><a href="<?= $optiune["url"] ?>"><?= $optiune["nume"] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
                <li>
                    <a href="mesaje-consilieri.php" class="button-badge">
                      <i class="fa fa-envelope"></i>
                     
                    </a>
                </li>
                <li class="is-dropdown-submenu-parent">
                <a href="#"><img src="<?= $imagine ?>" class="img-profil"></a>
                    <ul class="menu">
                        <?php foreach ($meniuri['consilier'] as $optiune) : ?>
                            <?php if ($optiune["nume"] == "Modifică profilul" || $optiune["nume"] == "Mesaje" || $optiune["nume"] == "Deconectează-te") : ?>
                                <li><a href="<?= $optiune["url"] ?>"><?= $optiune["nume"] ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<?php endif; ?>


<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  
  </body>
</html>