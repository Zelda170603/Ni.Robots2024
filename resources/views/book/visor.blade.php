
<x-app-layout>
    <head>
        <style>
            .btn {
                cursor: pointer;
            }
    
            .btn-primary {
                background-color: #4a5568;
                color: #ffffff;
                transition: background-color 0.3s ease;
            }
    
            .btn-primary:hover {
                background-color: #718096;
            }
        </style>
    </head>
    
    <body class="bg-gray-100">
        <div id="pdf-viewer" class="max-w-5xl mx-auto flex flex-col items-center justify-center py-10"
            data-title="{{ $book->title }}" data-url="{{ asset($book->file_url) }}">
            <div id="canvas-container" class="space-y-4">
                <div class="flex w-full items-center justify-between">
                    <div id="nav" class="flex items-center justify-start gap-2">
                        
                        <button id="prev-page"
                            class="py-2 px-3 bg-indigo-600 hover:bg-indigo-200 text-white transition delay-150 duration-300 ease-in-out">
                            &#8592;
                        </button>
                        
                        <span id="current" class="text-lg font-semibold">1</span>
                        de
                        <span id="page-count" class="text-lg font-semibold"></span>
                        <button id="next-page"
                            class="py-2 px-3 bg-indigo-600 hover:bg-indigo-200 text-white transition delay-150 duration-300 ease-in-out">
                            &#8594;
                        </button>
                    </div>
                    <div class="flex items-center justify-end gap-2">
                        <button id="zoom-in"
                            class="rounded-full py-1 px-3 bg-indigo-600 hover:bg-indigo-200 text-white transition delay-150 duration-300 ease-in-out">
                            &#43;
                        </button>
                        <button id="zoom-out"
                            class="rounded-full py-1 px-3 bg-indigo-600 hover:bg-indigo-200 text-white transition delay-150 duration-300 ease-in-out">
                            &#45;
                        </button>
                    </div>
                </div>
                <canvas id="pdf-renderer" class="border"></canvas>
            </div>
    
        </div>
    
        <!-- PDF.js desde CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.worker.min.js"></script>
</x-app-layout>


  
    <script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        };

        document.addEventListener('DOMContentLoaded', function () {
            var pdfViewer = document.getElementById('pdf-viewer');
            var url = pdfViewer.dataset.url; // Obtener la URL del archivo PDF desde el atributo data-url

            var pageNum = 1,
                pageIsRendering = false,
                pageNumIsPending = null,
                scale = 1.5,
                canvas = document.getElementById('pdf-renderer'),
                context = canvas.getContext('2d'),
                pdfDoc = null; // Variable para almacenar el documento PDF

            var loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function (pdfDocument) {
                console.log('Documento PDF cargado correctamente:', pdfDocument);
                pdfDoc = pdfDocument;
                document.getElementById('page-count').textContent = pdfDoc.numPages;

                renderPage(pageNum);
            }).catch(function (error) {
                console.error('Error al cargar el documento PDF:', error);
            });

            function renderPage(num) {
                if (!pdfDoc) {
                    console.error('Documento PDF no cargado correctamente');
                    return;
                }

                pageIsRendering = true;

                pdfDoc.getPage(num).then(function (page) {
                    var viewport = page.getViewport({
                        scale: scale
                    });
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

                    document.getElementById('current').textContent = num; // Update current page display
                }).catch(function (error) {
                    console.error('Error al cargar la página:', error);
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

            // Event listeners for navigation buttons
            document.getElementById('prev-page').addEventListener('click', showPrevPage);
            document.getElementById('next-page').addEventListener('click', showNextPage);

            // Event listeners for zoom buttons
            document.getElementById('zoom-in').addEventListener('click', function () {
                scale += 0.25;
                renderPage(pageNum);
            });

            document.getElementById('zoom-out').addEventListener('click', function () {
                if (scale <= 0.25) {
                    return;
                }
                scale -= 0.25;
                renderPage(pageNum);
            });
        });
    </script>
</body>

</html>
