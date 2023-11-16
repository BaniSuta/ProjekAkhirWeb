<header>
    <img src="../img/logo.png" width="100px" alt="">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#product">Product</a></li>
        <?php if (isset($_SESSION["login"])) : ?>
            <?php if ($_SESSION["type"] == "user") { ?>
                <li><a href="history.php">History</a></li>
            <?php } else { ?>
                <li><a href="indexAdmin.php">Admin</a></li>
            <?php }  ?>
        <?php endif ?>
    </ul>
    <div class="cont-btn">
        <button id="toggle-mode" class="btn secondary">Change Mode</button>
        <?php if (!isset($_SESSION["login"])) { ?>
            <a class="btn success" href="login.php">Sign In</a>
        <?php } else { ?>
            <a class="btn danger" href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Sign Out?')">Sign Out</a>
        <?php } ?>
    </div>
</header>