# SportsFit - Sports Store Website

A fully functional and dynamic sports store built with HTML, CSS, JavaScript, and PHP.

## Features

- **Home Page**: Hero section with featured products and category browsing
- **Products Page**: Complete product catalog with filtering and search functionality
- **Shopping Cart**: Add/remove products, update quantities, dynamic pricing
- **Wishlist**: Save favorite products for later
- **Customer Support**: Contact form with ticket submission system
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Dynamic Updates**: AJAX-powered cart and wishlist updates

## Setup Instructions

### 1. Database Setup

1. Make sure you have a MySQL server running (XAMPP, WAMP, or similar)
2. Create the database by importing `database.sql`:
   - Open phpMyAdmin
   - Create a new database or use the SQL file to create `sports_store`
   - Import the `database.sql` file or run it directly

### 2. Configure Database Connection

Edit `config.php` if needed to match your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sports_store');
```

### 3. Add Product Images

Place product images in the `images/` folder with the following names:
- running-shoes.jpg
- football.jpg
- cricket-bat.jpg
- tennis-racket.jpg
- dumbbells.jpg
- yoga-mat.jpg
- basketball.jpg
- water-bottle.jpg
- track-pants.jpg
- goggles.jpg
- badminton-racket.jpg
- gym-gloves.jpg
- placeholder.jpg (fallback image)

Or the system will use placeholder.jpg for all products.

### 4. Run the Application

1. Place all files in your web server directory (e.g., `htdocs` for XAMPP)
2. Start Apache and MySQL servers
3. Access the site at: `http://localhost/Web Dev TA2/index.php`

## File Structure

```
Web Dev TA2/
├── config.php              # Database configuration
├── database.sql            # Database schema and sample data
├── index.php              # Home page
├── products.php           # Products listing page
├── cart.php              # Shopping cart page
├── wishlist.php          # Wishlist page
├── support.php           # Customer support page
├── styles.css            # Main stylesheet
├── script.js             # JavaScript functionality
├── images/               # Product images folder
└── README.md            # This file
```

## Features in Detail

### Products
- 12 sample products across 5 categories
- Stock tracking
- Price display in Indian Rupees (₹)
- Search and filter functionality

### Shopping Cart
- Add/remove products
- Update quantities
- Real-time price calculation
- Free shipping over ₹5,000
- Session-based storage

### Wishlist
- Save favorite products
- Add all to cart at once
- Remove individual items

### Customer Support
- Contact form with multiple subjects
- Ticket submission system
- FAQ section
- Business hours and contact info

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7+
- **Database**: MySQL
- **Styling**: Custom CSS with gradient themes
- **AJAX**: Fetch API for dynamic updates

## Currency

All prices are displayed in Indian Rupees (₹).

## Notes

- Sessions are used for cart and wishlist (no user authentication required)
- For production use, add proper user authentication
- Implement actual payment gateway for checkout
- Add email functionality for support tickets
- Consider adding product reviews and ratings

## Demo Data

The database includes 12 sample products with various categories:
- Footwear (Running Shoes)
- Equipment (Football, Cricket Bat, etc.)
- Fitness (Dumbbells, Yoga Mat)
- Apparel (Track Pants)
- Accessories (Water Bottle, Goggles, Gym Gloves)

## Page-by-Page Demonstration Points

### 1. Home Page (index.php)
**Key Features to Demonstrate:**
- Click on **SportsFit logo** to return to homepage from anywhere
- Hero section with call-to-action button
- **Featured Products** section displaying 6 products with:
  - Product images, names, and descriptions
  - Category tags
  - Price in ₹
  - Heart icon to add to wishlist
  - "Add to Cart" button
- **Shop by Category** section with 5 clickable category cards:
  - Footwear, Equipment, Fitness, Apparel, Accessories
  - Each redirects to filtered products page
- Navigation bar shows cart and wishlist counts (badges update dynamically)
- Responsive footer with links and contact information

### 2. Products Page (products.php)
**Key Features to Demonstrate:**
- **Sidebar Filters:**
  - Search bar - type product name (e.g., "Nike", "Ball")
  - Category filter - click to filter by category
  - "Clear Filters" button appears when filters are active
- **Product Grid:**
  - All 12 products displayed with full details
  - Stock badges ("Only X left", "Out of Stock")
  - Disabled "Add to Cart" button for out-of-stock items
  - Wishlist heart icon on each product
- **Filter functionality:**
  - Click "Footwear" - shows only running shoes
  - Click "Equipment" - shows sports equipment
  - Search "yoga" - shows yoga mat
  - Combine category + search filters
- Product cards have hover effects (lift and border highlight)

### 3. Shopping Cart (cart.php)
**Key Features to Demonstrate:**
- Add products from other pages, then navigate to cart
- **Cart Items Display:**
  - Product image, name, category, price
  - Quantity controls with +/- buttons
  - Manual quantity input field
  - Individual subtotal calculation
  - Remove button for each item
- **Cart Summary:**
  - Subtotal calculation
  - Shipping cost (₹100 or FREE)
  - **Free shipping notification** when order > ₹5,000
  - Progress indicator for free shipping threshold
  - Total amount display
  - "Proceed to Checkout" button
  - "Continue Shopping" button
- **Real-time updates:**
  - Change quantity - subtotal updates immediately
  - Remove item - cart recalculates
  - Badge count updates in navigation
- **Empty State:**
  - Remove all items to show empty cart message
  - "Start Shopping" button redirects to products

### 4. Wishlist (wishlist.php)
**Key Features to Demonstrate:**
- Add items from home or products page using heart icon
- **Wishlist Display:**
  - Grid layout of saved products
  - X button on each card to remove from wishlist
  - Stock status badges
  - Individual "Add to Cart" buttons
  - Out-of-stock items show disabled button
- **Bulk Actions:**
  - "Add All to Cart" - moves all wishlist items to cart
  - "Continue Shopping" button
- **Dynamic Updates:**
  - Remove item - card disappears instantly
  - Add to cart - item transfers and counts update
  - Badge count updates in navigation
- **Empty State:**
  - Remove all items to show empty wishlist message
  - "Browse Products" button

### 5. Customer Support (support.php)
**Key Features to Demonstrate:**
- **Two-column Layout:**
  - Left: Contact information and FAQs
  - Right: Support ticket form
- **Contact Information Section:**
  - Email address with icon
  - Phone number with icon
  - Business hours with icon
- **FAQ Section** with 3 pre-answered questions:
  - Return policy
  - Shipping duration
  - Cash on delivery availability
- **Support Form:**
  - Name field (required)
  - Email field (required)
  - Subject dropdown with 6 options:
    - Order Inquiry
    - Product Question
    - Shipping & Delivery
    - Returns & Refunds
    - Technical Support
    - Other
  - Message textarea (required)
  - "Submit Ticket" button
- **Form Validation:**
  - Try submitting empty form - shows error
  - Fill all fields and submit - shows success message
  - Ticket saved to database
- Check database after submission to verify ticket entry

## Design Features to Highlight

### Black & White Theme (Adidas-inspired)
- Minimalist black and white color scheme
- Sharp, square edges (border-radius: 0)
- Clean typography
- High contrast for readability
- Black buttons with white text
- White backgrounds with black borders

### Responsive Design
- Test on different screen sizes
- Mobile-friendly navigation
- Adaptive product grids
- Collapsible sidebar on mobile

### User Experience
- Smooth hover effects
- Instant feedback on actions
- Badge counters for cart/wishlist
- Loading states and transitions
- Error handling and validation

## Testing Checklist

- [ ] Add products to cart from different pages
- [ ] Update quantities in cart
- [ ] Test free shipping threshold (add items > ₹5,000)
- [ ] Add items to wishlist
- [ ] Move items from wishlist to cart
- [ ] Filter products by category
- [ ] Search for specific products
- [ ] Submit support ticket
- [ ] Check database for ticket entry
- [ ] Test navigation between all pages
- [ ] Verify cart/wishlist counts update
- [ ] Test empty states (empty cart, empty wishlist)
- [ ] Check stock badges display correctly
- [ ] Verify logo link returns to homepage

## Support

For issues or questions, use the Customer Support page on the website.

---
Built with ❤️ for sports enthusiasts
