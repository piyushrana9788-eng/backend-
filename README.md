BACKEND WEB DEVELOPMENT - ASSIGNMENT SITE
==========================================

1. Edit config.php: put your name, roll number, college etc. (shown on the cover page).

2. Run it locally (XAMPP):
   - Copy this folder to C:\xampp\htdocs\backend-assignment
   - Start Apache (and MySQL for Unit 4)
   - Open http://localhost/backend-assignment/

3. Unit 4 live demos need a database:
   - Open http://localhost/phpmyadmin and create a database named "assignment"
   - config.php already uses the XAMPP defaults (user root, empty password)
   - Then use the demos in order: create table -> insert -> retrieve -> update/delete

4. Hosting (free.je or similar):
   - Upload everything inside this folder to your htdocs / public_html
   - Create a MySQL database in the hosting panel and copy host, user, password,
     and database name into config.php (DB_HOST is often NOT "localhost" on free hosts)

5. Submitting a copy: open any page and click "Print or save as PDF".
   Cover page prints alone; each unit starts on a new page.

Files
  index.php   cover, declaration, contents
  unit.php    renders Unit 1-4 (unit.php?n=1 ... 4)
  end.php     conclusion and references
  includes/content.php   all explanatory text (edit/extend here)
  includes/demos.php     the PHP programs; shown AND executed on the page
  includes/render.php    layout helpers
  assets/style.css       styling (screen, dark mode, print)

Needs PHP 7.4 or newer with the mysqli extension.
