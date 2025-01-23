@if (session('success'))
    <script>
        Swal.fire({
            title: "Success",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}",
            icon: "error"
        });
    </script>
@endif
