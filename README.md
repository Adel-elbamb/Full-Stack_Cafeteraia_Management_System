# Full-Stack_Cafeteraia_Management_System

# Cafeteria Project

## Overview
The **Cafeteria Project** is a PHP-based web application designed to streamline cafeteria operations, offering both **Admin** and **User** views.

## Features

### **1. User View**

#### **Screen 1: User Authentication**
- Users log in using their username and password.
- If a user forgets their password, they can reset it on a new page.
- **Bonus Feature:** Password reset email functionality using PHPMailer.

#### **Screen 2: Order Selection**
- Displays cafeteria products with clickable images.
- Clicking an image adds the item to the order.
- Users can adjust quantity using **+** or **-** buttons.
- Users can add notes/comments for customization.
- Users select a room from a drop-down menu.
- The total price updates dynamically.
- Clicking **"Confirm Order"** submits the order.
- The latest orders appear at the top.
- Each drink has a specified price.

#### **Screen 4: Order Management**
- Admin can create orders for users selected from a drop-down list.
- Users can view order history filtered by date range.
- Each order has a status:
  - **Processing**
  - **Out for Delivery**
  - **Done**
- Users can cancel orders only if they are in "Processing" status.
- Clicking an order displays its details.

#### **Screen 6: User Order History**
- Users can view order history and total prices for a specified date range.
- Order statuses are displayed.
- Only orders in "Processing" status can be canceled.

### **2. Admin View**

#### **Screen 5: Product Management**
- The admin can view all products.
- The admin can add and remove products.

#### **Screen 6: User Management**
- The admin can view, edit, or delete users.
- A reference to an "Add User" page is available.

#### **Screen 7: Add User Form**
- The admin can add a new user via a form.

#### **Screen 8: Product Categories**
- Products are categorized.
- The admin can add new categories.
- Clicking "Add Category" redirects to a new page for category entry.

#### **Screen 9: Order Check Reports**
- The admin can view all orders within a specified date range.
- Orders can be filtered by user.
- Clicking a username displays all orders for that user within the selected period.

#### **Screen 10: Current Orders Management**
- The admin can view and manage current orders that need to be processed.
- Clicking an order displays its content details.

## **Technology Stack**
- **Backend:** PHP (Laravel or Core PHP)
- **Frontend:** HTML, CSS, JavaScript (Vue.js or jQuery)
- **Database:** MySQL
- **Authentication:** PHP sessions, hashed passwords (bcrypt)
- **Email Handling:** PHPMailer (for password reset)
- **Admin Panel:** Bootstrap or AdminLTE for UI

## **Project Structure**
```
📂 cafeteria_project
 ├── 📂 assets       # Static files (CSS, JS, images)
 ├── 📂 config       # Configuration files
 ├── 📂 include      # Reusable PHP components
 ├── 📂 pages        # Frontend pages (user interface)
 ├── 📂 server       # Backend logic (API, database interactions)
 ├── README.md       # Project documentation
 └── index.php       # Main entry point
```

## **Installation**
1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/cafeteria-project.git
   ```
2. Navigate to the project directory:
   ```sh
   cd cafeteria-project
   ```
3. Configure database settings in `config/database.php`.
4. Run the application on a local server (e.g., XAMPP, MAMP, Laravel Artisan):
   ```sh
   php -S localhost:8000
   ```

## **Contributing**
- Fork the repository.
- Create a new branch: `git checkout -b feature-branch`
- Commit changes: `git commit -m 'Added new feature'`
- Push to GitHub: `git push origin feature-branch`
- Open a Pull Request.

## **License**
This project is licensed under the MIT License.

---
### **Need Help?**
For any issues, open a ticket on the GitHub repository or contact the project maintainer.
