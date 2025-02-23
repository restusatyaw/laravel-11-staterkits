<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    

    @if(session('error'))
    Swal.fire({
        title: "Opss..",
        text: "{{session('error')}}",
        icon: "error"
    });
    @elseif(session('success'))
    Swal.fire({
        title: "Success",
        text: "{{session('success')}}",
        icon: "success"
    });
    @elseif(session('warning'))
    Swal.fire({
        title: "Warning",
        text: "{{session('warning')}}",
        icon: "error"
    });
    @endif

</script>
