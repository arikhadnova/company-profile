    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        const wrapper = document.getElementById("wrapper");
        const overlay = document.getElementById("sidebar-overlay");
        
        // Toggle the wrapper class
        wrapper.classList.toggle("toggled");
        const isOpen = wrapper.classList.contains("toggled");
        
        // Handle overlay and body scroll
        if (overlay) {
            if (isOpen) {
                overlay.classList.remove("d-none");
                overlay.classList.add("show");
                if (window.innerWidth < 768) {
                    document.body.classList.add("sidebar-open");
                }
            } else {
                overlay.classList.add("d-none");
                overlay.classList.remove("show");
                document.body.classList.remove("sidebar-open");
            }
        }
        
        // Toggle icon on menu-toggle
        const btn = document.getElementById("menu-toggle");
        if (btn) {
            const icon = btn.querySelector('i');
            if (icon) {
                if (isOpen) {
                    icon.classList.remove('fa-indent');
                    icon.classList.add('fa-outdent');
                } else {
                    icon.classList.remove('fa-outdent');
                    icon.classList.add('fa-indent');
                }
            }
        }
    }

    // Attach listeners
    document.getElementById("menu-toggle").addEventListener("click", function(e) {
        e.preventDefault();
        toggleSidebar();
    });

    const overlay = document.getElementById("sidebar-overlay");
    if (overlay) {
        overlay.addEventListener("click", function(e) {
            e.preventDefault();
            toggleSidebar();
        });
    }

    const closeBtn = document.getElementById("sidebar-close");
    if (closeBtn) {
        closeBtn.addEventListener("click", function(e) {
            e.preventDefault();
            toggleSidebar();
        });
    }

    // Global Delete Confirmation with SweetAlert2
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-delete-confirm')) {
            e.preventDefault();
            const button = e.target.closest('.btn-delete-confirm');
            const url = button.getAttribute('href');
            const message = button.getAttribute('data-confirm-message') || "Data ini akan dihapus permanen!";
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    });
</script>
</body>
</html>
