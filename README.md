<!-- This is the budget Tracker website -->

<!-- steps to start project -->
1. Download this project

2. Run these Commands in your terminal to start a project

a.php artisan migrate
b.php artisan db: seed  
c.php artisan serve 

3. Go to http://127.0.0.1:8000/ link and fill-
Email- admin@gmail.com
Password - admin

4. After logging In you use this budget Tracker website.

5. In this app-

<!-- Dashboard -->
Total Expenses, Total Income, Total Balance

Graphical Representation of Total Expenses, Total Income, Total Balance

Logout

<!-- Transaction -->
a. add transactions
b.edit transactions
c.update transactions
d.delete transactions

<!-- Budget -->
d. user set budget limit self 
e. update budget limit

<!-- Monthly Report -->
Analyse Monthly Report

<!-- filter -->
filter transactions by category


<!-- Feature -->
Add in .env file then the budget limit exceed then notification send
MAIL_MAILER=smtp
MAIL_HOST="your host"
MAIL_PORT="your port"
MAIL_USERNAME="yourusername"
MAIL_PASSWORD="pass"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="test@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"



