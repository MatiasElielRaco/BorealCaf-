(function(){

    // Sidebar module
    const menuBtn = document.querySelector('.dashboard__menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.querySelector('.sidebar__backdrop');

    if(menuBtn && sidebar && backdrop) {
        const openSidebar = () => {
            sidebar.classList.add('sidebar--open');
            backdrop.classList.add('sidebar__backdrop--visible');
            menuBtn.setAttribute('aria-expanded', 'true');
            document.body.classList.add('no-scroll');
        }

        const closeSidebar = () => {
            sidebar.classList.remove('sidebar--open');
            backdrop.classList.remove('sidebar__backdrop--visible');
            menuBtn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('no-scroll');
        }

        menuBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const expanded = menuBtn.getAttribute('aria-expanded') === 'true';
            if(expanded) closeSidebar(); else openSidebar();
        });

        backdrop.addEventListener('click', (e) => {
            e.preventDefault();
            closeSidebar();
        });

        // Close on ESC
        document.addEventListener('keydown', (e) => {
            if(e.key === 'Escape') {
                closeSidebar();
            }
        });
    }

})();