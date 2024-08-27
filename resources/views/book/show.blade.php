<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</head>

<body class="bg-white dark:bg-gray-900 mx-auto">
    @include('Index.nav-bar')
    <main class="container mx-auto p-4 min-h-full mt-18">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">{{ __('Show') }} Book</h1>
            <div class="py-12">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                        <div class="w-full">
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">
                                        {{ __('Show') }} Book</h1>
                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Details of
                                        {{ __('Book') }}.</p>
                                </div>
                                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                    <a type="button" href="{{ route('books.index') }}"
                                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                                </div>
                            </div>

                            <div class="flow-root">
                                <div class="mt-8 overflow-x-auto">
                                    <div class="inline-block min-w-full py-2 align-middle">
                                        <div class="mt-6 border-t border-gray-100 dark:border-gray-700">
                                            <dl class="divide-y divide-gray-100 dark:divide-gray-700">
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Title</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->title }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        File Url</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->file_url }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Autor Id</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->autor_id }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Editorial Id</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->editorial_id }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Portada</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->portada }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Descripcion</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->descripcion }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Fecha Publicacion</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->fecha_publicacion }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Isbn</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->isbn }}</dd>
                                                </div>
                                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                    <dt
                                                        class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">
                                                        Paginas</dt>
                                                    <dd
                                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                                        {{ $book->paginas }}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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




        <script>
            var myState = {
                pdf: null,
                currentPage: 1,
                zoom: 1
            };

            document.addEventListener('DOMContentLoaded', function() {
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
                loadingTask.promise.then(function(pdfDocument) {
                    console.log('Documento PDF cargado correctamente:', pdfDocument);
                    pdfDoc = pdfDocument;
                    document.getElementById('page-count').textContent = pdfDoc.numPages;

                    renderPage(pageNum);
                }).catch(function(error) {
                    console.error('Error al cargar el documento PDF:', error);
                });

                function renderPage(num) {
                    if (!pdfDoc) {
                        console.error('Documento PDF no cargado correctamente');
                        return;
                    }

                    pageIsRendering = true;

                    pdfDoc.getPage(num).then(function(page) {
                        var viewport = page.getViewport({
                            scale: scale
                        });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        page.render(renderContext).promise.then(function() {
                            pageIsRendering = false;

                            if (pageNumIsPending !== null) {
                                renderPage(pageNumIsPending);
                                pageNumIsPending = null;
                            }
                        });

                        document.getElementById('current').textContent = num; // Update current page display
                    }).catch(function(error) {
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
                document.getElementById('zoom-in').addEventListener('click', function() {
                    scale += 0.25;
                    renderPage(pageNum);
                });

                document.getElementById('zoom-out').addEventListener('click', function() {
                    if (scale <= 0.25) {
                        return;
                    }
                    scale -= 0.25;
                    renderPage(pageNum);
                });
            });
        </script>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.worker.min.js"></script>

    @vite('resources/js/dark-mode.js')
</body>

</html>
