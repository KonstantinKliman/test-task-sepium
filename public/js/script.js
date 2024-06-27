$(document).ready(function () {
    function fetchAllUsers(currentUser) {
        $.ajax({
            url: 'users/get-all',
            method: 'GET',
            success: function (response) {
                var usersContainer = $('.users');
                var users = response;
                users.forEach(function (user) {
                    if (currentUser.id !== user.id) {
                        usersContainer.append($("<tr>", {
                            id: "userId" + user.id
                        })
                            .append($("<th>", {
                                "scope": "row",
                                text: user.id
                            }))
                            .append($("<td>", {
                                    text: user.name
                                }
                            ))
                            .append($("<td>", {
                                    text: user.email
                                }
                            ))
                            .append($("<td>").append(currentUser.role === 'admin' ? $("<button>", {
                                    class: 'btn btn-sm btn-danger',
                                    text: 'Delete',
                                    click: function () {
                                        $.ajax({
                                            url: '/users/delete',
                                            method: 'POST',
                                            data: {
                                                id: user.id
                                            },
                                            success: function () {
                                                $("#userId" + user.id).remove();
                                            },
                                            error: function (error) {
                                                console.error(error);
                                            }
                                        })
                                    }
                                }) : '')
                            ))
                    }
                })
            },
            error: function (error) {
                console.error(error);
            }
        })
    }


    $('.create-user').submit(function (event) {
        event.preventDefault();
        var data = $('.create-user')[0];
        var formData = new FormData(data);
        $.ajax({
            url: '/users',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var user = response;
                var lastUserId = --user.id;
                var lastUserRow = $("#userId" + lastUserId);
                lastUserRow.after($("<tr>", {
                    id: "user" + user.id
                })
                    .append($("<th>", {
                        "scope": "row",
                        text: user.id
                    }))
                    .append($("<td>", {
                            text: user.name
                        }
                    ))
                    .append($("<td>", {
                            text: user.email
                        }
                    ))
                    .append($("<td>")
                        .html("<button class=\"btn btn-sm btn-danger mx-1\">Delete</button>")))
            },
            error: function (error) {
                console.error(error);
            }
        })
    })

    function getCurrentUser() {
        // проверяем роль пользователя
        $.ajax({
            url: 'auth/current-user',
            method: 'GET',
            success: function (response) {
                var user = response;
                var userRole = user.role;
                if (userRole === 'admin') {
                    $('.create-user-form').prepend(
                        "<div class=\"w-25 rounded border p-4 my-2 create-user-form\">\n" +
                        "<form class=\"create-user\">\n" +
                        "<h3 class=\"text-center\">Add user</h3>\n" +
                        "<div class=\"mb-3\">\n" +
                        "<label for=\"email\" class=\"form-label\">Email</label>\n" +
                        "<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" name=\"email\">\n" +
                        "</div>\n" +
                        "<div class=\"mb-3\">\n" +
                        "<label for=\"name\" class=\"form-label\">Login</label>\n" +
                        "<input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Login\" name=\"name\">\n" +
                        "</div>\n" +
                        "<div class=\"mb-3\">\n" +
                        "<label for=\"password\" class=\"form-label\">Password</label>\n" +
                        "<input type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Password\" name=\"password\">\n" +
                        "</div>\n" +
                        "<button type=\"submit\" class=\"btn btn-success w-100\">Create</button>\n" +
                        "</form>\n" +
                        "</div>")
                }
                //забираем пользователей
                fetchAllUsers(user);
            },
            error: function (error) {
                console.error(error);
            }
        })
    }

    getCurrentUser();

});