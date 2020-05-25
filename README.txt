INSTRUCTIONS ON GETTING THE APP UP AND RUNNING

Step 1
Make sure you have composer installed on your local machine

Step 2
Open command prompt and cd into the cloned app's directory

Step 3
Run this command:
"composer update"


Step 4
create a fresh database in your mysql

Step 5
check the cloned app's directory for a ".env" file. If there's no .env file, create one and copy the contents of the ".env.example" file into the .env file

Step 6
In the .env file, set these as follows:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= "your newly created database name"
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=your email password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME="Internship"

Step 7
Run this command:
"php artisan cache:clear"

Step 8
run the following command:
"php artisan migrate"

Step 9
Install laravel passport by running the following command:
php artisan passport:install

step 10
finally run this command:
"php artisan serve"


Endpoints
GET REQUESTS

retrieving all adverts 
http://localhost:8000/api/advert

retrieving all exclusive ads
http://localhost:8000/api/exclusivead

retrieving all stories
http://localhost:8000/api/story

POST REQUESTS
logging in users
http://localhost:8000/api/login

registering users
Registering users accepts four parameters

email
student_ref
password
confirmpassword

endpoint-------http://localhost:8000/api/register


activating users
Activating users accepts three parameters

code
email
student_ref

endpoint------http://localhost:8000/api/activate

update user info
http://localhost:8000/api/update

forgot password
Forgot password accepts two parameters

email
student_ref

endpoint-------http://localhost:8000/api/forgot

verify code
The verify code accepts one parameter

reset_code

endpoint-------http://localhost:8000/api/verifycode

set new password
The set new password accepts four parameters.

email
student_ref
password
confirm_password

endpoint------http://localhost:8000/api/set


user details
http://localhost:8000/api/details




bookmark ad
http://localhost:8000/api/addbookmark

check your bookmarks
http://localhost:8000/api/mybookmark

delete bookmark
http://localhost:8000/api/delbookmark

comment on post
http://localhost:8000/api/comment

uncomment on post
http://localhost:8000/api/uncomment

verify comment
http://localhost:8000/api/verify

edit comment
http://localhost:8000/api/editcomment

retrieve comment
http://localhost:8000/api/retrievecomment

like post
http://localhost:8000/api/like

unlike post
http://localhost:8000/api/dislike

retrieve likes
http://localhost:8000/api/retrievelike