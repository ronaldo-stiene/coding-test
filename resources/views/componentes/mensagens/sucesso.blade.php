@if (Session::has('user'))
    <script>
        function sucesso() {
            alert('{!! Session::get('user') !!}');
        }
        sucesso();
    </script>
@endif