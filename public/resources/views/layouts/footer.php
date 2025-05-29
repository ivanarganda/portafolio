<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="https://cdn.igvdeveloper.com/form-validator/latest/validator.min.js"></script> -->
<script type="module" src="../../../src/app.js"></script>
<script>
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            document.querySelector('.sidebar').classList.remove('active');
            document.querySelector('.main-content').classList.remove('active');
        }
    });
</script>