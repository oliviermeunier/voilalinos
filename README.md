# Installation

- Clone or download repository
- Create a database 
- Configure database connection in `app/Config/Database.php`
- Execute migrations to create database schema : `php spark migrate`
- Modify the parameter **$baseUrl** in `app/Config/App.php`

# API Documentation
## List Users [GET /api/users]

+ Parameters
    + page: `1` (optional, number) - Page number for pagination

+ Response 200 (application/json)
    + Attributes (object)
        + users (array[User]) - List of users
            + id: `4881b8e8-6bf1-4fa3-a09e-1da9a3c88ef3` (string) - Unique identifier for the user
            + firstName: `Olivier` (string) - First name of the user
            + lastName: `Meunier` (string) - Last name of the user
            + email: `oli.meunier@gmail.com` (string) - Email address of the user
            + phone: `0660201193` (string) - Phone number of the user
            + address: `13 rue Fernand Dol 13100 Aix-en-Provence` (string) - Postal address of the user
            + professionalStatus: `Développeur` (string) - Professional status of the user
            + lastLogin: `2024-06-25 07:44:45` (string) - Date of last login
        + pager (object)
            + currentPage: 1 (number) - Current page number
            + totalPages: 1 (number) - Total number of pages
            + totalUsers: 12 (number) - Total number of users
            + perPage: 25 (number) - Number of users per page

### Create a New User [POST /api/users]

+ Request (application/json)
    + Attributes (object)
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user

+ Response 201 (application/json)
    + Attributes (User)
        + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (string) - Unique identifier for the user
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user
        + lastLogin: `2021-12-01 00:00:00` (string) - Date of last login

### Update a User (public API) [PUT /api/users/{id}]

+ Parameters
    + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (required, string) - Unique identifier for the user

+ Request (application/json)
    + Attributes (object)
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user

+ Response 200 (application/json)
    + Attributes (User)
        + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (string) - Unique identifier for the user
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user
        + lastLogin: `2021-12-01 00:00:00` (string) - Date of last login

### Update a User (private API) [PUT /api/private/users/{id}]

+ Parameters
    + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (required, string) - Unique identifier for the user

+ Request (application/json)
    + Attributes (object)
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user

+ Response 200 (application/json)
    + Attributes (User)
        + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (string) - Unique identifier for the user
        + firstName: `John` (string) - First name of the user
        + lastName: `Doe` (string) - Last name of the user
        + email: `john.doe@example.com` (string) - Email address of the user
        + phone: `1234567890` (string) - Phone number of the user
        + address: `123 Main St` (string) - Postal address of the user
        + professionalStatus: `Employed` (string) - Professional status of the user
        + lastLogin: `2021-12-01 00:00:00` (string) - Date of last login

## Delete a User [DELETE /api/private/users/{id}]

+ Parameters
    + id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (required, string) - Unique identifier for the user

+ Response 204

# Data Structures

## User (object)
+ id: `1f1e7b9f-6b2f-4c8b-8d5a-d12e234ea5a6` (string) - Unique identifier for the user
+ firstName: `John` (string) - First name of the user
+ lastName: `Doe` (string) - Last name of the user
+ email: `john.doe@example.com` (string) - Email address of the user
+ phone: `1234567890` (string) - Phone number of the user
+ address: `123 Main St` (string) - Postal address of the user
+ professionalStatus: `Employed` (string) - Professional status of the user
+ lastLogin: `2021-12-01 00:00:00` (string) - Date of last login

# Commands
## Cleanup users
Execute in command line : `php spark users:cleanup`