(function ($) {

    $(document).ready(function () {

        let contentReplace = $('#content-replace'),
            $localpage = "views/agra.html",
            pageRedir = $localpage;

            loadContent(pageRedir, contentReplace);

        $('#menu-cm li a').on('click', function (e) {
            e.preventDefault();
            var option = $(this),
                viewContent = option.attr('href');

            // $('#top-menu li').removeClass('active');

            $('#menu-cm li').removeClass('active');
            option.parent().addClass('active');

            // if (option.hasClass('content-pv')) {
            //   $("#content").load(viewContent, function () {
            //     var wrapperPrincipal = $('#principal');

            //     wrapperPrincipal.attr('data-seccion', 'puntos_venta');
            //   });
            // } else if (option.hasClass('ubicacionVendedores')) {
            //   $("#content").load(viewContent, function (response) {});
            // } else {
            // Para que solo cargue archivos
            if (viewContent.includes('#') === false) {
                $("#content-replace").load('views/' + viewContent);
            }
            // }

        });

        // $('#top-menu li .nav-link').on('click', function (e) {
        //   e.preventDefault();
        //   var option = $(this),
        //     viewContent = option.attr('href'),
        //     wrapperPrincipal = $('#principal');

        //   $('#menu-cm li').removeClass('active');
        //   $('#top-menu li').removeClass('active');
        //   option.parent().addClass('active');

        //   $("#content").load(viewContent);
        // });

        // $('#sidebarCollapse').on('click', function () {
        //   $('#sidebar').toggleClass('active');
        // });
    });

    $(document).on('click', '.pageto', function (e) {
        e.preventDefault();
        let contentReplace = $('#content-replace'),
            $localpage = $(this).attr('href'),
            pageRedir = $localpage;

        if (pageRedir !== '' && pageRedir) {
            loadContent(pageRedir, contentReplace);
        }
    });

    $(document).on('click', '.nuevoLink', function (e) {
        e.preventDefault();
        let contentReplace = $('#content-replace'),
            $localpage = $(this).attr('href'),
            pageRedir = $localpage;

        if (pageRedir !== '' && pageRedir) {
            loadContent(pageRedir, contentReplace);
        }
    });

})(jQuery);

function loadContent(part, contentReplace) {
    $.get(part, function (data, textStatus, jqXHR) {
        contentReplace.html(data);
    });
}