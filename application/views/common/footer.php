<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-building"></i> BusinessHub</h5>
                <p>Your trusted partner for business growth and customer discovery.</p>
            </div>
            <div class="col-lg-2 mb-4">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">Home</a></li>
                    <li><a href="#" class="text-white-50">About</a></li>
                    <li><a href="#" class="text-white-50">Pricing</a></li>
                    <li><a href="#" class="text-white-50">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2 mb-4">
                <h6 class="fw-bold mb-3">For Businesses</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">List Business</a></li>
                    <li><a href="#" class="text-white-50">Get Verified</a></li>
                    <li><a href="#" class="text-white-50">Premium</a></li>
                    <li><a href="#" class="text-white-50">Support</a></li>
                </ul>
            </div>
            <div class="col-lg-2 mb-4">
                <h6 class="fw-bold mb-3">For Customers</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">Search</a></li>
                    <li><a href="#" class="text-white-50">Reviews</a></li>
                    <li><a href="#" class="text-white-50">Mobile App</a></li>
                    <li><a href="#" class="text-white-50">Help</a></li>
                </ul>
            </div>
            <div class="col-lg-2 mb-4">
                <h6 class="fw-bold mb-3">Connect</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="text-white-50"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center text-white-50">
            <p>&copy; <?php echo date('Y'); ?> Bizness. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Search functionality
    document.querySelector('.search-btn').addEventListener('click', function() {
        const searchTerm = document.querySelector('.search-input').value;
        if (searchTerm.trim()) {
            // Simulate search (in real app, this would make an API call)
            alert(`Searching for: ${searchTerm}`);
        }
    });

    // Add enter key support for search
    document.querySelectorAll('.search-input').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-btn').click();
            }
        });
    });

    // Business card hover effects
    document.querySelectorAll('.business-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            navbar.style.backdropFilter = 'blur(10px)';
        } else {
            navbar.style.backgroundColor = 'white';
            navbar.style.backdropFilter = 'none';
        }
    });

    // Counter animation for stats
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start).toLocaleString();
            }
        }, 16);
    }

    // Animate counters when they come into view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statsNumber = entry.target.querySelector('.stats-number');
                const target = parseInt(statsNumber.textContent.replace(/[^0-9]/g, ''));
                animateCounter(statsNumber, target);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stats-card').forEach(card => {
        statsObserver.observe(card);
    });

    // Mobile menu close on link click
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });
</script>
<!-- <script id="dhws-dataInjector" src="/public/dhws-data-injector.js"></script> -->
