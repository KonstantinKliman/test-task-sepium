<?php require_once 'includes/header.tpl.php' ?>
    <body>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="">
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="/users" class="btn btn-sm btn-outline-secondary mx-2">Users</a>';
                    echo '<a href="/logout" class="btn btn-sm btn-outline-secondary mx-2">Logout</a>';
                } else {
                    echo '<a href="/login" class="btn btn-sm btn-outline-secondary mx-2">Login</a>';
                    echo '<a href="/register" class="btn btn-sm btn-outline-secondary mx-2">Register</a>';
                }
                ?>
            </div>
        </div>
    </body>
<?php require_once 'includes/footer.tpl.php' ?>