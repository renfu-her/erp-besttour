<script>
    $(document).ready(function() {
        // 側邊欄切換
        $('#sidebarToggle').click(function() {
            const sidebar = $('#sidebar');
            const mainContent = $('#main-content');

            if ($(window).width() <= 576) {
                sidebar.toggleClass('expanded');
                $('body').toggleClass('overflow-hidden');
            } else {
                sidebar.toggleClass('collapsed');
                mainContent.toggleClass('expanded');
            }
        });

        // 移動裝置關閉側邊欄
        $('#closeSidebar').click(function() {
            $('#sidebar').removeClass('expanded');
            $('body').removeClass('overflow-hidden');
        });

        // 點擊側邊欄外的區域關閉側邊欄
        $(document).on('click', function(e) {
            if ($(window).width() <= 576) {
                const sidebar = $('#sidebar');
                if (!$(e.target).closest('#sidebar, #sidebarToggle').length && sidebar.hasClass('expanded')) {
                    sidebar.removeClass('expanded');
                    $('body').removeClass('overflow-hidden');
                }
            }
        });

        // 深色/淺色模式切換
        $('#themeToggle').click(function() {
            const html = $('html');
            const icon = $(this).find('i');

            if (html.attr('data-bs-theme') === 'dark') {
                html.attr('data-bs-theme', 'light');
                icon.removeClass('bi-sun').addClass('bi-moon-stars');
            } else {
                html.attr('data-bs-theme', 'dark');
                icon.removeClass('bi-moon-stars').addClass('bi-sun');
            }
        });

        // 視窗大小改變時的處理
        $(window).resize(function() {
            const width = $(window).width();
            const sidebar = $('#sidebar');
            const mainContent = $('#main-content');

            if (width <= 576) {
                sidebar.removeClass('collapsed');
                mainContent.removeClass('expanded');
            }
        });
    });
</script> 