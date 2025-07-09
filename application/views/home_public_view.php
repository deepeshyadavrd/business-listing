
    <link rel="stylesheet" href="css/main.css">
    <style>
        :root {
            --primary-color: #2563EB;
            --primary-dark: #1D4ED8;
            --secondary-color: #64748B;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --light-gray: #F8FAFC;
            --border-color: #E2E8F0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1E293B;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 100px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .search-container {
            background: white;
            border-radius: 50px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            border: none;
            padding: 15px 20px;
            border-radius: 50px;
            color: #1E293B;
        }

        .search-input:focus {
            outline: none;
            box-shadow: none;
        }

        .search-btn {
            background: var(--primary-color);
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 20px;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 50px;
        }

        .business-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .business-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .business-image {
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .business-info {
            padding: 20px;
        }

        .business-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1E293B;
            margin-bottom: 5px;
        }

        .business-category {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .rating {
            color: #F59E0B;
            margin-bottom: 10px;
        }

        .business-location {
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .verified-badge {
            background: var(--success-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        .feature-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1E293B;
            margin-bottom: 15px;
        }

        .feature-description {
            color: var(--secondary-color);
            line-height: 1.6;
        }

        .cta-section {
            background: var(--light-gray);
            padding: 80px 0;
        }

        .cta-primary {
            background: var(--primary-color);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .cta-primary:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }

        .cta-secondary {
            background: white;
            color: var(--primary-color);
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin: 10px;
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .cta-secondary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .stats-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
        }

        .stats-label {
            color: var(--secondary-color);
            font-weight: 500;
        }

        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .testimonial-text {
            color: var(--secondary-color);
            font-style: italic;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: 600;
            color: #1E293B;
        }

        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: #1E293B !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .section-padding {
                padding: 60px 0;
            }
        }
    </style>
<section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="hero-content text-center">
                        <h1 class="display-3 fw-bold mb-4">Find & List Local Businesses</h1>
                        <p class="lead mb-5">Discover amazing local businesses or grow your own business with our comprehensive directory platform</p>
                        
                        <div class="search-container">
                            <form action="<?php echo base_url('listings/search'); ?>" method="GET">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control search-input" name="query" placeholder="Search businesses by name or category..."  value="<?php echo htmlspecialchars($this->input->get('query') ?: ''); ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control search-input" name="location" placeholder="Location (City, State, Zip)" value="<?php echo htmlspecialchars($this->input->get('location') ?: ''); ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn search-btn w-100">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="businesses" class="section-padding">
        <div class="container">
            <h2 class="section-title fade-in">Featured Businesses</h2>
            <p class="section-subtitle fade-in">Discover top-rated businesses in your area</p>
            
            <!-- <div class="row"> -->

<?php if (empty($businesses)): ?>
    <div class="alert alert-info" role="alert">
        No active business listings found yet. Please check back later!
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($businesses as $business): ?>
            <div class="col-lg-4 col-md-6">
                    <div class="business-card fade-in">
                        <div class="business-image">
                        <?php if ($business->image): ?>
                            <img src="<?php echo base_url($business->image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($business->business_name); ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <img src="https://placehold.co/400x200/e0e0e0/333333?text=Business+Image" class="card-img-top" alt="Placeholder" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        
                            <!-- <i class="fas fa-utensils"></i> -->
                        </div>
                        <div class="business-info">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="business-name"><?php echo htmlspecialchars($business->business_name); ?></h5>
                                <span class="verified-badge">
                                    <i class="fas fa-check"></i> Verified
                                </span>
                            </div>
                            <p class="business-category"><?php echo htmlspecialchars($business->category); ?></p>
                            <div class="rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="ms-2">4.9 (124 reviews)</span>
                            </div>
                            <div class="business-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo htmlspecialchars($business->address . ', ' . $business->city . ', ' . $business->state); ?><br>
                            <?php if ($business->phone): ?><i class="fas fa-phone-alt mr-1"></i> <?php echo htmlspecialchars($business->phone); ?><br><?php endif; ?>
                            <?php if ($business->email): ?><i class="fas fa-envelope mr-1"></i> <?php echo htmlspecialchars($business->email); ?><br><?php endif; ?></span>
                            </div>
                            <a href="<?php echo base_url('listings/' . $business->id); ?>" class="btn btn-primary btn-sm mt-2">View Details</a>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
    
<?php endif; ?>

        </div>
    </section>

    <!-- Why List Your Business -->
    <section id="list-business" class="section-padding bg-light">
        <div class="container">
            <h2 class="section-title fade-in">Why List Your Business?</h2>
            <p class="section-subtitle fade-in">Grow your business with our powerful platform</p>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="feature-title">Increased Visibility</h4>
                        <p class="feature-description">Get discovered by thousands of potential customers searching for businesses like yours in your area.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="feature-title">Reach More Customers</h4>
                        <p class="feature-description">Connect with a wider audience and attract customers who are actively looking for your services.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="feature-title">Business Analytics</h4>
                        <p class="feature-description">Track your business performance with detailed analytics and insights to make data-driven decisions.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="feature-title">Customer Reviews</h4>
                        <p class="feature-description">Build trust and credibility with authentic customer reviews and ratings that boost your reputation.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="feature-title">Mobile Optimized</h4>
                        <p class="feature-description">Your business profile looks great on all devices, ensuring customers can find you anywhere.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h4 class="feature-title">Marketing Tools</h4>
                        <p class="feature-description">Access powerful marketing tools to promote your business and run targeted campaigns.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="features" class="section-padding">
        <div class="container">
            <h2 class="section-title fade-in">Why Choose BusinessHub?</h2>
            <p class="section-subtitle fade-in">We're committed to helping your business succeed</p>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="stats-card fade-in">
                                <span class="stats-number">10K+</span>
                                <span class="stats-label">Listed Businesses</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="stats-card fade-in">
                                <span class="stats-number">50K+</span>
                                <span class="stats-label">Monthly Visitors</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="stats-card fade-in">
                                <span class="stats-number">95%</span>
                                <span class="stats-label">Customer Satisfaction</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="stats-card fade-in">
                                <span class="stats-number">24/7</span>
                                <span class="stats-label">Support Available</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <h3 class="fw-bold mb-4 fade-in">Trusted by Businesses Worldwide</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start fade-in">
                                    <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Secure Platform</h5>
                                        <p class="text-muted">Advanced security measures to protect your business data</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start fade-in">
                                    <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Expert Support</h5>
                                        <p class="text-muted">Dedicated support team to help you succeed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start fade-in">
                                    <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-rocket"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Easy Setup</h5>
                                        <p class="text-muted">Get your business listed in minutes, not hours</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start fade-in">
                                    <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Regular Updates</h5>
                                        <p class="text-muted">Continuous platform improvements and new features</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification Section -->
    <section id="verification" class="section-padding bg-light">
        <div class="container">
            <h2 class="section-title fade-in">Why Verification Matters</h2>
            <p class="section-subtitle fade-in">Build trust with your customers through our verification process</p>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <h3 class="fw-bold mb-4 fade-in">Verified Businesses Get 3x More Customers</h3>
                        <div class="mb-4 fade-in">
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Identity Verification</h5>
                                    <p class="text-muted mb-0">Confirm your business identity with official documents</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Location Verification</h5>
                                    <p class="text-muted mb-0">Verify your business address and operating hours</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Contact Verification</h5>
                                    <p class="text-muted mb-0">Confirm your phone number and email address</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="testimonial-card fade-in">
                                <p class="testimonial-text">"Getting verified on BusinessHub increased our customer inquiries by 300%. The verification badge gives customers confidence to choose us over competitors."</p>
                                <div class="testimonial-author">- Sarah Johnson, Owner of Elite Hair Salon</div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="testimonial-card fade-in">
                                <p class="testimonial-text">"The verification process was quick and easy. Now customers trust us more and we get better quality leads through the platform."</p>
                                <div class="testimonial-author">- Mike Rodriguez, Quick Fix Auto Repair</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title fade-in">Ready to Grow Your Business?</h2>
                    <p class="section-subtitle fade-in">Join thousands of successful businesses on our platform</p>
                    <div class="fade-in">
                        <a href="#" class="cta-primary">List Your Business Free</a>
                        <a href="#" class="cta-secondary">Search Businesses</a>
                    </div>
                </div>
            </div>
        </div>
    </section>