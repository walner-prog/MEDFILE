// public/js/cdn-scripts.js

const loadCDNs = () => {
    const scripts = [
        "https://code.jquery.com/jquery-3.6.0.min.js",
        "https://cdn.jsdelivr.net/npm/sweetalert2@11",
        "https://cdn.datatables.net/2.0.8/js/dataTables.js",
        "https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js",
        "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js",
        "https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js",
        "https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js",
        "https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js",
        "https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js",
        "https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js",
        "https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js",
        "https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js",
        "https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"
    ];

    scripts.forEach((src) => {
        const script = document.createElement('script');
        script.src = src;
        document.head.appendChild(script);
    });
}

// Cargar todos los scripts CDN
loadCDNs();
