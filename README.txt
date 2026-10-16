AIRLINES GROUP TRAVEL — PHP WEBSITE
===================================

WHAT IS INCLUDED
- Responsive light-blue travel website
- Homepage, blog listing, blog detail, Group Flights, Contact, About, Services, Privacy Policy, Terms, Disclaimer, 404
- PHP + MySQL/MariaDB blog system
- Admin login and dashboard
- Create/edit/delete blog posts and pages
- Categories, image uploads, SEO title and meta description fields
- Contact form with database storage
- XML sitemap and robots.txt
- CSS and JavaScript assets

REQUIREMENTS
- PHP 8.2+ recommended (PDO MySQL, Fileinfo, and GD/getimagesize support)
- MySQL or MariaDB
- XAMPP or another PHP web server

INSTALL WITH XAMPP (WINDOWS)
1. Extract the folder "Airlines-Group-Travel-PHP-Website" into:
   C:\xampp\htdocs\Airlines-Group-Travel
   (If you want the exact requested folder, copy the project to:
   C:\Users\PUNEET\Downloads\Airlines Group Travel
   For XAMPP, the project should usually be under htdocs.)

2. Start Apache and MySQL from the XAMPP Control Panel.

3. Open phpMyAdmin:
   http://localhost/phpmyadmin

4. Import this file:
   database/schema.sql
   It creates the database "airlines_group_travel" and the required tables.

5. Check config/database.php:
   host = 127.0.0.1
   name = airlines_group_travel
   user = root
   pass = (blank by default on a standard XAMPP installation)
   Change these values if your MySQL setup uses a password.

6. Create the first administrator by visiting:
   http://localhost/Airlines-Group-Travel-PHP-Website/create-admin.php
   If you extracted to a different folder, replace the URL folder name accordingly.
   Use a strong password with at least 12 characters.

7. IMPORTANT: After creating the admin account, delete create-admin.php from the project.

8. Open the website:
   http://localhost/Airlines-Group-Travel-PHP-Website/

9. Open the admin login:
   http://localhost/Airlines-Group-Travel-PHP-Website/admin/login.php

RUN WITH PHP BUILT-IN SERVER
1. Open PowerShell in the project folder.
2. Run:
   php -S localhost:8000
3. Open:
   http://localhost:8000
   Admin: http://localhost:8000/admin/login.php
4. Import database/schema.sql into MySQL and check config/database.php first.

BLOG MANAGEMENT
- Sign in to /admin/login.php.
- Select "New Blog Post".
- Enter a title, excerpt, article content, category, and optional image/SEO details.
- Choose Draft or Published, then save.
- Published posts appear on the homepage and Blog page automatically.
- Use the Website Pages area to edit available pages or create new ones.
- Use Categories to manage blog categories.
- Contact form messages are stored in the admin Contact Messages section.

ARTICLE CONTENT
The article editor accepts HTML so headings and lists can be formatted:
<h2>Section heading</h2>
<p>Paragraph text...</p>
<ul><li>First point</li><li>Second point</li></ul>
Only trusted administrators should enter HTML content. Do not paste scripts or untrusted HTML.

IMPORTANT SECURITY NOTES
- Delete create-admin.php immediately after creating the first administrator.
- Use HTTPS and a strong unique administrator password on a public server.
- Keep database credentials private.
- Set proper file permissions and maintain backups.
- Review Privacy Policy and Terms before public launch.
- This is a starter project and should receive a security review before production use.
- Contact form saves messages to the database; email notifications are not configured by default.
- The site does not make airline bookings or guarantee fares. Confirm current policies directly with airlines.

KNOWN IMPLEMENTATION NOTES
- PHP pages use query-string slugs by default (for example blog-details.php?slug=sample-post) so they work on standard local PHP hosting without rewrite configuration.
- For production, configure BASE_URL if the site is hosted in a subdirectory, and configure the web server's document root and HTTPS.
- If you see a database error, confirm MySQL is running, the schema was imported, and config/database.php matches your credentials.
- If image uploads fail, ensure uploads/ is writable by PHP and Fileinfo is enabled.
- Use a current PHP version and keep your hosting environment patched.
