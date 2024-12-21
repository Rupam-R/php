
<style>
    /* Footer styles */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
    animation: fadeInFooter 2s ease-out;
}

/* Footer text animation */
.footer-text {
    font-size: 1rem;
    font-weight: 300;
    letter-spacing: 1px;
    opacity: 0; /* Start invisible for fade-in effect */
    animation: fadeInText 2s ease-out forwards, bounceIn 1s ease-out 2s; /* Bounce starts after fade-in */
}

/* Fade-in effect for footer */
@keyframes fadeInFooter {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Fade-in effect for footer text */
@keyframes fadeInText {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Bounce effect after fade-in */
@keyframes bounceIn {
    0% {
        transform: translateY(30px);
    }
    50% {
        transform: translateY(-15px);
    }
    70% {
        transform: translateY(5px);
    }
    100% {
        transform: translateY(0);
    }
}

</style>
<footer>
    <link rel="stylesheet" href="css/stylefooter.css" defer>
    <p class="footer-text">&copy; 2024 E-Shop, All Rights Reserved.</p>
</footer>
