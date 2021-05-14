## about aaplication
GifyTestApp is an application used to search for any gifs and show results.

## installation steps

- Clone repository to your local host
  
- Run composer install

- Create new database with name gif_browsing_app

- Run migration
  
        php artisan migrate
  
- Copy env.example to .env and change configuration
        
        APP_KEY=base64:rvbRVVLYGGnYZ6lB57QtCo+RBBvWK5G1kPtdHK/YQ3g=

        DB_DATABASE=gif_browsing_app
        DB_USERNAME=your_user_name
        DB_PASSWORD=your_password

- Run application

        php artisan serve


- Register new user


##################################################



## Features:

    - user management support register, login.
  
    - search for specific gif by enter any keyword you want.

    - show result in show more way, in order to load more gifs press show more button.

    - separate search history for each user.

##################################################

## functions:

    - search function

    - autocomplete function
    
    - unit test functions 
        

