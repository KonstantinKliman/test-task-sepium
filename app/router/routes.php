<?php

return [
    ['GET', '/', ['PageController', 'index']],
    ['GET', '/register', ['PageController', 'registerPage']],
    ['GET', '/login', ['PageController', 'loginPage']],
    ['GET', '/users', ['PageController', 'usersPage']],

    ['GET', '/auth/current-user', ['AuthController', 'getCurrentUser']],
    ['POST', '/auth/register', ['AuthController', 'register']],
    ['POST', '/auth/login', ['AuthController', 'login']],
    ['POST', '/auth/logout', ['AuthController', 'logout']],

    ['GET', '/users/get-all', ['UserController','getAllUsers']],
    ['POST', '/users', ['UserController', 'createUser']],
    ['POST', '/users/delete',['UserController', 'deleteUser']]
];