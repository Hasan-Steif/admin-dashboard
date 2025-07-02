import "./bootstrap";
import ApexCharts from "apexcharts";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.ApexCharts = ApexCharts;

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-sidebar");
    const sidebarIcon = document.getElementById("sidebar-icon");
    const mainContent = document.getElementById("main-content");
    mainContent.classList.toggle("ml-0");
    mainContent.classList.toggle("ml-64");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-ml-64");
        sidebar.classList.toggle("ml-0");
        sidebar.classList.toggle("hidden");
    });
});
