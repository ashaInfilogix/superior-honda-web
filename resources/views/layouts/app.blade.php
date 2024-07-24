<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Superior Honda</title>
        <meta name="description" content="Morden Bootstrap HTML5 Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- ======= All CSS Plugins here ======== -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/glightbox.min.css') }}">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&amp;display=swap"
            rel="stylesheet">

        <!-- Plugin css -->
        <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">

        <!-- Custom Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">

        @yield('head')
    </head>

    <body>
        @include('layouts.components.header')

        <main class="main__content_wrapper">
            @yield('content')
        </main>

        @include('layouts.components.footer')

        <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                    d="M112 244l144-144 144 144M256 120v292" />
            </svg></button>

        <!-- All Script JS Plugins here  -->
        <script src="{{ asset('assets/js/vendor/popper.js') }}" defer="defer"></script>
        <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
        <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/glightbox.min.js') }}"></script>

        <!-- Customscript js -->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

        @yield('script')
        <script>
            $(function() {            
                $('.delete-btn').click(function() {
                    let source = $(this).data('source');
                    let deleteApiEndpoint = $(this).data('endpoint');
                    swal({
                        title: "Are you sure?",
                        text: `You really want to remove this ${source}?`,
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: deleteApiEndpoint,
                                method: 'DELETE',
                                data: {
                                    '_token': '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if(response.success){
                                        swal({
                                            title: "Success!",
                                            text: response.message,
                                            type: "success",
                                            showConfirmButton: false
                                        }) 
    
                                        setTimeout(() => {
                                            location.reload();
                                        }, 2000);
                                    }
                                }
                            })
                        }
                    });
                })
            })
        </script>

    </body>
</html>
