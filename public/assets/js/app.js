
//say a user is logged out
if ($("#disconnection")) {
    $("#disconnection").click(function (e) {
        sessionStorage.role = "";
        sessionStorage.id = "";
        sessionStorage.session = "close";
    });
}
else if ($("#deleteUser")) {
    $("#deleteUser").click(function (e) {
        sessionStorage.role = "";
        sessionStorage.id = "";
        sessionStorage.session = "close";
    });
}

// Disconnects the user after 6 hours
if (sessionStorage.session === "open") {
    setTimeout(function () {
        sessionStorage.role = "";
        sessionStorage.id = "";
        sessionStorage.session = "close";
        window.location.href = "../assets/php/disconnection.php";
    }, 21600000);
}

// display all links
$.get("../../api/link", function (response) {
    for ($i = 0; $i < response.length; $i++) {
        $("#homeLinks").append(`
        <div class="linkContainer" >
            <form method="post" class="width100">
                <input id="id" type="hidden" name="id" value='${response[$i].id}'>
                <input id="href" type="hidden" name="href" value='${response[$i].href}'>
                <input id="target" type="hidden" name="target" value='${response[$i].target}'>
                <input id="click" type="hidden" name="click" value='${response[$i].click}'>
                <div id="container1" class="flexColumn width100">
                    <div id="containerPicture">
                        <img src="${response[$i].image}" alt='${response[$i].title}'>
                    </div>
                    <div id="containerLink" class="flexCenter">
                        <input id="click` + [$i] + `" class="buttonLink" type="submit" name="send" value='${response[$i].name}'>
                    </div>
                </div>
            </form>
        </div>
        `);

        // checks if the role of the user who is logged in is different from 2
        if (sessionStorage.role) {
            if (sessionStorage.role === "1" || sessionStorage.role === "3") {
                $("#homeLinks").append(`
                <div class="flexColumn edit">
                    <a href="../index.php?controller=link&action=update&id=${response[$i].id}"><i class="fas fa-pen-square"></i></a>
                    <a href="../index.php?controller=link&action=delete&id=${response[$i].id}"><i class="fas fa-trash-alt"></i></a>
                </div>
                `);
            }
        }

        // When I click on a link I get the link id and redirect the user to the correct link
        $("#click" + $i).click(function (e) {
            $x = $(this).attr("id");
            $recupId = $x.replace("click", "");
            $href = response[parseInt($recupId)].href;
            $target = response[parseInt($recupId)].target;

            // add a click
            e.preventDefault();
            $id1 = response[parseInt($recupId)].id;
            $href1 = response[parseInt($recupId)].href;
            $target1 = response[parseInt($recupId)].target;
            $click1 = response[parseInt($recupId)].click;

            if ($id1 && $href1 && $target1 && $click1) {
                $xhr = new XMLHttpRequest();
                $xhr.onload = function () {
                    $response = JSON.parse($xhr.responseText);
                    window.open($href, $target);
                }
                $linkData = {
                    'id': $id1,
                    'href': $href1,
                    'target': $target1,
                    'click': $click1,
                }
                $xhr.open('PUT', '../../api/link');
                $xhr.setRequestHeader('Content-Type', 'application/json');
                $xhr.send(JSON.stringify($linkData));
            }
        });

    }
});

// Display all links of a user
$.get("../../api/link", function (response) {
    for ($i = 0; $i < response.length; $i++) {
        if (sessionStorage.id) {
            if (sessionStorage.id == response[$i].user['id']) {
                $("#myLink").append(`
                <div class="linkContainer" >
                    <form method="post" class="width100">
                        <input id="id" type="hidden" name="id" value='${response[$i].id}'>
                        <input id="href" type="hidden" name="href" value='${response[$i].href}'>
                        <input id="target" type="hidden" name="target" value='${response[$i].target}'>
                        <input id="click" type="hidden" name="click" value='${response[$i].click}'>
                        <div id="container1" class="flexColumn width100">
                            <div id="containerPicture">
                                <img src="${response[$i].image}" alt='${response[$i].title}'>
                            </div>
                            <div id="containerLink" class="flexCenter">
                                <input id="click` + [$i] + `" class="buttonLink" type="submit" name="send" value='${response[$i].name}'>
                            </div>
                        </div>
                    </form>
                </div>
                `);
            }
        }

        // checks if the role of the user who is logged in is different from 2
        if (sessionStorage.id) {
            if (sessionStorage.id == response[$i].user['id']) {
                $("#myLink").append(`
                <div class="flexColumn edit">
                    <a href="../index.php?controller=link&action=update&id=${response[$i].id}"><i class="fas fa-pen-square"></i></a>
                    <a href="../index.php?controller=link&action=delete&id=${response[$i].id}"><i class="fas fa-trash-alt"></i></a>
                </div>
                `);
            }
        }
        $("#click" + $i).click(function (e) {
            $x = $(this).attr("id");
            $recupId = $x.replace("click", "");
            $href = response[parseInt($recupId)].href;
            $target = response[parseInt($recupId)].target;
            window.open($href, $target);
        });
    }
});

// create a link
if ($("#createLink")) {
    $("#createLink").click(function (e) {
        e.preventDefault();
        $href = $("#href").val();
        $title = $("#title").val();
        $target = $("#target").val();
        $name = $("#name").val();
        $user_fk = $("#user_fk").val();

        if ($href && $title && $target && $name && $user_fk) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index?success=0&message=" + $response.message;
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=add&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=add&error=2&message=" + $response.message;
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=link&action=add&error=3&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'href': $href,
                'title': $title,
                'target': $target,
                'name': $name,
                'user_fk': $user_fk
            }
            $xhr.open('POST', '../../api/link');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

// update a link
if ($("#updateLink")) {
    $("#updateLink").click(function (e) {
        e.preventDefault();
        $id = $("#id").val();
        $href = $("#href").val();
        $title = $("#title").val();
        $target = $("#target").val();
        $name = $("#name").val();

        if ($id && $href && $title && $target && $name) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index.php?success=0&message=" + $response.message;
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=2&message=" + $response.message;
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=3&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'id': $id,
                'href': $href,
                'title': $title,
                'target': $target,
                'name': $name,
            }
            $xhr.open('PUT', '../../api/link');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

// delete a link
if ($("#deleteLink")) {
    $("#deleteLink").click(function (e) {
        e.preventDefault();
        $id = $("#id").val();

        if ($id) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index.php?success=0&message=" + $response.message;
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=delete&id=" + $id + "&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=delete&id=" + $id + "&error=2&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'id': $id
            }
            $xhr.open('DELETE', '../../api/link');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

// update info of user
if ($("#updateUser")) {
    $("#updateUser").click(function (e) {
        e.preventDefault();
        $id = $("#id").val();
        $firstname = $("#firstname").val();
        $lastname = $("#lastname").val();
        $email = $("#email").val();

        if ($id && $firstname && $lastname && $email) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index.php?controller=user&action=account&success=0&message=" + $response.message;
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=user&action=update&id=" + $id + "&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=user&action=update&id=" + $id + "&error=2&message=" + $response.message;
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=user&action=update&id=" + $id + "&error=3&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'id': $id,
                'firstname': $firstname,
                'lastname': $lastname,
                'email': $email
            }
            $xhr.open('PUT', '../../api/user');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

// update password of user
if ($("#updatePassUser")) {
    $("#updatePassUser").click(function (e) {
        e.preventDefault();
        $id = $("#id").val();
        $passN = $("#passN").val();
        $pass = $("#pass").val();
        $passR = $("#passR").val();

        if ($id && $passN && $pass && $passR) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index.php?controller=user&action=account&success=0&message=" + $response.message;
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=user&action=updatePass&id=" + $id + "&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=user&action=updatePass&id=" + $id + "&error=2&message=" + $response.message;
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=user&action=updatePass&id=" + $id + "&error=3&message=" + $response.message;
                    }
                    if ($response.error === "error4") {
                        window.location.href = "index.php?controller=user&action=updatePass&id=" + $id + "&error=4&message=" + $response.message;
                    }
                    if ($response.error === "error5") {
                        window.location.href = "index.php?controller=user&action=updatePass&id=" + $id + "&error=5&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'id': $id,
                'passN': $passN,
                'pass': $pass,
                'passR': $passR
            }
            $xhr.open('PUT', '../../api/user');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

// delete a user
if ($("#deleteUser")) {
    $("#deleteUser").click(function (e) {
        e.preventDefault();
        $id = $("#id").val();

        if ($id) {
            $xhr = new XMLHttpRequest();
            $xhr.onload = function () {
                $response = JSON.parse($xhr.responseText);
                if ($response.hasOwnProperty('error') && $response.hasOwnProperty('message')) {
                    if ($response.error === "success") {
                        window.location.href = "index.php?success=2&message=" + $response.message;
                                            }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=user&action=delete&id=" + $id + "&error=1&message=" + $response.message;
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=user&action=delete&id=" + $id + "&error=2&message=" + $response.message;
                    }
                }
            }
            $linkData = {
                'id': $id
            }
            $xhr.open('DELETE', '../../api/user');
            $xhr.setRequestHeader('Content-Type', 'application/json');
            $xhr.send(JSON.stringify($linkData));
        }
    });
}

//Check if the url has to search for "message", if it is the case I display the modal window and I add the message and if I click on close modal I close the modal window
$searchParams = new URLSearchParams(window.location.search);
$param = $searchParams.get("message");
if ($searchParams.get("message")) {
    $("#modal").css("display", "flex");
    $("#modal").html($param + "<button id='closeModal'><i class='fas fa-times'></i></button>");
    $("#closeModal").click(function () {
        $("#modal").css("display", "none");
    });
    setTimeout(function () {
        $("#modal").css("display", "none");
    }, 5000);
}

