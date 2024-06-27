<?php

return [
    ['GET', '/', ['PageController', 'index']],

    ['GET', '/register', ['PageController', 'registerPage']],
    ['GET', '/login', ['PageController', 'loginPage']],
    ['POST', '/auth/register', ['AuthController', 'register']],
    ['POST', '/auth/login', ['AuthController', 'login']],
    ['POST', '/auth/logout', ['AuthController', 'logout']],

    ['GET', '/users', ['PageController', 'usersPage']],
    ['GET', '/users/get-all', ['UserController','getAll']],
    ['POST', '/users', ['UserController', 'create']],
    ['GET', '/auth/current-user', ['AuthController', 'getCurrentUser']],
    ['POST', '/users/delete',['UserController', 'deleteUser']]
];