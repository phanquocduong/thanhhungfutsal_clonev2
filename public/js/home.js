function slideshowLogic() {
    let slideIndex = 0;

    function showSlides(n) {
        const slides = document.querySelector('.slides');
        const slideCount = document.querySelectorAll('.slide').length;

        if (n >= slideCount) {
            slideIndex = 0;
        } else if (n < 0) {
            slideIndex = slideCount - 1;
        }

        slides.style.transform = `translateX(${-slideIndex * 100}%)`;
    }

    function changeSlide(n) {
        slideIndex += n;
        showSlides(slideIndex);
    }

    document.querySelector('.slideshow-prev').addEventListener('click', () => changeSlide(-1));
    document.querySelector('.slideshow-next').addEventListener('click', () => changeSlide(1));

    setInterval(() => {
        changeSlide(1);
    }, 5000);

    showSlides(slideIndex);
}

slideshowLogic();

// Chọn tất cả tiêu đề tab và nội dung tab
const tabTitles = document.querySelectorAll('.featured-category__title');
const tabContents = document.querySelectorAll('.featured-category__products');

// Hàm xóa class 'active' khỏi tất cả tiêu đề và nội dung
function clearActiveClasses() {
    tabTitles.forEach(title => title.classList.remove('featured-category__title--active'));
    tabContents.forEach(content => content.classList.remove('featured-category__products--active'));
}

// Thêm sự kiện click cho từng tiêu đề tab
tabTitles.forEach((title, index) => {
    title.addEventListener('click', () => {
        // Xóa class 'active' trước đó
        clearActiveClasses();

        // Thêm class 'active' cho tab tiêu đề và nội dung hiện tại
        title.classList.add('featured-category__title--active');
        tabContents[index].classList.add('featured-category__products--active');
    });
});
