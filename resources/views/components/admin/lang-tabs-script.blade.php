@props([
    'tabsSelector',
    'panelsSelector',
])

@push('admin-scripts')
    <script>
        $(function() {
            const $tabs = $(@json($tabsSelector));
            const $panels = $(@json($panelsSelector));

            function activateLang(lang) {
                $tabs.each(function() {
                    const isActive = $(this).data('lang') === lang;
                    $(this).toggleClass('active', isActive).toggleClass('text-body-tertiary', !isActive);
                });
                $panels.each(function() {
                    $(this).toggleClass('d-none', $(this).data('lang-panel') !== lang);
                });
            }

            $tabs.on('click', function() {
                activateLang($(this).data('lang'));
            });

            activateLang('uz');
        });
    </script>
@endpush
