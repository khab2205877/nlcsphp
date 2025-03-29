document.addEventListener("DOMContentLoaded", function () {
    // Swiper
    // var swiper = new Swiper(".mySwiper", {
    //     slidesPerView: 4,
    //     slidesPerGroupSkip: 4,
    //     grabCursor: true,
    //     loop: true,
    //     breakpoints: {
    //         0: { slidesPerView: 1 },
    //         520: { slidesPerView: 2 },
    //         769: { slidesPerView: 3 },
    //         1000: { slidesPerView: 4 },
    //     },
    //     navigation: {
    //         nextEl: ".swiper-button-next",
    //         prevEl: ".swiper-button-prev",
    //     },
    // });

    // Search Toggle
    const searchToggle = document.querySelector(".searchToggle");
    if (searchToggle) {
        searchToggle.addEventListener("click", () => {
            searchToggle.classList.toggle("active");
        });
    }

    // Product quantity
    const decreaseBtn = document.querySelector(".btn-decrease");
    const increaseBtn = document.querySelector(".btn-increase");
    const quantityInput = document.querySelector("input[name='product-quantily']");

    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    }

    // Tabs & Accordions Sync
    const tabs = document.querySelectorAll(".nav-link");
    const accordions = document.querySelectorAll(".accordion-button");

    function syncContent() {
        document.querySelectorAll(".tab-pane").forEach(pane => {
            const content = document.querySelector(`.accordion-body[data-tab-content="${pane.id}"]`);
            if (content) {
                pane.innerHTML = content.innerHTML;
            }
        });
    }
    syncContent();

    function activateTabFromAccordion(accordionButton) {
        const targetId = accordionButton.getAttribute("data-bs-target").replace("#collapse", "#");
        const targetTab = document.querySelector(`.nav-link[href="${targetId}"]`);

        if (targetTab) {
            document.querySelector(".nav-link.active")?.classList.remove("active");
            targetTab.classList.add("active");
            new bootstrap.Tab(targetTab).show();
        }
    }

    function activateAccordionFromTab(tab) {
        const targetId = tab.getAttribute("href").replace("#", "#collapse");
        const targetAccordion = document.querySelector(targetId);

        if (targetAccordion) {
            new bootstrap.Collapse(targetAccordion);
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            activateAccordionFromTab(this);
        });
    });

    accordions.forEach(accordion => {
        accordion.addEventListener("click", function () {
            activateTabFromAccordion(this);
        });
    });
    // product collection
    const titles = document.querySelectorAll(".shop-sidebar .title");

    titles.forEach(title => {
        title.addEventListener("click", function () {
            const groupFilter = this.nextElementSibling;

            if (groupFilter.style.display === "none" || groupFilter.style.display === "") {
                groupFilter.style.display = "block";
                this.classList.add("minus");
            } else {
                groupFilter.style.display = "none";
                this.classList.remove("minus");
            }
        });
    });

    const items = document.querySelectorAll(".scrollbar .item");

    items.forEach(item => {
        item.addEventListener("click", function (event) {
            event.preventDefault();
            items.forEach(i => i.classList.remove("active"));
            this.classList.add("active");
        });
    });



    document.querySelectorAll(".filter-price label").forEach((label) => {
        label.addEventListener("click", function (event) {
            const checkbox = this.querySelector("input[type='checkbox']");
            if (!checkbox) return;

            if (checkbox.checked) {
                checkbox.checked = false;
                event.preventDefault(); 
            } else {
                document.querySelectorAll(".filter-price input[type='checkbox']").forEach(cb => cb.checked = false);
                checkbox.checked = true;
            }
        });
    });

    document.querySelectorAll(".filter-size label").forEach((label) => {
        label.addEventListener("click", function () {
            const checkbox = this.querySelector("input[type='checkbox']");
            const li = this.closest("li");

            if (!checkbox) return;

            checkbox.checked = !checkbox.checked;
            li.classList.toggle("active", checkbox.checked);
        });
    });



    const filterBtn = document.querySelector(".btn-filter-mob");
    const closeFilterBtn = document.querySelector(".close-filter");
    const sidebar = document.querySelector(".sidebar-collection");
    const body = document.body;

    let overlay = document.createElement("div");
    overlay.id = "site-overlay";
    overlay.style.position = "fixed";
    overlay.style.top = "0";
    overlay.style.left = "0";
    overlay.style.width = "100vw";
    overlay.style.height = "100vh";
    overlay.style.background = "rgba(0, 0, 0, 0.5)";
    overlay.style.opacity = "0";
    overlay.style.visibility = "hidden";
    overlay.style.transition = "opacity 0.3s ease, visibility 0.3s ease";
    overlay.style.zIndex = "999998";
    document.body.appendChild(overlay);

    function openSidebar() {
        if (window.innerWidth <= 990) {
            sidebar.classList.add("filter-active");
            overlay.style.opacity = "1";
            overlay.style.visibility = "visible";
            body.style.overflow = "hidden";
        }
    }

    function closeSidebar() {
        sidebar.classList.remove("filter-active");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
        body.style.overflow = "";
    }

    filterBtn.addEventListener("click", openSidebar);
    closeFilterBtn.addEventListener("click", closeSidebar);
    overlay.addEventListener("click", closeSidebar);

    function handleResize() {
        if (window.innerWidth >= 991) {
            sidebar.classList.remove("filter-active");
            overlay.style.opacity = "0";
            overlay.style.visibility = "hidden";
            body.style.overflow = "";
        }
    }

    window.addEventListener("resize", handleResize);

});