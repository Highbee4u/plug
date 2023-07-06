# plug
Backend API for ride sharing APP

# Installation and Seting up

Create .env file in the root folder, Copy the .env.example and to .env file. change the environment configuration to suite your new environment.

Navigate to the project folder from your terminal and run composer install.

# Enpoints
    - Register with phone number and password (You can register as a driver by passing the has_car variable as 1 at the point of registration and not passing it as other users)
    - Login (with phone number and password)
    - Update your basic detail profile (name, address, gender etc..)
    - Set passcode (for wallet payment system, approval of payment)
    -- Drivers
        -   Register Vehicle (CRUD)
        -   Submit Liscence (CRUD)
        -   Place Ride (Available only when you register as a driver (ability to perform CRUD Operation))
    --  Users
        -   Booking (user makes use of this to create Bookings)




