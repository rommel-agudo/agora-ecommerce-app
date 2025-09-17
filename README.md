# Agora E-Commerce Application

A PHP-based e-commerce web application that provides a multi-user platform for businesses, sellers, and buyers to interact in an online marketplace.

## Features

### User Management
- **Business Accounts**: Create and manage business profiles with admin capabilities
- **Seller Accounts**: Individual sellers can list and manage products
- **Buyer Accounts**: Customers can browse and purchase products
- **Role-based Authentication**: Secure login system for different user types

### E-Commerce Functionality
- **Product Listings**: Sellers can add, update, and manage their products
- **Shopping System**: Buyers can browse and purchase products
- **Order Management**: Track orders and sales
- **Business Administration**: Manage sellers and buyers within a business

### Key Pages
- **Homepage**: Main landing page with navigation to signup/login
- **Product Catalog**: Browse available products
- **User Management**: Add, update, and delete users
- **Business Dashboard**: Administrative interface for businesses

## Technology Stack

- **Backend**: PHP 7+
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Architecture**: MVC-style structure with separate models, views, and controllers

## Project Structure

```
agora-ecommerce-app/
├── assets/                 # Static assets (CSS, images)
│   ├── css/               # Stylesheets
│   └── imgs/              # Application images
├── framework/             # Core framework classes
│   ├── MySQLDB.php       # Database connection class
│   ├── htmlTemplate.php  # HTML template engine
│   └── htmlTable.php     # HTML table generator
├── html/                  # HTML template files
├── images/                # Product images
├── models/                # Data models
│   ├── business.php      # Business entity
│   ├── buyer.php         # Buyer entity
│   ├── seller.php        # Seller entity
│   └── entity.php        # Base entity class
├── siteFunctions/         # Application logic
│   ├── businessPage.php  # Business functionality
│   ├── buyerPage.php     # Buyer functionality
│   ├── sellerPage.php    # Seller functionality
│   ├── commonFunctions.php # Shared utilities
│   └── validationFunctions.php # Input validation
├── sessions/              # Session storage
├── build.php             # Database setup script
├── main.php              # Application homepage
└── *.php                 # Various page controllers
```

## Installation & Setup

### Prerequisites
- **Web Server**: Apache (via XAMPP, WAMP, or similar)
- **PHP**: Version 7.0 or higher
- **MySQL**: Version 5.6 or higher
- **Web Browser**: Modern browser with JavaScript enabled

### Step-by-Step Installation

1. **Install XAMPP**
   ```bash
   # Download from https://www.apachefriends.org/
   # Install and start Apache and MySQL services
   ```

2. **Deploy the Application**
   ```bash
   # Copy project files to XAMPP web directory
   xcopy "path\to\agora-ecommerce-app" "C:\xampp\htdocs\agora-ecommerce-app" /E /I
   ```

3. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

4. **Initialize Database**
   - Navigate to: `http://localhost/agora-ecommerce-app/build.php`
   - This creates the database and populates it with sample data

5. **Access Application**
   - Main page: `http://localhost/agora-ecommerce-app/main.php`

## Database Configuration

The application uses the following default MySQL configuration:

```php
Host: localhost
Username: root
Password: (empty)
Database: agora
```

### Database Schema

The application creates the following tables:

- **business**: Stores business account information
- **buyer**: Customer account details
- **seller**: Seller account information
- **products**: Product catalog
- **orders**: Order tracking and history

## Usage

### For Businesses
1. Sign up at: `/businessSignup.php`
2. Login at: `/businessLogin.php`
3. Manage sellers and buyers from the business dashboard
4. View business analytics and reports

### For Sellers
1. Create account or be added by a business
2. Login at: `/sellerLogin.php`
3. Add and manage product listings
4. Track sales and orders

### For Buyers
1. Sign up at: `/userSignup.php`
2. Login at: `/buyerLogin.php`
3. Browse product catalog
4. Make purchases and track orders

## Sample Data

The database initialization includes sample data:

**Businesses:**
- City Fitbit (business1)
- Moorhouse Gang (business2) 
- Tekapo Thingz (business3)

**Products:**
- Book - $10.55
- Diary - $5.55
- Pen - $2.55

**Default Login Credentials:**
- Business: `business1` / `business1`
- Buyer: `buyer1` / `buyer1`
- Seller: `seller1` / `seller1`

## File Descriptions

### Core Pages
- `main.php` - Homepage and navigation hub
- `build.php` - Database setup and initialization
- `products.php` - Product catalog display
- `listing.php` - Product listing management

### Authentication
- `businessLogin.php` - Business login
- `buyerLogin.php` - Buyer login  
- `sellerLogin.php` - Seller login
- `logout.php` - Session termination

### User Management
- `businessSignup.php` - Business registration
- `userSignup.php` - Buyer registration
- `addBuyerSeller.php` - Add users to business
- `deleteBuyerSeller.php` - Remove users
- `updateBusinessDetails.php` - Business profile updates
- `updateBuyerDetails.php` - Buyer profile updates
- `updateSellerDetails.php` - Seller profile updates

### Shopping
- `buy.php` - Purchase processing
- `viewProduct.php` - Product details page

## Development

### Adding New Features
1. Create model classes in `/models/` for data entities
2. Add business logic to `/siteFunctions/`
3. Create HTML templates in `/html/`
4. Add page controllers in the root directory

### Database Changes
- Modify `build.php` to update schema
- Run the build script to apply changes
- Update model classes accordingly

## Security Features

- Password hashing for all user accounts
- Session management for authenticated users
- SQL injection protection via prepared statements
- Role-based access control

## Troubleshooting

### Common Issues

**Database Connection Error:**
- Ensure MySQL is running in XAMPP
- Verify database credentials in `commonFunctions.php`
- Run `build.php` to create the database

**Page Not Found:**
- Check that files are in `/xampp/htdocs/agora-ecommerce-app/`
- Verify Apache is running
- Ensure proper file permissions

**Login Issues:**
- Use sample credentials provided above
- Check that database tables were created properly
- Verify session storage directory permissions

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source. Please check with the repository owner for specific licensing terms.

## Contact

For questions or support, please contact the development team or create an issue in the project repository.