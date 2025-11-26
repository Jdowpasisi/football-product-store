<?php
require_once 'config.php';

// Handle form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_ticket'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $query = "INSERT INTO support_tickets (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        
        if (mysqli_query($conn, $query)) {
            $success_message = "Your support ticket has been submitted successfully! We'll get back to you soon.";
        } else {
            $error_message = "Error submitting ticket. Please try again.";
        }
    } else {
        $error_message = "All fields are required.";
    }
}

$page_title = 'Customer Support - SportsFit';
$active_page = 'support';

include 'includes/header.php';
?>

    <div class="page-header">
        <div class="container">
            <h1>Customer Support</h1>
            <p>We're here to help! Contact us with any questions or concerns.</p>
        </div>
    </div>

    <section class="support-section">
        <div class="container">
            <div class="support-layout">
                <div class="support-info">
                    <h2>Get in Touch</h2>
                    <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <span class="contact-icon">📧</span>
                            <div>
                                <h3>Email</h3>
                                <p>support@sportsfit.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <span class="contact-icon">📞</span>
                            <div>
                                <h3>Phone</h3>
                                <p>+91 1234567890</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <span class="contact-icon">🕒</span>
                            <div>
                                <h3>Business Hours</h3>
                                <p>Mon-Sat: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-section">
                        <h3>Frequently Asked Questions</h3>
                        <div class="faq-item">
                            <h4>What is your return policy?</h4>
                            <p>We offer a 30-day return policy for all unused products in original packaging.</p>
                        </div>
                        <div class="faq-item">
                            <h4>How long does shipping take?</h4>
                            <p>Standard shipping takes 3-7 business days. Express shipping is available.</p>
                        </div>
                        <div class="faq-item">
                            <h4>Do you offer cash on delivery?</h4>
                            <p>Yes, COD is available for orders within India.</p>
                        </div>
                    </div>
                </div>

                <div class="support-form-container">
                    <h2>Send us a Message</h2>
                    
                    <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <?php echo $error_message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="support.php" class="support-form">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject" name="subject" class="form-control" required>
                                <option value="">Select a subject</option>
                                <option value="Order Inquiry">Order Inquiry</option>
                                <option value="Product Question">Product Question</option>
                                <option value="Shipping & Delivery">Shipping & Delivery</option>
                                <option value="Returns & Refunds">Returns & Refunds</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" class="form-control" rows="6" required></textarea>
                        </div>
                        
                        <button type="submit" name="submit_ticket" class="btn btn-primary btn-block">Submit Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
