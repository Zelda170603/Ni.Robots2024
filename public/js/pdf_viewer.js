document.addEventListener('DOMContentLoaded', function () {
    var pdfViewer = document.getElementById('pdf-viewer');
    var url = pdfViewer.dataset.url; // Obtener la URL del archivo PDF desde el atributo data-url

    var pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null,
        scale = 1.5,
        canvas = document.createElement('canvas'),
        context = canvas.getContext('2d'),
        pdfDoc = null; // Variable para almacenar el documento PDF

    pdfViewer.appendChild(canvas);

    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function (pdfDocument) {
        console.log('PDF cargado correctamente');
        pdfDoc = pdfDocument;
        document.getElementById('page-count').textContent = pdfDoc.numPages;

        renderPage(pageNum);
    }).catch(function (reason) {
        console.error('Error al cargar el PDF:', reason);
    });

    function renderPage(num) {
        if (!pdfDoc) {
            console.error('Documento PDF no cargado correctamente');
            return;
        }

        pageIsRendering = true;

        pdfDoc.getPage(num).then(function (page) {
            var viewport = page.getViewport({ scale: scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            page.render(renderContext).promise.then(function () {
                pageIsRendering = false;

                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });

            document.getElementById('page-num').textContent = num;
        }).catch(function (reason) {
            console.error('Error al cargar la página:', reason);
        });
    }

    function queueRenderPage(num) {
        if (pageIsRendering) {
            pageNumIsPending = num;
        } else {
            renderPage(num);
        }
    }

    function showPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }

    function showNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }

    document.getElementById('prev-page').addEventListener('click', showPrevPage);
    document.getElementById('next-page').addEventListener('click', showNextPage);
});
