document.addEventListener('DOMContentLoaded', function () {
    const languageToggle = document.getElementById('languageToggle');
    const languageDropdown = document.getElementById('languageDropdown');
    const languageOptions = document.querySelectorAll('.language-option');

    languageToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        languageDropdown.classList.toggle('show');
        this.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        if (!languageToggle.contains(e.target) && !languageDropdown.contains(e.target)) {
            languageDropdown.classList.remove('show');
            languageToggle.classList.remove('active');
        }
    });

    languageOptions.forEach(option => {
        option.addEventListener('click', function () {
            const selectedFlag = this.querySelector('img').src;
            const selectedLang = this.getAttribute('data-lang');
            const selectedText = this.querySelector('span').textContent.substring(0, 2).toUpperCase();

            languageToggle.querySelector('img').src = selectedFlag;
            languageToggle.querySelector('.language-title').textContent = selectedText;

            languageDropdown.classList.remove('show');
            languageToggle.classList.remove('active');
        });
    });
});





// filter


function toggleFilter() {
    var filterSection = document.getElementById("filter-section");
    var filterIcon = document.getElementById("filter-icon");

    if (filterSection.classList.contains("show")) {
        filterSection.classList.remove("show");
        filterIcon.style.transform = "rotate(0deg)";
    } else {
        filterSection.classList.add("show");
        filterIcon.style.transform = "rotate(180deg)";
    }
}

function toggleFilter() {
    var filterSection = document.getElementById("filter-section");
    var filterIcon = document.getElementById("filter-icon");

    if (filterSection.style.display === "none") {
        filterSection.style.display = "block";
        filterIcon.classList.remove("fa-chevron-down");
        filterIcon.classList.add("fa-chevron-up");
    } else {
        filterSection.style.display = "none";
        filterIcon.classList.remove("fa-chevron-up");
        filterIcon.classList.add("fa-chevron-down");
    }
}


