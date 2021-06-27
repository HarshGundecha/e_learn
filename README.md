# E_learn
E Learning Web Development project as part of BCA 6th semester graduation at VNSGU University

## FEATURES :

### User Site
* Code execution in various languages
* User-2-user video calling, multiple user can join call
* Discussion for QnA with up/down votes & tagging questions, answering questions etc
* Reading Courses > Syllabus > Section for learning
* Article reading with like/commenting & 
sharing on Whatsapp, Facebook etc
* tawk.to chat for user-2-admin 24x7 chat support
* Auto address generator using html location API + google reverse geocoding API to fetch user's address by using GPS
* User Poll for taking feedback or survey from users
* User-2-User challenge, user challenges each other for 5 random question round & winner gets XPs for win which is added to user's XP
* On Site + Mail(html mail) Notification where user gets notified for QnA & challenges
* User Profile for viewing details like QnA posts, polls, followers, contact info. etc
* ajax for follow/unfollow, address update

### Admin Site
* Extensive use of Datatables + Ajax on each page for listing X records per page, sorting, searching, paging & for fetching data in PDF, CSV, excel & print, copy
* managing Admins by add/update/block/unblock
* managing Category -> Courses -> Chapters by add/update/block/unblock
* managing Section(tutorial) & articles by block/unblock, add/update with WYSIWYG editor + instant image insertion by adding images to imgur.com from editor itself
* managing Polls by add/update/block/unblock with adding N options & setting poll start & end date
* managing Challenge Questions by add/update/block/unblock with adding 4 options
* managing user by block/unblock & user's detailed profile view
* managing QnA by block/unblock on both question & answer
* managing Tags by add/update/block/unblock
* managing user feedback with sending mails(html mails) to user in response to feedback
* On Site + Mail(html mail) system for feedback.

### Other
* Use of cURL for executing http request in backend for e.g., to invoke google reverse geocode API request without exposing API address or auth key to users
* SEO friendly URLs for better search result ranking
* Prevention of XSS attack by filtering user input & prevention of SQL injection by validation at all input points.

## Future Scope
* Hiding exposure of IDs by slugs(user friendly texts) which also improves SEO
* adding disquss commenting system on Section(tutorial)
* Web page + DB caching for faster page loads.
* replace WYSIWYG editor with markdown editor.

## TechStack
* Server - Apache 2.4.29
* Backend Language - PHP 7.2.1
* Framework - Codeigniter 3.1.8 MVC framework
* DB - MySQL
* Frontend - HTML5, Bootstrap3
* Control Panel - XAMPP 7.2.1
* Editor - Sublime Text

## Setup on windows
- Install required XAMPP version.
- Open apache's php.ini and set the value of `upload_max_filesize` to **4M**, save the file, **start/restart** both apache and mysql server.
- Open phpmyadmin, create a database with some name like `e_learn`
- Once DB is created select **e_learn** database from list of DB and go to import tab and import the sql file located at `/resources/db/db.sql` and click go, wait for some time for import to finish.
- Open `/application/config/config.php` and set the `$config['base_url']` to homepage of the project for example set to 'http://localhost/e_learn/' if you project is inside the directory named `e_learn` and **save the file**.
- Open `/application/config/database.php` and set the `hostname`, `username`, `password` and `database` fields and **save the file**.
- Visit `http://localhost/e_learn` and the user's login/register page should show up, try logging in using the credentials from `tbluser` table in database.
- Similarly try visiting `http://localhost/e_learn/admin` and the admin's login page should show up, try logging in using the credentials from `tbladmin` table in database.
