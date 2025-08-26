<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Professional Studies | Advanced Learning Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #002366;
            --secondary: #FFD700;
            --accent: #4169E1;
            --light: #F5F5F5;
            --dark: #333333;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Header with animation */
        header {
            background: linear-gradient(135deg, var(--primary) 0%, #00008B 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            animation: fadeInDown 0.8s ease-out;
        }
        
        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 50px;
            margin-right: 15px;
        }
        
        .logo-text h1 {
            font-size: 1.5rem;
            margin: 0;
        }
        
        .logo-text p {
            font-size: 0.8rem;
            margin: 0;
            opacity: 0.8;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        .nav-links a:hover {
            color: var(--secondary);
        }
        
        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--secondary);
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }
        
        .nav-links a:hover:after {
            width: 100%;
        }
        
        /* Hero Section */
        .hero {
            background: url('images/upsa4.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            margin-top: 70px;
        }
        
        .hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 35, 102, 0.7);
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 2rem;
            animation: fadeInUp 1s ease-out;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        /* Login Buttons Section */
        .login-section {
            padding: 5rem 2rem;
            background-color: var(--light);
            text-align: center;
        }
        
        .section-title {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: var(--secondary);
            bottom: -10px;
            left: 25%;
        }
        
        .login-options {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 280px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .login-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .login-card i {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }
        
        .login-card h3 {
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .login-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .btn {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid white;
            margin-left: 1rem;
        }
        
        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }
        
        /* Testimonials */
        .testimonials {
            padding: 5rem 2rem;
            background-color: white;
            text-align: center;
        }
        
        .testimonial-container {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }
        
        .testimonial-slide {
            padding: 2rem;
            display: none;
            animation: fadeIn 1s ease-out;
        }
        
        .testimonial-slide.active {
            display: block;
        }
        
        .testimonial-content {
            background: var(--light);
            padding: 2rem;
            border-radius: 8px;
            position: relative;
            margin-bottom: 2rem;
        }
        
        .testimonial-content:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 15px 15px 0;
            border-style: solid;
            border-color: var(--light) transparent transparent;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .testimonial-author img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 3px solid var(--secondary);
        }
        
        .author-info h4 {
            margin: 0;
            color: var(--primary);
        }
        
        .author-info p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }
        
        .testimonial-nav {
            margin-top: 2rem;
        }
        
        .testimonial-nav button {
            background: var(--light);
            border: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .testimonial-nav button.active {
            background: var(--accent);
            transform: scale(1.2);
        }
        
        /* About Section */
        .about {
            padding: 5rem 2rem;
            background-color: var(--light);
        }
        
        .about-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        
        .about-image {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .about-image img {
            width: 100%;
            display: block;
            transition: transform 0.5s;
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        .about-image:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--primary), transparent);
            opacity: 0.3;
            z-index: 1;
        }
        
        .about-content h2 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .about-content p {
            margin-bottom: 1.5rem;
            color: #555;
        }
        
        /* Contact Section */
        .contact {
            padding: 5rem 2rem;
            background-color: white;
        }
        
        .contact-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }
        
        .contact-info h3 {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .contact-details {
            margin-bottom: 2rem;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .contact-item i {
            color: var(--accent);
            font-size: 1.2rem;
            margin-right: 1rem;
            margin-top: 5px;
        }
        
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        
        .contact-form textarea {
            height: 150px;
            resize: vertical;
        }
        
        /* Footer */
        footer {
            background: var(--primary);
            color: white;
            padding: 3rem 2rem 1rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: left;
        }
        
        .footer-column h3 {
            color: var(--secondary);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-column ul li {
            margin-bottom: 0.8rem;
        }
        
        .footer-column ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-links a {
            color: white;
            background: rgba(255,255,255,0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--secondary);
            color: var(--primary);
            transform: translateY(-3px);
        }
        
        .copyright {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
            color: #aaa;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .about-container,
            .contact-container {
                grid-template-columns: 1fr;
            }
            
            .about-image {
                order: -1;
            }
        }

        .contact-form-map {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.map-container {
    margin-top: 2rem;
}

.map-container h3 {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.map {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .contact-form-map {
        gap: 1.5rem;
    }
    
    .map-container {
        margin-top: 1.5rem;
    }
}
    </style>
</head>
<body>
    <!-- Header with Navigation -->
    <header>
        <nav>
            <div class="logo">
                <img src="images/download.png" alt="University Logo">
                <div class="logo-text">
                    <h1>University of Professional Studies</h1>
                    <p>Excellence in Professional Education</p>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#programs">Programs</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Advance Your Professional Career</h1>
            <p>Join our world-class professional programs designed to give you the competitive edge in today's dynamic job market.</p>
            <div>
                <a href="index.php?r=site/login" class="btn">Apply Now</a>
                <a href="index.php?r=site/homep" class="btn btn-outline">Explore Programs</a>
            </div>
        </div>
    </section>

    <!-- Login Options Section -->
    <section class="login-section" id="login">
        <h2 class="section-title">Access Your Account</h2>
        <div class="login-options">
            <div class="login-card">
                <i class="fas fa-user-graduate"></i>
                <h3>Student Portal</h3>
                <p>Access your courses, grades, and academic resources through our secure student portal.</p>
                <a href="http://uips.upsasys.com" class="btn">Login</a>
            </div>
            <div class="login-card">
                <i class="fas fa-file-signature"></i>
                <h3>Apply with OSN</h3>
                <p>Start your application process through our Online Student Network (OSN) portal.</p>
                <a href="#" class="btn">Apply Now</a>
            </div>
            <div class="login-card">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Faculty Login</h3>
                <p>Faculty members can access the teaching portal to manage courses and students.</p>
                <a href="#" class="btn">Login</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <h2 class="section-title">Success Stories</h2>
        <div class="testimonial-container">
            <div class="testimonial-slide active">
                <div class="testimonial-content">
                    <p>"The professional program at UPS transformed my career. The practical skills I gained allowed me to get promoted within six months of completing the course."</p>
                </div>
                <div class="testimonial-author">
                    <img src="images/p1.jpg" alt="Sarah Johnson">
                    <div class="author-info">
                        <h4>Sarah Johnson</h4>
                        <p>MBA Graduate, 2022</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-slide">
                <div class="testimonial-content">
                    <p>"The industry connections I made through this program were invaluable. I landed my dream job before I even graduated!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="images/p1.jpg" alt="Michael Chen">
                    <div class="author-info">
                        <h4>Michael Chen</h4>
                        <p>Data Science Professional, 2021</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-slide">
                <div class="testimonial-content">
                    <p>"The flexible scheduling allowed me to work full-time while advancing my education. The perfect balance for working professionals."</p>
                </div>
                <div class="testimonial-author">
                    <img src="images/p1.jpg" alt="Amina Diallo">
                    <div class="author-info">
                        <h4>Amina Diallo</h4>
                        <p>Executive Leadership Program, 2023</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-nav">
                <button class="active"></button>
                <button></button>
                <button></button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-container">
            <div class="about-content">
                <h2 class="section-title">About Our University</h2>
                <p>The University of Professional Studies (UPS) is a premier institution dedicated to providing cutting-edge professional education that bridges the gap between academia and industry.</p>
                <p>Founded in 1995, we have grown to become a leader in professional development, offering programs that are designed in collaboration with industry experts to ensure our graduates are job-ready.</p>
                <p>Our faculty consists of experienced professionals who bring real-world insights into the classroom, creating a dynamic learning environment that fosters both theoretical understanding and practical application.</p>
                <a href="#" class="btn">Learn More</a>
            </div>
            <div class="about-image">
                <img src="images/upsa3.jpg" alt="University Campus">
            </div>
        </div>
    </section>

    <!-- Contact Section -->
     <!-- Contact Section -->
<section class="contact" id="contact">
    <h2 class="section-title">Contact Us</h2>
    <div class="contact-container">
        <div class="contact-info">
            <h3>Get in Touch</h3>
            <div class="contact-details">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Location</h4>
                        <p>123 Education Avenue<br>Professional District, PD 10101</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h4>Phone</h4>
                        <p>+1 (555) 123-4567<br>Admissions: +1 (555) 123-4568</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>Email</h4>
                        <p>info@ups.edu<br>admissions@ups.edu</p>
                    </div>
                </div>
            </div>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="contact-form-map">
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form>
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <input type="text" placeholder="Subject">
                    <textarea placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
            <div class="map-container">
                <h3>Our Location</h3>
                <div class="map">
                    <!-- Replace the src with your actual Google Maps embed URL -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.805156715077!2d-0.2207124242245205!3d5.603102994385082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9f1fc7e5e345%3A0x6a1fc7a3b02d4f9e!2sUniversity%20of%20Professional%20Studies%2C%20Accra!5e0!3m2!1sen!2sgh!4v1620000000000!5m2!1sen!2sgh" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- <section class="contact" id="contact">
        <h2 class="section-title">Contact Us</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Get in Touch</h3>
                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Location</h4>
                            <p>123 Education Avenue<br>Professional District, PD 10101</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+1 (555) 123-4567<br>Admissions: +1 (555) 123-4568</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>info@ups.edu<br>admissions@ups.edu</p>
                        </div>
                    </div>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form>
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <input type="text" placeholder="Subject">
                    <textarea placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </section> -->

    
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About UPS</a></li>
                    <li><a href="#programs">Programs</a></li>
                    <li><a href="#admissions">Admissions</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Academic</h3>
                <ul>
                    <li><a href="#">Academic Calendar</a></li>
                    <li><a href="#">Course Catalog</a></li>
                    <li><a href="#">Library</a></li>
                    <li><a href="#">Research</a></li>
                    <li><a href="#">Faculty Directory</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Student Resources</h3>
                <ul>
                    <li><a href="#">Student Portal</a></li>
                    <li><a href="#">Career Services</a></li>
                    <li><a href="#">Alumni Network</a></li>
                    <li><a href="#">Financial Aid</a></li>
                    <li><a href="#">Student Handbook</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <p style="margin-top: 1rem;">Subscribe to our newsletter</p>
                <form style="display: flex;">
                    <input type="email" placeholder="Your email" style="flex-grow: 1; padding: 0.5rem; border: none; border-radius: 4px 0 0 4px;">
                    <button type="submit" style="background: var(--secondary); color: var(--primary); border: none; padding: 0 1rem; border-radius: 0 4px 4px 0; cursor: pointer;"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 University of Professional Studies. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Testimonial slider functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.testimonial-slide');
            const buttons = document.querySelectorAll('.testimonial-nav button');
            let currentSlide = 0;
            
            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                buttons.forEach(button => button.classList.remove('active'));
                
                currentSlide = (n + slides.length) % slides.length;
                slides[currentSlide].classList.add('active');
                buttons[currentSlide].classList.add('active');
            }
            
            buttons.forEach((button, index) => {
                button.addEventListener('click', () => showSlide(index));
            });
            
            // Auto-advance slides every 5 seconds
            setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000);
            
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>