<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Tools foodservice</title>
    <link rel="shortcut icon" href="img/Tools.png" type="image/x-icon">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">



    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="alertas/toastr/toastr.min.css">



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark fundo">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <a class="navbar-brand float-md-start mb-0" href="index.html"><img src="img/Tools.png" width="130"></a>
                <nav class="nav nav-masthead justify-content-center float-md-end my-3 mynavbar lead">
                    <a class="nav-link" aria-current="page" href="servico.html">Serviço</a>
                    <a class="nav-link" aria-current="page" href="produtos.html">Produtos</a>
                    <a class="nav-link" href="carreira.html">Carreira</a>
                    <a class="nav-link active" href="#">Contacto</a>
                </nav>
            </div>
        </header>


        <main class="px-3 corpo ">
            <h3>Contacto</h3>
            <br>
            <form id="contactForm">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control mb-2 input-textos" placeholder="Nome" name="nome">
                        <input type="text" class="form-control mb-2 input-textos" placeholder="Contacto" name="contacto">
                        <input type="text" class="form-control mb-2 input-textos" placeholder="Email" name="email">
                        <button type="submit" class="btn botao btn-lg" id="submitButton">Enviar</button>
                    </div>
                    <div class="col">

                        <input type="text" class="form-control mb-2 input-textos" placeholder="Assunto" name="assunto">
                        <div class="form-floating">
                            <textarea class="form-control input-textos" placeholder="Leave a comment here" id="floatingTextarea" name="message"></textarea>
                            <label for="floatingTextarea" class="lead" style="color: rgb(148, 148, 148) ;">Mensagem</label>
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <footer class="mt-auto text-white-50">
            <p>Todos os direitos reservados a © TOOLS 2022.</p>
            <!--
            <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
                    href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>-->
        </footer>
    </div>



</body>
<!--Javascript Carousel-->
<script src="alertas/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="alertas/sweetalert2/sweetalert2.min.js"></script>
<script src="alertas/toastr/toastr.min.js"></script>
<script>
    jQuery(document).on('submit', '#contactForm', function(event) {
        event.preventDefault();
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });

        jQuery.ajax({
                url: `<?= 'https://' . $_SERVER['HTTP_HOST'] . '/TOOLS/sendEmail.php' ?>`,
                method: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function() {
                    $("#submitButton").text("Enviando...");
                    console.log('Enviando...');
                }
            }).done(
                function(resposta) {
                    if (!resposta.erro) {
                        toastr.success(resposta.msg);
                        document.getElementById("contactForm").reset();

                        $("#submitButton").text("enviar ");
                        $("#submitSuccessMessage").removeClass("d-none");
                        console.log('Enviado');
                    } else {
                        toastr.error(resposta.msg);

                        $("#submitButton").text("enviar");
                        $("#submitButton").append('<i class="bi bi-arrow-right"></i>');
                        console.log('Erro');
                    }
                })
            .fail(function(resp) {
                console.log(resp)
                toastr.error(resp.responseJSON.msg);
            })
            .always(function(resposta) {
                console.log(resposta.responseJSON.msg);
            });
    });
</script>


</html>