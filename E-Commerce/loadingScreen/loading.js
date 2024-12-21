window.onload = function() {
    // GSAP Animations

    // Animate logo grow effect
    gsap.fromTo('.logo', { scale: 0.5, opacity: 0 }, { scale: 1, opacity: 1, duration: 1, ease: 'power2.out' });

    // Animate the progress bar filling up
    gsap.to('.progress', { width: '100%', duration: 3, ease: 'power2.out', onComplete: showMainContent });

    // Function to hide the loading screen and show main content
    function showMainContent() {
        // Fade out the loading screen
        gsap.to('#loading-screen', { opacity: 0, duration: 2, onComplete: function() {
            document.getElementById('loading-screen').style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
            gsap.from('#main-content', { opacity: 0, y: 50, duration: 2, ease: 'power2.out' });
        }});
    }
};
