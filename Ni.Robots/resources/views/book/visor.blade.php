<x-app-layout>
    <div id="pdf-viewer" class="max-w-5xl mx-auto flex flex-col items-center justify-center py-10"
        data-title="{{ $book->title }}"
        data-url="{{ asset($book->file_url) }}">
        
        <div class="flex w-full items-center justify-between mb-4">
            <div>
                <button id="prev-page" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">&#8592;</button>
                <span id="current" class="font-semibold">1</span> de 
                <span id="page-count" class="font-semibold"></span>
                <button id="next-page" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">&#8594;</button>
            </div>
            <div>
                <button id="zoom-in" class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-500">+</button>
                <button id="zoom-out" class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-500">-</button>
            </div>
        </div>

        <canvas id="pdf-renderer" class="border"></canvas>
    </div>

    <!-- PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pdfViewer = document.getElementById('pdf-viewer');
            const url = pdfViewer.dataset.url;

            let pdfDoc = null,
                pageNum = 1,
                pageIsRendering = false,
                pageNumIsPending = null,
                scale = 1.5;

            const canvas = document.getElementById('pdf-renderer');
            const ctx = canvas.getContext('2d');

            const loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(pdf => {
                pdfDoc = pdf;
                document.getElementById('page-count').textContent = pdfDoc.numPages;
                renderPage(pageNum);
            }).catch(err => console.error('Error cargando PDF:', err));

            function renderPage(num) {
                pageIsRendering = true;
                pdfDoc.getPage(num).then(page => {
                    const viewport = page.getViewport({ scale: scale });
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(() => {
                        pageIsRendering = false;
                        if (pageNumIsPending !== null) {
                            renderPage(pageNumIsPending);
                            pageNumIsPending = null;
                        }
                    });

                    document.getElementById('current').textContent = num;
                });
            }

            function queueRenderPage(num) {
                if (pageIsRendering) {
                    pageNumIsPending = num;
                } else {
                    renderPage(num);
                }
            }

            document.getElementById('prev-page').addEventListener('click', () => {
                if (pageNum <= 1) return;
                pageNum--;
                queueRenderPage(pageNum);
            });

            document.getElementById('next-page').addEventListener('click', () => {
                if (pageNum >= pdfDoc.numPages) return;
                pageNum++;
                queueRenderPage(pageNum);
            });

            document.getElementById('zoom-in').addEventListener('click', () => {
                scale += 0.25;
                renderPage(pageNum);
            });

            document.getElementById('zoom-out').addEventListener('click', () => {
                if (scale <= 0.25) return;
                scale -= 0.25;
                renderPage(pageNum);
            });
        });
    </script>
</x-app-layout>
