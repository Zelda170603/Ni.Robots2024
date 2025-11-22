document.addEventListener('DOMContentLoaded', function() {
    var pdfViewer = document.getElementById('pdf-viewer');
    if (!pdfViewer) {
        console.error('No se encontró el contenedor PDF');
        return;
    }

    // Obtener la URL desde data-url
    var url = pdfViewer.dataset.url;

   

    var pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null,
        scale = 1.5,
        canvas = document.getElementById('pdf-renderer'),
        context = canvas.getContext('2d'),
        pdfDoc = null;

    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdfDocument) {
        console.log('Documento PDF cargado correctamente:', pdfDocument);
        pdfDoc = pdfDocument;
        document.getElementById('page-count').textContent = pdfDoc.numPages;
        renderPage(pageNum);
    }).catch(function(error) {
        console.error('Error al cargar el documento PDF:', error);
        alert('No se pudo cargar el PDF. Verifica la ruta: ' + url);
    });

    function renderPage(num) {
        if (!pdfDoc) return;

        pageIsRendering = true;

        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({ scale: scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            var renderContext = { canvasContext: context, viewport: viewport };
            page.render(renderContext).promise.then(function() {
                pageIsRendering = false;
                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });

            document.getElementById('current').textContent = num;
        }).catch(function(error) {
            console.error('Error al renderizar la página:', error);
        });
    }

    function queueRenderPage(num) {
        if (pageIsRendering) pageNumIsPending = num;
        else renderPage(num);
    }

    function showPrevPage() { if (pageNum > 1) { pageNum--; queueRenderPage(pageNum); } }
    function showNextPage() { if (pageNum < pdfDoc.numPages) { pageNum++; queueRenderPage(pageNum); } }

    ['prev-page', 'next-page', 'zoom-in', 'zoom-out'].forEach(id => {
        var el = document.getElementById(id);
        if (!el) return; // Evita errores si el botón no existe
    });

    document.getElementById('prev-page')?.addEventListener('click', showPrevPage);
    document.getElementById('next-page')?.addEventListener('click', showNextPage);
    document.getElementById('zoom-in')?.addEventListener('click', function() { scale += 0.25; renderPage(pageNum); });
    document.getElementById('zoom-out')?.addEventListener('click', function() { if (scale > 0.25) { scale -= 0.25; renderPage(pageNum); } });
});
