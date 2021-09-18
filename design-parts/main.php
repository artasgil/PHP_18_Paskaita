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

<div class="row">
    <div class="col-lg-3">
        <h3>Šoninė juosta/Sidebar</h3>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <?php $sql = "SELECT * FROM puslapiai
            ORDER BY puslapiai.ID DESC";

            $result = $conn->query($sql);

            while ($pages = mysqli_fetch_array($result)) {
            ?>
                <div class="card col-lg-4" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pages["pavadinimas"] ?></h5>
                        <p class="card-text"><?php echo $pages["santrauka"] ?></p>
                        <a href="puslapiai.php?href=<?php echo $pages["nuoroda"]; ?>" class="btn btn-primary">Go somewhere</a>
                        <?php if ($row["teises_ID"] == 1) { ?><a href="edit.php?edit=<?php echo $pages["ID"]; ?>" >Edit</a><?php } ?>
                    </div>
                </div>

            <?php } ?>

            </div>
    </div>
        </div>