@props([
    /** jQuery selector for tab triggers, e.g. #about-lang-tabs-create [data-lang] */
    'tabsSelector',
    /** jQuery selector for language panels (rows), e.g. .about-lang-panel */
    'panelsSelector',
])

@push('admin-scripts')
    @once('admin-summernote-uz-lang')
        <script src="/admin/summernote/lang/summernote-uz-UZ.min.js"></script>
    @endonce
    <script>
        $(function() {
            const toolbar = [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ];

            function summernoteOptions(heightPx) {
                return {
                    lang: 'uz-UZ',
                    placeholder: 'Matnni kiriting...',
                    tabsize: 2,
                    height: heightPx,
                    toolbar: toolbar,
                    dialogsInBody: true
                };
            }

            function initRichTextInPanel($panel) {
                const $ta = $panel.find('textarea.js-admin-summernote');
                if (!$ta.length || $ta.next('.note-editor').length) {
                    return;
                }
                const height = parseInt($ta.data('editorHeight'), 10) || 400;
                $ta.summernote(summernoteOptions(height));
            }

            const $tabs = $(@json($tabsSelector));
            const $panels = $(@json($panelsSelector));

            function activateLang(lang) {
                $tabs.each(function() {
                    const isActive = $(this).data('lang') === lang;
                    $(this).toggleClass('active', isActive).toggleClass('text-body-tertiary', !isActive);
                });
                $panels.each(function() {
                    const match = $(this).data('lang-panel') === lang;
                    $(this).toggleClass('d-none', !match);
                    if (match) {
                        initRichTextInPanel($(this));
                    }
                });
            }

            $tabs.on('click', function() {
                activateLang($(this).data('lang'));
            });

            activateLang('uz');
        });
    </script>
@endpush
