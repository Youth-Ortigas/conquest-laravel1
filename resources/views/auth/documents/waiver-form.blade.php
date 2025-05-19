@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/documents.css') }}">
    {{ csrf_field() }}
    @php($loggedUserFirstName = Auth::user()->first_name ?? "")
    @php($loggedUserLastName = Auth::user()->last_name ?? "")
    <div class="page_wrap">
        @include('includes.banner_common', ['title' => "Waiver Form: $loggedUserFirstName"])
        @include('includes.header')
        @include('includes.menu_mobile')
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none" style="margin: 0 0 30px 0 !important;">
                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 style="margin:0;"> To Thy Youths: <br/> Kindly show this message to thy parent or legal guardian, that they may read and sign the waiver form. </h3>
                                                    <h3 style="margin:15px 0 30px 0;"> To Thy Parents/Legal Guardians: <br/> Click on [Draw] to provide thy signature and agree to the terms of the waiver. </h3>
                                                    <div id="toolbar" style="width:100%; text-align: right;">
                                                        <button id="prev-page" class="tool-button hide"><i class="fas fa-arrow-left"></i> Previous</button>
                                                        <button id="next-page" class="tool-button hide"><i class="fas fa-arrow-right"></i> Next</button>
                                                        <button id="draw-button" class="tool-button"><i class="fas fa-pencil-alt"></i> Draw</button>
                                                        <button id="erase-button" class="tool-button"><i class="fas fa-eraser"></i> Erase</button>
                                                        <button id="download-button" class="tool-button"><i class="fas fa-download"></i> Download</button>
                                                        <button id="save-button" class="tool-button"><i class="fas fa-save"></i> Save</button>
                                                    </div>
                                                    <div id="pdf-container">
                                                        <canvas id="pdf-canvas"></canvas>
                                                        <canvas id="annotation-canvas"></canvas>
                                                    </div>
                                                    <div id="page-info">Page: <span id="page-num"></span> / <span id="page-count"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../library/jquery.blockUI.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
    <script type="module">
        // include this to fix the "jsPDF is not defined" issue
        window.jsPDF = window.jspdf.jsPDF
        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var { pdfjsLib } = globalThis;

        // compatibility mode for browsers that do not fully support all PDF.js features.
        pdfjsLib.disableWorker = true;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.mjs';

        let filePath = @json($filePath);
        let fileName = @json($fileName);
        const saveUrl = @json($saveURL);
        const documentId = @json($documentID);

        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        const pdfCanvas = document.getElementById('pdf-canvas');
        const annotationCanvas = document.getElementById('annotation-canvas');
        const ctx = pdfCanvas.getContext('2d');
        const annotationCtx = annotationCanvas.getContext('2d');

        let drawing = false;
        let erasing = false;
        let isDrawing = false;
        let isErasing = false;
        const annotations = {};

        function showInProgress() {
            window.jQuery.blockUI({
                message:
                    '<h3 class="myd_preloader"><span style="margin-left:20px;">Please thy wait...</span></h3>',
                baseZ: window.jQuery.now(),
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#fff',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: 0.5,
                    color: '#000'
                }
            });
        }

        function renderPage(num) {
            pageRendering = true;

            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale: 2.0 });
                pdfCanvas.height = viewport.height;
                pdfCanvas.width = viewport.width;
                annotationCanvas.height = viewport.height;
                annotationCanvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                };

                const renderTask = page.render(renderContext);

                renderTask.promise.then(() => {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }

                    // Draw annotations if they exist
                    if (annotations[num]) {
                        const img = new Image();
                        img.src = annotations[num];
                        img.onload = () => {
                            annotationCtx.drawImage(img, 0, 0);
                        };
                    }
                });

                document.getElementById('page-num').textContent = num;
            });
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            saveCurrentPageAnnotations();
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            saveCurrentPageAnnotations();
            pageNum++;
            queueRenderPage(pageNum);
        }

        document.getElementById('prev-page').addEventListener('click', onPrevPage);
        document.getElementById('next-page').addEventListener('click', onNextPage);

        const lineWidth = 2.5; // thickness of drawing
        annotationCtx.lineWidth = lineWidth;

        // only start drawing and erasing on mouse left click
        annotationCanvas.addEventListener('mousedown', (e) => {
            if (drawing && e.button === 0) {
                isDrawing = true;
                annotationCtx.beginPath();
                annotationCtx.moveTo(e.offsetX, e.offsetY);
                annotationCtx.lineWidth = lineWidth;
            } else if (erasing && e.button === 0) {
                isErasing = true;
                erase(e.offsetX, e.offsetY);
            }
        });

        annotationCanvas.addEventListener('mousemove', (e) => {
            if (isDrawing) {
                annotationCtx.lineTo(e.offsetX, e.offsetY);
                annotationCtx.stroke();
            } else if (isErasing) {
                erase(e.offsetX, e.offsetY);
            }
        });

        annotationCanvas.addEventListener('mouseup', () => {
            isDrawing = false;
            isErasing = false;
        });

        annotationCanvas.addEventListener('mouseout', () => {
            isDrawing = false;
            isErasing = false;
        });

        document.getElementById('draw-button').addEventListener('click', () => {
            toggleTool('draw');
        });

        document.getElementById('erase-button').addEventListener('click', () => {
            toggleTool('erase');
        });

        function toggleTool(tool) {
            if (tool === 'draw') {
                drawing = !drawing;
                erasing = false;
                annotationCanvas.classList.toggle('draw-mode', drawing);
                annotationCanvas.classList.remove('erase-mode');
            } else if (tool === 'erase') {
                erasing = !erasing;
                drawing = false;
                annotationCanvas.classList.remove('draw-mode');
                annotationCanvas.classList.toggle('erase-mode', erasing);
            }

            document.querySelectorAll('.tool-button').forEach(button => {
                button.classList.toggle('active', button.id === `${tool}-button` && (drawing || erasing));
            });
        }

        function erase(x, y) {
            annotationCtx.clearRect(x - 10, y - 10, 20, 20);
        }

        function saveCurrentPageAnnotations() {
            annotations[pageNum] = annotationCanvas.toDataURL('image/png');
        }

        function downloadPdf(pdfBlob) {
            const url = URL.createObjectURL(pdfBlob);
            const a = document.createElement('a');

            a.href = url;
            a.download = fileName;

            document.body.appendChild(a);
            a.click();

            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function hideInProgress() {
            window.jQuery.unblockUI();
        }

        function sendPdf(pdfBlob) {
            showInProgress();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData();

            formData.append('_token', csrfToken);
            formData.append('doc_id', documentId);
            formData.append('file', pdfBlob, fileName);

            fetch(saveUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => {
                    if (!response.ok) {
                        hideInProgress();
                        //messagePopup({ message:'Network response was not ok' });
                        alert({ message:'Network response was not ok' });
                    }

                    return response.json();
                })
                .then(data => {
                    hideInProgress();
                    //messagePopup({ message: data.message });
                    alert({ message: data.message });

                    if (data.success) {
                        const newAttachment = data.newAttachment;
                        filePath = newAttachment.att_storage_path;
                        fileName = newAttachment.att_filename;
                    }
                })
                .catch(error => {
                    hideInProgress();
                    //messagePopup({ message:'Error while saving the PDF: ' + error });
                    alert({ message:'Error while saving the PDF: ' + error });
                });
        }

        function generatePdf(callback) {
            saveCurrentPageAnnotations();

            pdfjsLib.getDocument(filePath).promise.then(pdf => {
                const pdfAnnotations = Object.assign({}, annotations);
                const totalPages = pdf.numPages;
                let renderPromises = [];

                for (let i = 1; i <= totalPages; i++) {
                    renderPromises.push(
                        pdf.getPage(i).then(page => {
                            const viewport = page.getViewport({ scale: 1.5 });
                            const canvas = document.createElement('canvas');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            const ctx = canvas.getContext('2d');
                            const renderContext = {
                                canvasContext: ctx,
                                viewport: viewport,
                            };

                            return page.render(renderContext).promise.then(() => {
                                if (pdfAnnotations[i]) {
                                    const imgElement = new Image();
                                    imgElement.src = pdfAnnotations[i];
                                    return new Promise(resolve => {
                                        imgElement.onload = () => {
                                            ctx.drawImage(imgElement, 0, 0, canvas.width, canvas.height);
                                            resolve(canvas);
                                        };
                                    });
                                } else {
                                    return canvas;
                                }
                            });
                        })
                    );
                }

                Promise.all(renderPromises).then(canvases => {
                    const doc = new jsPDF();

                    canvases.forEach((canvas, index) => {
                        if (index > 0) {
                            doc.addPage();
                        }
                        const imgData = canvas.toDataURL('image/jpeg', 1.0);
                        doc.addImage(imgData, 'JPEG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());
                    });

                    const pdfBlob = doc.output('blob');
                    callback(pdfBlob);
                }).catch(error => {
                    //messagePopup({ message:'Error generating PDF: ' + error });
                    alert({ message:'Error generating PDF: ' + error });
                });
            });
        }

        document.getElementById('download-button').addEventListener('click', () => {
            generatePdf(downloadPdf);
        });

        document.getElementById('save-button').addEventListener('click', () => {
            const userConfirmed = confirm("Saving the document will finalize all changes and cannot be undone. Do you want to proceed?");

            if (userConfirmed) {
                generatePdf(sendPdf);
            }
        });

        showInProgress();

        pdfjsLib.getDocument(filePath).promise.
        then(pdf => {
            pdfDoc = pdf;
            document.getElementById('page-count').textContent = pdf.numPages;
            renderPage(pageNum);

            hideInProgress();
        }).catch(error => {
            hideInProgress();
            //messagePopup({ message:'Error loading PDF: ' + error });
            alert({ message:'Error loading PDF: ' + error });
        });
    </script>
@endsection
