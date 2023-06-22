<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="img.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://kit.fontawesome.com/f70d9d4b9e.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/checkloi.js"></script>
    <link rel="stylesheet"  href="../css/admin.css">
</head>

<body>
    <div class="all">
        <div class="navbar">
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="fas fa-bars" id="iconbars" onclick="collapseSidebar()"></i>
                    </a>
                </li>
            </ul>
            <form class="navbar-search">
                <input type="text" name="Search" class="navbar-search-input" placeholder="What you looking for...">
                <i class="fas fa-search"></i>
            </form>
            <ul class="navbar-nav nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link">
                        <i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
                        <span class="navbar-badge">1</span>
                    </a>

                </li>
                <li class="nav-item avt-wrapper">
                    <div class="avt dropdown">
                        <img src="../img/img.jpg" alt="User image" class="dropdown-toggle" data-toggle="user-menu">
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar">
        <?php require('./leftmenu.php'); ?>
        </div>
        <div class="content">
            <?php require('./content.php'); ?>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>

</html>