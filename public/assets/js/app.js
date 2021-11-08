
//say a user is logged out
if ($("#disconnection")) {
    $("#disconnection").click(function (e) {
        sessionStorage.role = "";
        sessionStorage.session = "close";
    });
}

// Disconnects the user after 6 hours
if (sessionStorage.role !== "2" && sessionStorage.role !== "") {
    setTimeout(function () {
        sessionStorage.role = "";
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
            if (sessionStorage.role !== "2" || sessionStorage.role !== "") {
                $("#homeLinks").append(`
                <div class="flexColumn edit">
                    <a href="../index.php?controller=link&action=update&id=${response[$i].id}"><i class="fas fa-pen-square"></i></a>
                    <a href="../index.php?controller=link&action=delete&id=${response[$i].id}"><i class="fas fa-trash-alt"></i></a>
                </div>
                `);
            }
        }

        $(".containerLink").click(function(){
            var x = $(this).attr("id");
            console.log($(".buttonLink"));
        });

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