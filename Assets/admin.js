const navLinkEls = document.querySelectorAll('.buttonss');

navLinkEls.forEach(navLinkEl => {
    // Check if the current URL path matches the href of the link
    if (window.location.pathname.includes(navLinkEl.getAttribute('href'))) {
        navLinkEl.classList.add('active');
    }

    // Add click event listener to update the active class on click
    navLinkEl.addEventListener('click', () => {
        document.querySelector('.active')?.classList.remove('active');
        navLinkEl.classList.add('active');
    });
});
//RESERVE
document.addEventListener('DOMContentLoaded', (event) => {
    const viewButtons = document.querySelectorAll('.view_button');
    const informationViews = document.querySelectorAll('.information_view');

    viewButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            // Check if the clicked information view is already active
            const isActive = informationViews[index].classList.contains('active');
            
            // Remove active class from all information views
            informationViews.forEach(view => {
                view.classList.remove('active');
            });

            // Toggle the active class on the clicked information view
            if (!isActive) {
                informationViews[index].classList.add('active');
            }
        });
    });
});
