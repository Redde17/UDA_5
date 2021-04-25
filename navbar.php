<!-- NavBar temporanea -->
<div style="height:50px;"></div>
<div class="d-flex" style="background-color: #77B748; border: 1px solid #5F923A; height: 50px; width: 100%; margin: 0px; padding: 0px; position: fixed; z-index: 9; top: 0px;">
    <div class="ml-1"><a href="index.php"><img src="resources\Logo.png" alt="LOGO" height="46px" width="46px"></a></div>

    <?php
    if (isset($_SESSION["logged"])) {
        echo '<div class="ml-5"><a href="user.php">Libreria personale</a></div>
                <div class="ml-5"><a href="cleanSession.php">Logout</a></div>';
        if ($_SESSION["email"] == "root@root.rt") {
            $_SESSION["admin"] = true;
            echo '<p class="ml-2" style="color: red;"><a href="modifica_inserimento.php">InserireLibro</a></p>
                    <p class="ml-2" style="color: red;">Account admin attivo</p>';
        }
    } else {
        echo '<div class="ml-5" style="cursor: pointer;"><span class="iconify" data-icon="fa-solid:user-alt" data-inline="false" style="color: white;" onclick="Form()"></span></div>';
    }
    ?>
</div>