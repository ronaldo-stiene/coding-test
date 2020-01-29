@if (Session::has('success'))
    <script>
        function sucesso() {
            alert('{!! Session::get('success') !!}');
        }
        sucesso();
    </script>
@endif