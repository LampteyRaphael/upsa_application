<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Programs | University of Professional Studies</title>
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
        
        /* Page Header */
        .page-header {
            background: url('images/upsa4.jpg') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            margin-top: 70px;
        }
        
        .page-header:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 35, 102, 0.7);
        }
        
        .page-header-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 2rem;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .breadcrumb {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            font-size: 0.9rem;
        }
        
        .breadcrumb li {
            margin: 0 0.5rem;
        }
        
        .breadcrumb li:after {
            content: '›';
            margin-left: 1rem;
            color: var(--secondary);
        }
        
        .breadcrumb li:last-child:after {
            content: '';
        }
        
        .breadcrumb a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .breadcrumb a:hover {
            color: var(--secondary);
        }
        
        /* Programs Filter */
        .programs-filter {
            background: var(--light);
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .filter-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .filter-group {
            margin-bottom: 1rem;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary);
        }
        
        .filter-group select, 
        .filter-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        
        .filter-actions {
            display: flex;
            align-items: flex-end;
        }
        
        .btn {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            margin-left: 1rem;
        }
        
        .btn-outline:hover {
            background: var(--accent);
            color: white;
        }
        
        /* Programs Grid */
        .programs-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
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
        
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .program-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .program-image {
            height: 200px;
            overflow: hidden;
        }
        
        .program-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .program-card:hover .program-image img {
            transform: scale(1.1);
        }
        
        .program-content {
            padding: 1.5rem;
        }
        
        .program-category {
            display: inline-block;
            background: var(--light);
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }
        
        .program-title {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
            color: var(--primary);
        }
        
        .program-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .program-meta span {
            display: flex;
            align-items: center;
        }
        
        .program-meta i {
            margin-right: 0.5rem;
            color: var(--accent);
        }
        
        .program-excerpt {
            margin-bottom: 1.5rem;
            color: #555;
        }
        
        .program-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .program-link {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .program-link:hover {
            color: var(--primary);
            text-decoration: underline;
        }
        
        .program-duration {
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Featured Program */
        .featured-program {
            background: linear-gradient(135deg, var(--primary) 0%, #00008B 100%);
            color: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        
        .featured-content {
            padding: 3rem;
        }
        
        .featured-badge {
            display: inline-block;
            background: var(--secondary);
            color: var(--primary);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .featured-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        .featured-excerpt {
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .featured-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .featured-meta-item {
            display: flex;
            align-items: center;
        }
        
        .featured-meta-item i {
            margin-right: 0.8rem;
            color: var(--secondary);
            font-size: 1.2rem;
        }
        
        .featured-image {
            position: relative;
        }
        
        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .featured-image:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to left, rgba(0,35,102,0.8), transparent);
        }
        
        /* Program Categories */
        .categories-section {
            padding: 4rem 2rem;
            background: var(--light);
        }
        
        .categories-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .category-card {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
        }
        
        .category-icon {
            width: 70px;
            height: 70px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--accent);
            font-size: 1.8rem;
        }
        
        .category-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .category-count {
            color: #666;
            font-size: 0.9rem;
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
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .featured-program {
                grid-template-columns: 1fr;
            }
            
            .featured-image {
                order: -1;
                height: 300px;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
            
            .filter-container {
                grid-template-columns: 1fr;
            }
            
            .programs-grid {
                grid-template-columns: 1fr;
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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="programs.html" class="active">Programs</a></li>
                <li><a href="testimonials.html">Testimonials</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="index.php?r=site/login" class="btn">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-content">
            <h1>Our Professional Programs</h1>
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Programs</li>
            </ul>
        </div>
    </section>

    <!-- Programs Filter -->
    <section class="programs-filter">
        <div class="filter-container">
            <div class="filter-group">
                <label for="program-level">Program Level</label>
                <select id="program-level">
                    <option value="">All Levels</option>
                    <option value="certificate">Certificate</option>
                    <option value="diploma">Diploma</option>
                    <option value="bachelors">Bachelor's Degree</option>
                    <option value="masters">Master's Degree</option>
                    <option value="phd">Doctoral Degree</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="program-field">Field of Study</label>
                <select id="program-field">
                    <option value="">All Fields</option>
                    <option value="business">Business Administration</option>
                    <option value="technology">Information Technology</option>
                    <option value="health">Health Sciences</option>
                    <option value="engineering">Engineering</option>
                    <option value="education">Education</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="program-duration">Duration</label>
                <select id="program-duration">
                    <option value="">Any Duration</option>
                    <option value="3months">3-6 Months</option>
                    <option value="1year">1 Year</option>
                    <option value="2years">2 Years</option>
                    <option value="4years">4 Years</option>
                </select>
            </div>
            <div class="filter-actions">
                <button class="btn">Filter Programs</button>
                <button class="btn btn-outline">Reset</button>
            </div>
        </div>
    </section>

    <!-- Featured Program -->
    <section class="programs-section">
        <div class="featured-program">
            <div class="featured-content">
                <span class="featured-badge">Featured Program</span>
                <h2 class="featured-title">Executive MBA in Digital Transformation</h2>
                <p class="featured-excerpt">Designed for professionals aiming to lead in the digital age, this program combines traditional business acumen with cutting-edge digital strategies.</p>
                <div class="featured-meta">
                    <div class="featured-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>24 Months</span>
                    </div>
                    <div class="featured-meta-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Master's Degree</span>
                    </div>
                    <div class="featured-meta-item">
                        <i class="fas fa-building"></i>
                        <span>Hybrid (Online/On-campus)</span>
                    </div>
                </div>
                <a href="#" class="btn">Learn More</a>
            </div>
            <div class="featured-image">
                <img src="mba-program.jpg" alt="Executive MBA Program">
            </div>
        </div>

        <h2 class="section-title">All Professional Programs</h2>
        
        <div class="programs-grid">
            <!-- Program Card 1 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="data-science.jpg" alt="Data Science Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Information Technology</span>
                    <h3 class="program-title">Professional Certificate in Data Science</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 6 Months</span>
                        <span><i class="fas fa-user-graduate"></i> Certificate</span>
                    </div>
                    <p class="program-excerpt">Gain hands-on experience with data analysis, machine learning, and visualization tools used by industry professionals.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: Jan 2024</span>
                    </div>
                </div>
            </div>
            
            <!-- Program Card 2 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="healthcare.jpg" alt="Healthcare Management Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Health Sciences</span>
                    <h3 class="program-title">Master of Healthcare Administration</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 2 Years</span>
                        <span><i class="fas fa-user-graduate"></i> Master's Degree</span>
                    </div>
                    <p class="program-excerpt">Develop leadership skills specifically for the healthcare sector with our industry-aligned curriculum.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: Mar 2024</span>
                    </div>
                </div>
            </div>
            
            <!-- Program Card 3 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="cybersecurity.jpg" alt="Cybersecurity Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Information Technology</span>
                    <h3 class="program-title">Advanced Diploma in Cybersecurity</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 12 Months</span>
                        <span><i class="fas fa-user-graduate"></i> Diploma</span>
                    </div>
                    <p class="program-excerpt">Learn to protect digital assets with our comprehensive cybersecurity program featuring industry certifications.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: Feb 2024</span>
                    </div>
                </div>
            </div>
            
            <!-- Program Card 4 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="project-management.jpg" alt="Project Management Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Business Administration</span>
                    <h3 class="program-title">Professional Project Management</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 8 Months</span>
                        <span><i class="fas fa-user-graduate"></i> Certificate</span>
                    </div>
                    <p class="program-excerpt">Master project management methodologies and earn PMP certification preparation with this intensive program.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: Jan 2024</span>
                    </div>
                </div>
            </div>
            
            <!-- Program Card 5 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="engineering.jpg" alt="Engineering Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Engineering</span>
                    <h3 class="program-title">Bachelor of Engineering Technology</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 4 Years</span>
                        <span><i class="fas fa-user-graduate"></i> Bachelor's Degree</span>
                    </div>
                    <p class="program-excerpt">Combine engineering principles with practical applications in this career-focused degree program.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: Sep 2024</span>
                    </div>
                </div>
            </div>
            
            <!-- Program Card 6 -->
            <div class="program-card">
                <div class="program-image">
                    <img src="education.jpg" alt="Education Program">
                </div>
                <div class="program-content">
                    <span class="program-category">Education</span>
                    <h3 class="program-title">Postgraduate Diploma in Education</h3>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> 1 Year</span>
                        <span><i class="fas fa-user-graduate"></i> Diploma</span>
                    </div>
                    <p class="program-excerpt">For graduates who want to transition into teaching with professional qualifications.</p>
                    <div class="program-actions">
                        <a href="#" class="program-link">View Details</a>
                        <span class="program-duration">Next intake: May 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Categories -->
    <section class="categories-section">
        <div class="categories-container">
            <h2 class="section-title">Browse by Category</h2>
            <div class="categories-grid">
                <!-- Category 1 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="category-title">Business Administration</h3>
                    <p class="category-count">12 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
                
                <!-- Category 2 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="category-title">Information Technology</h3>
                    <p class="category-count">8 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
                
                <!-- Category 3 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="category-title">Health Sciences</h3>
                    <p class="category-count">6 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
                
                <!-- Category 4 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="category-title">Engineering</h3>
                    <p class="category-count">5 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
                
                <!-- Category 5 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="category-title">Education</h3>
                    <p class="category-count">4 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
                
                <!-- Category 6 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="category-title">Law & Policy</h3>
                    <p class="category-count">3 Programs</p>
                    <a href="#" class="program-link">View All</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About UPS</a></li>
                    <li><a href="programs.html">Programs</a></li>
                    <li><a href="admissions.html">Admissions</a></li>
                    <li><a href="contact.html">Contact</a></li>
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
        // Simple filter functionality demonstration
        document.addEventListener('DOMContentLoaded', function() {
            // This would be replaced with actual filtering logic in a production environment
            const filterBtn = document.querySelector('.programs-filter .btn');
            
            filterBtn.addEventListener('click', function() {
                alert('Filter functionality would be implemented here to show relevant programs based on selected filters.');
            });
            
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