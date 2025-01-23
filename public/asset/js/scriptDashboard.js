const body = document.querySelector("body"),
    modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode === "dark") {
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus === "close") {
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        localStorage.setItem("mode", "dark");
    } else {
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        localStorage.setItem("status", "close");
    } else {
        localStorage.setItem("status", "open");
    }
});

function openDeleteModal(id, name, route) {
    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const deleteItemName = document.getElementById("deleteItemName");

    // Set nama item di konfirmasi
    deleteItemName.textContent = name;

    // Set action form dengan route dinamis
    deleteForm.action = route;

    // Tampilkan modal
    deleteModal.style.display = "block";
}

function closeDeleteModal() {
    const deleteModal = document.getElementById("deleteModal");
    deleteModal.style.display = "none";
}

// Tutup modal jika diklik di luar area modal
window.onclick = function (event) {
    const deleteModal = document.getElementById("deleteModal");
    if (event.target == deleteModal) {
        deleteModal.style.display = "none";
    }
};
