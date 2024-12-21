
gsap.registerPlugin(ScrollTrigger); 

// Staggered image animations on page load
gsap.fromTo('.product-image', { opacity: 0, scale: 0.8 }, { opacity: 1, scale: 1, duration: 0.8, stagger: 0.2 }); 

// ScrollTrigger animation for product cards
gsap.utils.toArray('.product').forEach(product => {
    gsap.fromTo(product, { y: 50, opacity: 0 }, { 
        y: 0, 
        opacity: 1, 
        duration: 1, 
        ease: 'power2.out', 
        scrollTrigger: {
            trigger: product, 
            start: "top 80%", 
            end: "top center", 
            scrub: 2 
        }
    });
});

// Hover animation for product images
gsap.utils.toArray('.product-image-container').forEach(container => {
    container.addEventListener('mouseenter', () => {
        gsap.to(container.querySelector('.product-image'), { 
            scale: 1.1, 
            duration: 0.2 
        });
    });

    container.addEventListener('mouseleave', () => {
        gsap.to(container.querySelector('.product-image'), { 
            scale: 1, 
            duration: 0.2 
        });
    });
});