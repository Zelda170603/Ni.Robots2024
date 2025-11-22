document.addEventListener('DOMContentLoaded', function() {
    // Elementos del modal
    const pdfModal = document.getElementById('pdf-modal');
    const openPdfBtn = document.getElementById('open-pdf-modal');
    const closePdfBtn = document.getElementById('close-pdf-modal');
    
    // Variables del PDF
    let pageNum = 1;
    let pageIsRendering = false;
    let pageNumIsPending = null;
    let scale = 1.2;
    let canvas = document.getElementById('pdf-renderer');
    let context = canvas.getContext('2d');
    let pdfDoc = null;
    let currentPage = null;

    // Abrir modal
    openPdfBtn.addEventListener('click', function() {
        pdfModal.classList.remove('hidden');
        loadPDF();
        document.body.style.overflow = 'hidden';
    });

    // Cerrar modal
    closePdfBtn.addEventListener('click', closeModal);
    
    // Cerrar al hacer click fuera del contenido
    pdfModal.addEventListener('click', function(e) {
        if (e.target === pdfModal) {
            closeModal();
        }
    });

    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !pdfModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    function closeModal() {
        pdfModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        // Resetear variables del PDF
        pageNum = 1;
        scale = 1.2;
        pdfDoc = null;
        currentPage = null;
    }

    function loadPDF() {
        // Obtener la URL del data attribute del modal
        const pdfUrl = pdfModal.querySelector('[data-pdf-url]').getAttribute('data-pdf-url');
        
        console.log('Intentando cargar PDF desde:', pdfUrl);

        // Configurar PDF.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.worker.min.js';

        var loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdfDocument) {
            console.log('PDF cargado correctamente');
            pdfDoc = pdfDocument;
            document.getElementById('page-count').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        }).catch(function(error) {
            console.error('Error al cargar el PDF:', error);
            alert('No se pudo cargar el PDF. Verifica que el archivo exista en: ' + pdfUrl);
        });
    }

    function renderPage(num) {
        if (!pdfDoc) return;

        pageIsRendering = true;

        // Mostrar indicador de carga
        showLoadingIndicator();

        pdfDoc.getPage(num).then(function(page) {
            currentPage = page;
            var viewport = page.getViewport({ scale: scale });
            
            console.log('Renderizando con escala:', scale, 'Tamaño canvas:', viewport.width, 'x', viewport.height);
            
            // Ajustar canvas al tamaño de la página - SIN estilo CSS para permitir scroll
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            
            // Remover estilos de tamaño que limitan el canvas
            canvas.style.height = '';
            canvas.style.width = '';
            canvas.style.maxWidth = 'none';
            canvas.style.maxHeight = 'none';

            // Limpiar el canvas completamente
            context.clearRect(0, 0, canvas.width, canvas.height);

            var renderContext = { 
                canvasContext: context, 
                viewport: viewport 
            };
            
            page.render(renderContext).promise.then(function() {
                pageIsRendering = false;
                hideLoadingIndicator();
                console.log('Página renderizada con zoom:', scale);
                
                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });

            document.getElementById('current').textContent = num;
        }).catch(function(error) {
            console.error('Error al renderizar la página:', error);
            hideLoadingIndicator();
            pageIsRendering = false;
        });
    }

    function showLoadingIndicator() {
        canvas.style.opacity = '0.5';
    }

    function hideLoadingIndicator() {
        canvas.style.opacity = '1';
    }

    function queueRenderPage(num) {
        if (pageIsRendering) {
            pageNumIsPending = num;
        } else {
            renderPage(num);
        }
    }

    function showPrevPage() {
        if (pageNum > 1) {
            pageNum--;
            queueRenderPage(pageNum);
        }
    }

    function showNextPage() {
        if (pageNum < pdfDoc.numPages) {
            pageNum++;
            queueRenderPage(pageNum);
        }
    }

    // FUNCIÓN ZOOM MEJORADA
    function applyZoom(newScale) {
        if (!pdfDoc || pageIsRendering) return;
        
        // Limitar el zoom mínimo y máximo
        if (newScale < 0.5) newScale = 0.5;
        if (newScale > 5.0) newScale = 5.0; // Aumenté el máximo a 5.0
        
        scale = newScale;
        console.log('Aplicando zoom:', scale);
        
        // Forzar re-render de la página actual
        renderPage(pageNum);
    }

    // Event listeners para controles
    document.getElementById('prev-page').addEventListener('click', showPrevPage);
    document.getElementById('next-page').addEventListener('click', showNextPage);
    
    // ZOOM IN
    document.getElementById('zoom-in').addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        applyZoom(scale + 0.3);
    });
    
    // ZOOM OUT
    document.getElementById('zoom-out').addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        applyZoom(scale - 0.3);
    });

    // Navegación con teclado
    document.addEventListener('keydown', function(e) {
        if (!pdfModal.classList.contains('hidden')) {
            switch(e.key) {
                case 'ArrowLeft':
                    showPrevPage();
                    break;
                case 'ArrowRight':
                    showNextPage();
                    break;
                case '+':
                case '=':
                    e.preventDefault();
                    applyZoom(scale + 0.3);
                    break;
                case '-':
                    e.preventDefault();
                    applyZoom(scale - 0.3);
                    break;
            }
        }
    });

    // Zoom con rueda del mouse
    canvas.addEventListener('wheel', function(e) {
        if (e.ctrlKey) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? -0.2 : 0.2;
            applyZoom(scale + delta);
        }
    }, { passive: false });

    console.log('PDF Viewer inicializado - Zoom con scroll listo');
});