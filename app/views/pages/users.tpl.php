<?php require_once 'includes/header.tpl.php' ?>
    <body>
    <header>
        <form action="auth/logout" method="POST">
            <div class="container-fluid my-2 d-flex justify-content-end align-items-center">
                <p class="m-0">
                    <?php
                    session_start();
                    echo $_SESSION['name'];
                    ?>
                </p>
                <button type="submit" class="btn btn-sm btn-secondary mx-2" >Logout</button>
            </div>
        </form>
    </header>
    <div class="container-fluid vh-100 d-flex justify-content-start align-items-center flex-column create-user-form">
        <div class="w-100 my-2">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name(Login)</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="users">
                </tbody>
            </table>
        </div>
    </div>
    <script src="/public/js/libs/jquery-3.7.1.js" type="text/javascript"></script>
    <script src="/public/js/script.js" type="text/javascript"></script>
    </body>
<?php require_once 'includes/footer.tpl.php' ?>