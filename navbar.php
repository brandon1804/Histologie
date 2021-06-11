<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.php"><img src="./css/img/histologie.png" alt="logo" style="width:180px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['username'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php" ><b>Login</b></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="signup.php"><b>Sign up</b></a>
                </li>
            <?php } else { ?>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="learn.php"><b>Home</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="quiz.php"><b>Quiz</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="images.php"><b>Images</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="profile.php"><b>Profile</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="logout.php"><b>Log Out</b></a></li>
                <?php } ?>
        </ul>
    </div>
</nav>