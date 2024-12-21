
        // Animation on load
        gsap.from(".form-container", {
            opacity: 0,
            y: -50,
            duration: 1.5,
            ease: "power4.out"
        });

        // Animation for form fields
        gsap.from(".input-group", {
            opacity: 0,
            y: 20,
            stagger: 0.2,
            duration: 1,
            ease: "power4.out"
        });

        // Button hover effect
        const button = document.querySelector("button");
        button.addEventListener("mouseover", () => {
            gsap.to(button, {
                scale: 1.1,
                backgroundColor: "#0056b3",
                duration: 0.3
            });
        });
        button.addEventListener("mouseout", () => {
            gsap.to(button, {
                scale: 1,
                backgroundColor: "#007bff",
                duration: 0.3
            });
        });
    
