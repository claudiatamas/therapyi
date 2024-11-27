<?php
ob_start();
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

include("navbar_consilier.php");

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");


if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $feedback = mysqli_real_escape_string($db, $_POST['feedback']);

 
    $updateSql = "UPDATE istoric_teste SET feedback = '$feedback' WHERE id = $id";
    mysqli_query($db, $updateSql);

    header("Location: istoric_test.php");
    exit();
}


if (isset($_GET['selectedId'])) {
    $selectedId = $_GET['selectedId'];

    $sql = "SELECT it.*, u.nume_utilizator AS nume_student, t.nume 
            FROM istoric_teste it
            INNER JOIN utilizatori u ON it.utilizatori_id = u.id
            INNER JOIN teste t ON it.teste_id = t.id
            WHERE it.id = $selectedId";

    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nume_student = $row['nume_student'];
        $test = $row['nume'];
        $punctaj = $row['punctaj_final'];
        $feedback = $row['feedback'];
        ?>
        
        <!doctype html>
        <html class="no-js" lang="en" dir="ltr">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Consiliere Studenți</title>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <link rel="stylesheet" href="css/foundation.css">
            <link rel="stylesheet" href="css/app.css">
        </head>
        <style>
            .grid-container {
                margin-left: 20vh;
                margin-right: 20vh;
            }

            .center {
text-align: center;
}
.form-container {
            margin-top: 20px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input[type=text],
        .form-container textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        .form-container input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .form-container input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
    <body>
        <div class="grid-container">
            <h2 class="text-center">Modifică istoricul</h2>
            <div class="form-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="nume_student">Nume student:</label>
                    <input type="text" id="nume_student" name="nume_student" value="<?php echo $nume_student; ?>" disabled>
                    <label for="test">Test:</label>
                    <input type="text" id="test" name="test" value="<?php echo $test; ?>" disabled>
                    <label for="punctaj">Punctaj final:</label>
                    <input type="text" id="punctaj" name="punctaj" value="<?php echo $punctaj; ?>" disabled>
                    <label for="feedback">Feedback:</label>
                    <textarea id="feedback" name="feedback"><?php echo $feedback; ?></textarea>
                    <input type="hidden" name="id" value="<?php echo $selectedId; ?>">
                    <input type="submit" name="update" value="Actualizează">
                </form>
            </div>
        </div>
    </body>
    </html>

    <?php
} else {
    echo "Nu s-a găsit niciun istoric cu ID-ul specificat.";
} 
} 
  mysqli_close($db);
  ?>
