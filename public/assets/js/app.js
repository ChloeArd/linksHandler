

if ($("#disconnection")) {
    $("#disconnection").click(function (e) {
        sessionStorage.session = "non";
    });
}

// display all links
$.get("../../api/link", function (response) {
    for ($i = 0; $i < response.length; $i++) {
        $("#homeLinks").append(`
        <form method="post" action="" id="linkContainer">
            <input id="id" type="hidden" name="id" value='${response[$i].id}'>
            <input id="href" type="hidden" name="href" value='${response[$i].href}'>
            <input id="target" type="hidden" name="target" value='${response[$i].target}'>
            <input id="click" type="hidden" name="click" value='${response[$i].click}'>
                <div id="container1" class="flexColumn width100">
                    <div id="containerPicture">
                        <img src="${response[$i].image}" alt='${response[$i].title}'>
                    </div>
                    <div id="containerLink" class="flexCenter">
                        <input id="click${response[$i].id}" class="buttonLink" type="submit" name="send" value='${response[$i].name}'>
                    </div>
                </div>
            </form>
            `);

        if(response[$i].user.role.id !== "2" && sessionStorage.session === "ok") {
            $("#homeLinks").append(`
            <div class="flexColumn edit">
                <a href="../index.php?controller=link&action=update&id=${response[$i].id}"><i class="fas fa-pen-square"></i></a>
                <a href="../index.php?controller=link&action=delete&id=${response[$i].id}"><i class="fas fa-trash-alt"></i></a>
            </div>
        `);
        }

    }
});

// create a link
if ($("#createLink")) {
    $("#createLink").click(function (e) {

        /*$.post("../../api/link", $data = {
            href : $("#href").val(),
            title : $("#title").val(),
            target : $("#target").val(),
            name : $("#name").val(),
            user_fk : $("#user_fk").val()
        },  function (status) {
            alert($data.href);
            if (status.error === "success") {
                window.location.href = "index?success=0";
            }
            if (status.error === "error1") {
                window.location.href = "index.php?controller=link&action=add&error=1";
            }
            if (status.error === "error2") {
                window.location.href = "index.php?controller=link&action=add&error=2";
            }
            if (status.error === "error3") {
                window.location.href = "index.php?controller=link&action=add&error=3";
            }
        }, "json");*/

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
                        window.location.href = "index?success=0";
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=add&error=1";
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=add&error=2";
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=link&action=add&error=3";
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
                        window.location.href = "index?success=0";
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=1";
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=2";
                    }
                    if ($response.error === "error3") {
                        window.location.href = "index.php?controller=link&action=update&id=" + $id + "&error=3";
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
                        window.location.href = "index?success=0";
                    }
                    if ($response.error === "error1") {
                        window.location.href = "index.php?controller=link&action=delete&id=" + $id + "&error=1";
                    }
                    if ($response.error === "error2") {
                        window.location.href = "index.php?controller=link&action=delete&id=" + $id + "&error=2";
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