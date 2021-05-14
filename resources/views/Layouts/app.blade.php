<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bloger</title>
    <!-- Description, Keywords and Author -->
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your,Keywords">
    <meta name="author" content="ResponsiveWebInc">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <!-- Custom CSS -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
</head>

<body>
    <div class="wrapper">

        <!-- header -->
        <header>
            @include('Layouts.header')
        </header>

        @yield('content')

        <footer>
            @include('Layouts.footer')
        </footer>

    </div>
    <!-- Javascript files -->
    <!-- jQuery -->
    <script src={{ asset('js/jquery.js') }}></script>
    <!-- Bootstrap JS -->
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <!-- Respond JS for IE8 -->
    <script src={{ asset('js/respond.min.js') }}></script>
    <!-- HTML5 Support for IE -->
    <script src={{ asset('js/html5shiv.js') }}></script>
    <!-- Custom JS -->
    <script src={{ asset('js/custom.js') }}></script>

    @stack('js-stack')

    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });

    </script>
    
</body>

</html>
