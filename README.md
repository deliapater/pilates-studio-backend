# Pilates Studio App
A Vue 3 + Pinia frontend for a Pilates Studio booking system, connected to a Laravel backend.

## Table of Contents
* Features
* Project Setup
    * Backend Setup
    * Frontend Setup
* Available Scripts
* Future Enhancements

## Features
* User registration and login with token-based authentication
* View class schedule
* Book classes with limited spots per user
* Toast notifications for booking actions
* Responsive design (mobile-first)
* Loading spinner for async actions
* Centralized state management with Pinia

## Project Setup

### Backend Setup (Laravel)
1. Clone the backend repo:
```
git clone <backend-repo-url>
cd <backend-folder>
```

2. Install dependencies:
```
composer install
```

3. Setup your `.env` file:
```
cp .env.example .env
php artisan key:generate
```

4. Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pilates_studio
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations:
```
php artisan migrate
```

6. Start the backend server:
```
php artisan serve
```

7. Run Unit tests:
```
php artisan test
```

### Frontend Setup (Vue 3 + Pinia)
1. Clone the repository:
```
git clone <repo-url>
cd pilates-studio
```

2. Install dependencies:
```
npm install
```

3. Create `.env` file to store API URL:
```
VITE_API_URL=http://127.0.0.1:8000/api
```

4. Run the development server:
```
npm run dev
```

5. Run frontend tests:
```
npm run test
```

Open your browser at http://localhost:5173 (or the URL provided by Vite).


## Usage
* Login with a username (minimum 3 characters)
* Navigate through Home, Schedule, and Bookings
* Book available classes; toast notifications show success/error
* Logout using the button in the navbar

## Technologies Used
* Vue 3 (Composition API)
* Vue Router
* Pinia for state management
* Vite for development & bundling
* Vanilla CSS for styling

## Future Enhancements
* Persistent bookings stored in the database
* Calendar view for schedule
* Search and filter classes
* Animations for smoother UI
