<!-- IF user clicks 'Login'
    DISPLAY login form
    IF user submits form
        CONNECT to database using PDO
        PREPARE statement to SELECT user WHERE username and password match
        EXECUTE statement
        FETCH user type
        IF user type is 'Player'
            AUTHENTICATE player
            REDIRECT to start page
        ELSE IF user type is 'Admin'
            AUTHENTICATE admin
            REDIRECT to admin dashboard
        ENDIF
    ENDIF
ENDIF -->



