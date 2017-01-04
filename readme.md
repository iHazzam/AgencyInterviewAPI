# iHazzam/WebAgencyAPI - Submission for coding challenge

## API based property/user site built on Laravel 5.3
* [Features](#feature1)
* [Requirements](#feature2)
* [How to install](#feature3)
* [API Endpoints](#feature4)
* [License](#feature5)
* [Additional information](#feature6)

<a name="feature1"></a>
## Features
* Database Seeding (Properties & Users)
* Register (Web and API)
* Login (Web and API)
* Maps (Web, using API)
  * All properties on map
  * Your owned properties on map (property by user)
  * Properties within radius on map (property by radius)
* Update properties (API)

Future features: (If I had more than a week!)

 * Internal API(private)/Web portal for key management and administrator management
 * Oauth2 using Passport
-----
<a name="feature2"></a>
##Requirements

	PHP >= 5.5.9 (only tested on php7+)
	OpenSSL PHP Extension
	Mbstring PHP Extension
	Tokenizer PHP Extension
	SQL server(for example MySQL)(only tested on MariaDB)
	Composer

-----
<a name="feature3"></a>
##How to install:
* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)

-----
<a name="step1"></a>
### Step 1: Get the code - Clone or download the repository

    * https://github.com/iHazzam/CyberDuckAPI.git
    * https://github.com/iHazzam/CyberDuckAPI/archive/master.zip

Extract or clone the code in the correct directory of your web server (Only tested on Laragon/Apache)

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies
Run the commands: 
    composer dump-autoload
    composer install 

-----
<a name="step3"></a>
### Step 3: Create database

 * Create a database on your local dev environment
 * Download .env.example and rename it to .env, updating connection, database name, username and password in the file to the values you    wish to use
-----
<a name="step4"></a>
### Step 4: Migrate database

To initialise the database and run the migrations please run: 

    php artisan migrate

To seed the database, please run: 

    php artisan db:seed

(If required, configure your web server to have Laravel at the correct document root, or append 'public/' to the start of any API requests you make)

-----
<a name="step5"></a>
### Step 5: Start Page
You can now create users, use them to login and use any API endpoints!


-----
<a name="feature4"></a>
## API Endpoints

* API method to create new user
  * Method: POST
  * URL Endpoint: /api/public/user/create
  * Parameters: ?name={any string}&email={valid, unique email}&password={valid password >= 3 chars}
  * Success: {"data":"Success!","status":200} 
  
* Login method returning API key
  * Method: GET
  * URL Endpoint: /api/public/user/login
  * Parameters: ?email={registered email}&password={valid password}
  * Success: {"data":"{YOUR API KEY HERE}","status":200}
  
* Get all properties on the system
  * Method: GET
  * URL Endpoint: /api/public/properties
  * Parameters: none
  * Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
  
* Get all properties on the system belonging to a specific user
  * Method: GET
  * URL Endpoint: /api/public/properties/uid/{id}
  * Parameters: {id} - the system uid for that user
  * Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
  
* Get all properties on the system in a specified geographical area
  * Method: GET
  * URL Endpoint: /api/public/properties/rad/{lat}/{long}/{rad}
  * Parameters:{rad} - radius of search in miles {lat} {long} - valid latitude and longitude
  * Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
  
* Get all users (property owners) on system mapped to their UIDs
  * Method: GET
  * URL Endpoint: /api/public/users
  * Parameters:{rad} - none
  * Success: {"data":{"1":"First User Name","2":"Second User Name"},"status":200} (List of all users on system)
  
* Get all users (property owners) on system mapped to their UIDs
  * Method: POST
  * URL Endpoint: /api/public/properties/update/{pid}
  * Parameters:{PID} - valid property ID (found on map view)
               ?lat={valid (new) latitude}&lng={valid (new) longitude}&val={value of property}&key={API key of owner of the property}
  * Success: {"data":"VAL updated","status":200} (VAL is which values were updated)
  
-----
<a name="feature5"></a>
## License

Free to use under MIT license

----


<a name="feature6"></a>
## Additional information

Please feel free to contact me with any questions or information. This was completed for a job application, so if you represent the company who this task was completed for and you would prefer me keep this code in a private repository as to not help future people taking the task, please contact me by the email you have for me!

----
