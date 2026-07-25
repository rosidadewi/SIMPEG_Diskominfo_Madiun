document.addEventListener('DOMContentLoaded', () => {
    // Tambahkan animasi klik langsung
    document.querySelectorAll('button, a.btn, .clickable').forEach(el => {
        el.addEventListener('click', function () {
            // Tambahkan spinner kecil setelah elemen diklik jika belum ada
            if (!this.classList.contains('no-spinner') && !this.querySelector('.loader-spin')) {
                const spinner = document.createElement('span');
                spinner.classList.add('loader-spin');
                this.appendChild(spinner);

                // Hilangkan spinner setelah beberapa detik
                setTimeout(() => {
                    spinner.remove();
                }, 1500);
            }
        });
    });
});
