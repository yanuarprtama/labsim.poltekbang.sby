$(document).ready(function () {
    var inventaris_nav = $("#inventaris_nav")
    var laboratorium_nav = $("#laboratorium_nav")
    var history_peminjaman = $("#history_peminjaman")

    var inventaris_container = $("#inventaris_container")
    var laboratorium_container = $("#laboratorium_container")
    var history_peminjaman_container = $("#history_peminjaman_container")

    inventaris_nav.click(function (e) {
        e.preventDefault();
        resetNavigation()
        resetFormDisplay()
        $(this).addClass("active")
        inventaris_container.removeClass("d-none")
    });

    laboratorium_nav.click((e) => {
        e.preventDefault()
        resetNavigation()
        resetFormDisplay()
        laboratorium_nav.addClass("active")
        laboratorium_container.removeClass("d-none")
    })

    history_peminjaman.click((e) => {
        e.preventDefault()
        resetNavigation()
        resetFormDisplay()
        history_peminjaman.addClass("active")
        history_peminjaman_container.removeClass("d-none")
    })

    function resetNavigation() {
        var navigation = $("#navigation_container")

        $.each(navigation.children(), function (i, elm) {
            $.each(elm.className.split(" "), function (j, elmInner) {
                if (elmInner == "active") {
                    elm.classList.remove("active")
                }
            });
        });
    }

    function resetFormDisplay() {
        var body = $("#body-peminjaman")

        $.each(body.children(), function (i, elm) {
            $.each(elm.className.split(" "), function (j, className) {
                if (className !== "d-none") {
                    elm.classList.add("d-none")
                }
            });
        });
    }
});