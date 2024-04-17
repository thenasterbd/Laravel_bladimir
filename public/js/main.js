var url = "http://127.0.0.1:8000";

$(document).ready(function () {
    console.log("Document loaded");

    $(".btn-like, .btn-dislike").css("cursor", "pointer");

    //BTN LIKE
    $(".btn-like").on("click", function () {
        const image_id = $(this).data("id");
        $.ajax({
            url: url + "/toggle_like/" + image_id,
            type: "GET",
            success: function (response) {
                updateCountLikes(response, image_id, response.status);
            },
        });
    });

    function updateCountLikes(response, image_id, mensaje) {
        console.log(image_id, " ", mensaje);

        if (mensaje === "like") {
            $(".like_image_" + image_id)
                .addClass("btn-undo_like")
                .removeClass("btn-like");
            $(".like_image_" + image_id).attr(
                "src",
                url + "/img/arrowUpOn.png"
            );
        } else if (mensaje === "undo_like") {
            $(".like_image_" + image_id)
                .addClass("btn-like")
                .removeClass("btn-undo_like");
            $(".like_image_" + image_id).attr(
                "src",
                url + "/img/arrowUpOff.png"
            );
        } else if (mensaje === "like-undo_dislike") {
            //LIKE
            $(".like_image_" + image_id)
                .addClass("btn-undo_like")
                .removeClass("btn-like");
            $(".like_image_" + image_id).attr(
                "src",
                url + "/img/arrowUpOn.png"
            );
            //UNDO DISLIKE
            $(".dislike_image_" + image_id)
                .addClass("btn-dislike")
                .removeClass("btn-undo_dislike");
            $(".dislike_image_" + image_id).attr(
                "src",
                url + "/img/arrowDownOff.png"
            );
            $(".dislike_image_" + image_id)
                .closest(".flex")
                .find("#count-dislikes")
                .text(response.count_dislikes);
        }
        $(".like_image_" + image_id)
            .closest(".flex")
            .find("#count-likes")
            .text(response.count);
    }

    //BTN DISLIKE
    $(".btn-dislike").on("click", function () {
        const image_id = $(this).data("id");
        $.ajax({
            url: url + "/toggle_dislike/" + image_id,
            type: "GET",
            success: function (response) {
                updateCountDislikes(response, image_id, response.status);
            },
        });
    });

    function updateCountDislikes(response, image_id, mensaje) {
        console.log(image_id, " ", mensaje);

        if (mensaje === "dislike") {
            $(".dislike_image_" + image_id)
                .addClass("btn-undo_dislike")
                .removeClass("btn-dislike");
            $(".dislike_image_" + image_id).attr(
                "src",
                url + "/img/arrowDownOn.png"
            );
        } else if (mensaje === "undo_dislike") {
            $(".dislike_image_" + image_id)
                .addClass("btn-dislike")
                .removeClass("btn-undo_dislike");
            $(".dislike_image_" + image_id).attr(
                "src",
                url + "/img/arrowDownOff.png"
            );
        } else if (mensaje === "dislike-undo_like") {
            //DISLIKE
            $(".dislike_image_" + image_id)
                .addClass("btn-undo_dislike")
                .removeClass("btn-dislike");
            $(".dislike_image_" + image_id).attr(
                "src",
                url + "/img/arrowDownOn.png"
            );
            //UNDO LIKE
            $(".like_image_" + image_id)
                .addClass("btn-like")
                .removeClass("btn-undo_like");
            $(".like_image_" + image_id).attr(
                "src",
                url + "/img/arrowUpOff.png"
            );
            $(".like_image_" + image_id)
                .closest(".flex")
                .find("#count-likes")
                .text(response.count_likes);
        }
        $(".dislike_image_" + image_id)
            .closest(".flex")
            .find("#count-dislikes")
            .text(response.count);
    }

    //FINDER
    if (
        window.location.href === url + "/images" ||
        window.location.href === url + "/images?" ||
        window.location.href === url + "/images/"
    ) {
        localStorage.removeItem("searchQuery");
    }
    const searchQuery = localStorage.getItem("searchQuery");
    if (searchQuery) {
        $("#search-results-info").html(`Seen results from: ${searchQuery}`);
    }
    $("#finder").submit(function (e) {
        e.preventDefault();
        const searchQuery = $("#finder #search").val();
        localStorage.setItem("searchQuery", searchQuery);
        const newUrl = url + "/images/" + searchQuery;
        console.log(newUrl);
        $("#search-results-info").html(`Seen results from: ${searchQuery}`);
        window.location.href = newUrl;
    });
});

