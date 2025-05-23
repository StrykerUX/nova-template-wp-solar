<?php
/**
 * Example page template usage
 * Save this as page-example.php in your child theme or use as reference
 */

// For Dashboard Template with sidebar
/*
Template Name: My Dashboard Page
*/

get_header(); ?>

<div class="dashboard-wrapper">
    <!-- The sidebar is automatically included from the dashboard template -->
    
    <main class="dashboard-main">
        <div class="dashboard-content">
            <!-- Your custom content here -->
            <div class="row">
                <div class="col-12">
                    <h1>Welcome to Nova Dashboard</h1>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Card Title</h3>
                            <p class="card-text">This is an example card using Nova Solar styles.</p>
                            <a href="#" class="btn btn-primary">Action</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card card-interactive">
                        <div class="card-body">
                            <div class="card-icon">
                                <div class="card-icon-wrapper">
                                    <i class="ti ti-rocket"></i>
                                </div>
                                <div class="card-content">
                                    <h4>Interactive Card</h4>
                                    <p class="text-muted">Hover for effect</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card card-glass">
                        <div class="card-body">
                            <h3 class="card-title">Glass Effect</h3>
                            <p class="card-text">Beautiful glass morphism style.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Example form -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Example Form</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your name">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="email@example.com">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="agree">
                                    <label class="form-check-label" for="agree">
                                        I agree to the terms
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary ms-2">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Theme Features</h4>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Dark/Light theme switching</li>
                                <li>Responsive sidebar navigation</li>
                                <li>Mobile-optimized bottom navigation</li>
                                <li>Fisheye dot pattern background</li>
                                <li>Modular SCSS architecture</li>
                                <li>CSS variables for easy customization</li>
                                <li>Plugin-friendly design system</li>
                            </ul>
                            
                            <div class="alert alert-info mt-3">
                                <i class="ti ti-info-circle"></i>
                                This theme uses CSS custom properties that can be accessed by plugins using the --nova- prefix.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Example of using theme variables in custom CSS -->
            <style>
                .my-custom-element {
                    background-color: var(--nova-bg-card);
                    color: var(--nova-text-primary);
                    padding: var(--nova-spacing-lg);
                    border-radius: var(--nova-radius-lg);
                    border: 1px solid var(--nova-border-color);
                }
            </style>
            
        </div>
    </main>
</div>

<?php get_footer(); ?>
