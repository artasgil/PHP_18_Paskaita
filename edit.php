<?php require_once("connections.php"); ?>
<?php if (!isset($_COOKIE["prisijungta"])) {
    header("Location: prisijungimas.php");
} elseif (isset($_COOKIE["prisijungta"])) {
    $teises_id = explode("|", $_COOKIE["prisijungta"]);
    $sql = "SELECT * FROM vartotojai WHERE teises_ID = $teises_id[3]";
    $result_teises = $conn->query($sql);
    if ($result_teises->num_rows == 1 && $result_teises == $result_teises) {
        $row = mysqli_fetch_assoc($result_teises);
    } else {
        echo "Nepatvirtintas klientas";
    }
} ?>

<?php if ($row["teises_ID"] == 1) { ?>
    <?php
    if (isset($_GET["edit"])) {
        $id = $_GET["edit"];
        $rezultatas = $conn->query("SELECT * FROM `puslapiai` WHERE `ID` = '$id'");

        $pages = $rezultatas->fetch_array();

        $turinys = $pages['turinys'];
        $santrauka = $pages['santrauka'];
    }

    if (isset($_GET["atnaujinti"])) {
        $id = $_GET["id"];
        $turinys = $_GET["turinys"];
        $santrauka = $_GET["santrauka"];

        if ($conn->query("UPDATE `puslapiai` SET `turinys`='$turinys', `santrauka`='$santrauka' WHERE `ID` = $id")) {
            $zinutegerai = "Įrašas redaguotas sėkmingai";
        } else {
            $zinuteblogai = "Kažkas ivyko negerai";
        }
    }

    if (isset($_GET["back"])) {
        header("Location: index.php");
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Puslapio redagavimo forma</title>
        <?php require_once("includes.php"); ?>
        <style>
            h1 {
                text-align: center;
            }

            .hide {
                display: none;
            }
        </style>
    </head>

    <body>
        <script>
            $(document).ready(function() {
                $('#turinys, #santrauka').summernote({
                    height: 350, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: true // set focus to editable area after initializing summernote
                });
            });
        </script>
        <div class="container">
            <h1>Puslapio redagavimo forma</h1>
            <form action="edit.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <div class="form-group">
                    <label for="santrauka">Santrauka:</label>
                    <textarea class="form-control" id="santrauka" type="text" name="santrauka"><?php echo $santrauka ?></textarea>
                </div>
                <div class="form-group">
                    <label for="turinys">Turinys:</label>
                    <textarea class="form-control" id="turinys" type="text" name="turinys"><?php echo $turinys ?></textarea>
                </div>

                <button class="btn btn-primary" type="submit" name="atnaujinti">Atnaujinti</button>
                <button class="btn btn-primary" type="back" name="back">Atgal</button>

                <?php if (isset($zinuteblogai)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $zinuteblogai; ?>
                    </div>
                <?php } ?>
                <?php if (isset($zinutegerai)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $zinutegerai; ?>
                    </div>
                <?php } ?>
        </div>
        </form>
    </body>

    </html>
<?php } ?>