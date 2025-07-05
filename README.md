Laravel Admin Blog DashboardA professional Laravel-based admin dashboard and blog frontend system. It includes user roles and permissions, post and category management, and a fully functional public-facing blog with commenting features.

Installation Guide

1. Clone the Repository
git clone https://github.com/Hasan-Steif/admin-dashboard.git


2. Install Dependencies
composer install
npm install && npm run dev

3. Setup Environment
cp.env.example .env
php artisan key:generate
Update the .env file with your local database credentials before proceeding.

4. Run Migrations & Seeders
php artisan migrate --seed

This will:
Create all necessary database tables
Seed roles, permissions, and users
Seed sample categories and blog posts with images

5. Link Storage
php artisan storage:link
This enables access to uploaded and seeded post images via the public path.

🔐 Admin Panel Access
Login Credentials:
Email: admin@example.com
Password: password
Dashboard URL:http://127.0.0.1:8000/login
Admin Features:Manage Users
Manage Roles & Permissions
Manage Categories & Posts
Approve/Delete Comments

Fully featured CRUD for all entities

🌐 Frontend Blog Page
Accessible by all visitors.
URL:
http://127.0.0.1:8000/categories
Features:

List of all blog categories
Clicking a category shows all related posts

Each post displays:

Title, author, date, description, and image
Associated comments

Commenting available for:

Guests (with name input)
Logged-in users (auto-linked name)

Project Structureapp/Models/ - Eloquent models
app/Http/Controllers/Admin/ - Backend controllers
app/Http/Controllers/Frontend/ - Public site controllers
resources/views/admin/ - Admin Blade templates
resources/views/frontend/ - Frontend blog views
database/seeders/ - Seeder files (BlogSeeder, RolePermissionSeeder)

Seeded Content Summary 
Roles:
admin, editor

Users:
Admin: admin@example.com
Editor: editor@example.com
Author: author@example.com

Permissions:Full CRUD permissions including roles, users, posts, categories, comments

Sample Data:
5 Categories: Technology, Health, Travel, Education, Business
3 Posts per category with dummy content and image paths 
(storage/posts/*.jpg)

