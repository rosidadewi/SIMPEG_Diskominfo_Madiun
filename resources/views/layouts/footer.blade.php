<footer class="bg-dark text-white pt-3 pb-2 mt-5 shadow-lg rounded-top">
    <div class="container-fluid">
        <div class="text-center small">
            &copy; <span id="footer-year"></span>
            <span class="footer-gap"></span>
            <a href="https://www.ums.ac.id/" class="text-white fw-bold footer-link" target="_blank" style="text-decoration: underline;">PKN UMS</a>
            <span class="footer-x">x</span>
            <a href="https://kominfo.madiunkota.go.id/" class="text-white fw-bold footer-link" target="_blank" style="text-decoration: underline;">DISKOMINFO KOTA MADIUN</a>.
        </div>
    </div>
</footer>

<style>
    .small {
        font-size: 0.875rem;
    }

    .footer-gap {
        margin-right: 10px; /* Jarak antara tahun dan teks */
    }

    .footer-link {
        margin-right: 2px; /* Jarak antara PKN UMS dan 'x' */
    }

    .footer-x {
        margin-left: 6px; /* Jarak antara 'x' dan DISKOMINFO KOTA MADIUN */
        margin-right: 8px; /* Jarak antara 'x' dan DISKOMINFO KOTA MADIUN */
    }
</style>

<script>
    // Menyesuaikan tahun di footer secara otomatis setelah DOM dimuat
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("footer-year").innerText = new Date().getFullYear();
    });
</script>
