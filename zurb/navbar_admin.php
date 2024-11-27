<?php
$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");


$sql = "SELECT m.nume_meniu, o.nume_optiune, o.url_optiune
        FROM meniuri m
        INNER JOIN optiuni_meniu o ON m.meniu_id = o.meniu_id";

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">


</head>
<body>
<?php if (isset($meniuri['admin'])) : ?>
    <div class="top-bar" id="responsive-menu">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="logo"><img src="images/logo.png"></li>

                <?php foreach ($meniuri['admin'] as $optiune) : ?>
                    <li><a href="<?= $optiune["url"] ?>"><?= $optiune["nume"] ?></a></li>
                <?php endforeach; ?>

            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="is-dropdown-submenu-parent">
                    <a href="#"><img src="images/admin.jpg" class="img-profil"></a>
                    <ul class="menu">
                    <li><a href="login.php?logout=true">Deconectează-te</a></li>
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