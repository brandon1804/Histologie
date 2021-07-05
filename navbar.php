<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php"><img src="./css/img/histologie.png" alt="logo" style="width: 100px"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="signinpage.php" style="color: #E11A7A"><b>Login</b></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="createAccount.php" style="color: #E11A7A"><b>Sign up</b></a>
                </li>
            <?php } else { ?>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="learnPage.php"><b>Home</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="quizzesPage.php"><b>Quiz</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href=""><b>Images</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="profilePage.php"><b>Profile</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="doLogout.php"><b>Log Out</b></a></li>
                <?php } ?>
        </ul>
    </div>
</nav>
