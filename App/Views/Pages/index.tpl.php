<?php session_start(); ?>
<?php require_once 'Includes/header.tpl.php' ?>
    <body>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="d-flex flex-row">
                <?php
                if (isset($_SESSION['id'])) {
                    echo '<a href="/users" class="btn btn-sm btn-outline-secondary mx-2">Users</a>';
                    echo '<form method="POST" action="/auth/logout"><button type="submit" class="btn btn-sm btn-outline-secondary mx-2">Logout</button></form>';
                } else {
                    echo '<a href="/login" class="btn btn-sm btn-outline-secondary mx-2">Login</a>';
                    echo '<a href="/register" class="btn btn-sm btn-outline-secondary mx-2">Register</a>';
                }
                ?>
            </div>
        </div>
    </body>
<?php require_once 'Includes/footer.tpl.php' ?>