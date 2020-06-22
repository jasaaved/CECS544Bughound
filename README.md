# Bughound
Bughound is a web-based bug recording and tracking software product, developed as a course project by Christopher Gutierrez and Jonathan Saavedra at California State Univerity, Long Beach.

Key features of Bughound: 
* Using web browser, create, edit and update "bug" reports multiple products
* Store error report content in relational tables
* Access error report via MySQL
* Search for bugs on multiple fields

## Installation

For this project, we used XAMPP to quickly and easily test the application without having to upload it to a web server. If you'd like to test the application, we recommend downloading XAMPP.
Then, complete the following steps:

1. Install and launch XAMPP
2. Click "Explorer"
3. Open the "htdocs" folder
4. Create a folder named "bughound" and clone this repository into it
5. In XAMPP, start the "MySQL" module
6. Click "Admin" for the MySQL module to launch phpMyAdmin
7. Click on "Import" to import the "bughound.xml" database in the repo
8. Click on "Choose File" and navigate to the "bughound.xml" file
9. Uncheck "Enable foreign key checks" under "Other options"
10. Click the "Go" button on the lower right
11. To launch the application, make sure the "Apache" and "MySQL" module have started, if not, start them
12. In your browswer, navigate to http://localhost/bughound/login.php
13. To log in, use Username: Pip Password: pip for admin level control

## Screenshots

![picture alt](https://i.imgur.com/Mr6Jrd2.png "Logging in with Admin privileges")
![picture alt](https://i.imgur.com/tDIMgoU.png "Admin home page")
![picture alt](https://i.imgur.com/caHPp8O.png "Bug Search page")
![picture alt](https://i.imgur.com/rYKUafa.png "New Bug Report entry page")

### Thank you for viewing my project. Please email me with any inquiries at christopher.gutie@gmail.com
