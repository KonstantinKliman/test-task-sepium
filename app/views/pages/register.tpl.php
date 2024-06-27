<?php require_once 'includes/header.tpl.php' ?>
<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="border p-4 rounded w-25">
            <form method="POST" action="auth/register">
                <h3 class="text-center">Register</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Login</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
<?php require_once 'includes/footer.tpl.php' ?>