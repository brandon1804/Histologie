<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="homepage.php"><img src="./css/img/histologie.png" alt="logo" style="width: 200px"></a>
    
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
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href="homepage.php"><b>Home</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href=""><b>Quiz</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href=""><b>Images</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href=""><b>Profile</b></a></li>
                <li class="nav-item active"><a class="nav-link" style="color: #E11A7A" href=""><b>Log Out</b></a></li>
                <?php } ?>
        </ul>
    </div>