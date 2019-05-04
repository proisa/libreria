<script src="js/jquery.js"></script>
    <script src="js/sweetalert.js"></script>
    <?php if(isset($_GET['auth']) && $_GET['auth'] == 'failed'): ?>
    <script>
        Swal.fire({
            title: 'Error!',
            text: 'Datos invalidos',
            type: 'error',
            confirmButtonText: 'Cool'
        });
    </script>
    <?php endif;?>
</body>
</html>