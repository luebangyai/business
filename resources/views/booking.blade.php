<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="antialiased">

       @include('partials.header')

        @include('pages.booking')

        @include('partials.footer')
        <script src="/vendors/js/vendor.bundle.base.js"></script>
        <script src="/js/off-canvas.js"></script>
        <script src="/js/hoverable-collapse.js"></script>
        <script src="/js/template.js"></script>
        <script src="/js/settings.js"></script>
        <script src="/js/todolist.js"></script>
        <script src="/js/tabs.js"></script>

        <script src="/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/vendors/bootstrap-sweetalert/sweetalert.js"></script>
    </body>
</html>
