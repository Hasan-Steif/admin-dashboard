document.addEventListener('DOMContentLoaded', function () {
    // Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebarIcon = document.getElementById('sidebar-icon');

    if (toggleBtn && sidebar && sidebarIcon) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('-ml-64');
            sidebar.classList.toggle('ml-0');
            sidebarIcon.classList.toggle('fa-bars');
            sidebarIcon.classList.toggle('fa-times');
        });
    }

    // Notification Toggle
    const bellBtn = document.getElementById('toggle-notifications');
    const notificationPanel = document.getElementById('notifications');
    const clearBtn = document.getElementById('clear-notifications');

    if (bellBtn && notificationPanel) {
        bellBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            notificationPanel.classList.toggle('notification-hidden');
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                notificationPanel.classList.add('notification-hidden');
            });
        }

        document.addEventListener('click', function (e) {
            if (!notificationPanel.contains(e.target) && !bellBtn.contains(e.target)) {
                notificationPanel.classList.add('notification-hidden');
            }
        });
    }
});
