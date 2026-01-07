<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, offset: 100, duration: 800 });

    document.querySelectorAll('.btn-toggle-detail').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = document.querySelector(this.dataset.bsTarget);
            console.log(target.classList.contains('show'));
        });
    });
</script>