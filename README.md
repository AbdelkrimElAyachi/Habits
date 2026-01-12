# 🎯 HabitApp — Precision Habit Tracker

A high-performance habit tracking application built with **Laravel 10**, featuring automated background reminders, real-time AJAX task management, and deep activity logging. Designed for users who need structure and accountability.

----------

## ✨ Features

### 🔐 Authentication & Authorization

-   **Web Authentication**: Complete auth system via Laravel Breeze (Login, Register, Password Reset).
    
-   **API Authentication**: Secure, token-based access using Laravel Sanctum.
    
-   **Policy Protection**: Strict `HabitPolicy` ensures users only interact with their own data.
    

### ✅ Smart Task Management

-   **Quick-Add System**: Instantly add tasks to habits with specific due dates/times.
    
-   **Real-time Interaction**: Toggle completion and edit task details via **Axios AJAX** (no page refreshes).
    
-   **Inline Editing**: Clean UI for modifying task descriptions and deadlines on the fly.
    

### 🔔 Automated Reminders & Accountability

-   **Background Scheduler**: A custom Artisan engine (`tasks:send-reminders`) scans for upcoming deadlines.
    
-   **Multi-Channel Notifications**: Sends urgent Email and Database alerts when tasks are due soon.
    
-   **Timezone Precision**: Fully configured for `Africa/Casablanca` to ensure local time accuracy.
    

### 📊 Advanced Activity Logging

-   **Observer-Driven**: `HabitObserver` and `HabitTaskObserver` log actions automatically.
    
-   **Smart History**: Tracks "Created", "Updated", "Completed", and "Deleted" states.
    
-   **Change Tracking**: Stores JSON snapshots of before/after states for habit updates.
    

----------

## 🛠 Technology Stack

### Backend

-   **Framework**: Laravel 10.10
    
-   **PHP**: 8.1+
    
-   **Scheduling**: Laravel Console Kernel
    
-   **Notifications**: Mail & Database Channels
    

### Frontend

-   **Bundler**: Vite 4.0
    
-   **CSS**: Tailwind CSS (Inter & Calistoga fonts)
    
-   **JS Framework**: Alpine.js & Axios
    
-   **UI Components**: SweetAlert2 for interactive deletions
    

----------

## 📦 Installation

### Prerequisites

-   PHP 8.1+
    
-   Composer
    
-   Node.js & NPM
    
-   MySQL / PostgreSQL
    

### Setup Instructions

1.  **Clone & Install** `git clone https://github.com/AbdelkrimElAyachi/Habits.git` `cd Habits` `composer install` `npm install`
    
2.  **Environment Setup** `cp .env.example .env` `php artisan key:generate`
    
3.  **Configure Timezone & DB** Ensure your `.env` is set for Casablanca to align with the reminder system: `APP_TIMEZONE=Africa/Casablanca` `DB_DATABASE=habit_tracker`
    
4.  **Database & Seeding** `php artisan migrate --seed`
    
5.  **Assets & Server** `npm run dev` `php artisan serve`
    

----------

## ⏱ Background Tasks (Required for Reminders)

To enable the automated accountability notifications, the scheduler must be running:

**Local Development:** `php artisan schedule:work`

**Production (Cron):** `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

----------

## 📊 Database Schema

### Tables Overview

-   **users**: Standard Laravel users table.
    
-   **habits**: User-defined routines (`title`, `description`, `user_id`).
    
-   **tasks**: Specific actions (`body`, `due_at`, `is_complete`, `reminder_sent`).
    
-   **activities**: Advanced polymorphic logs tracking changes and states.
    
-   **notifications**: Storage for the database notification channel.
    

### Relationships

User hasMany Habits Habits hasMany Tasks Habits/Tasks morphMany Activities

----------

## 🌐 API Documentation (`/api/v1`)

### Authentication

-   `POST /api/v1/register`: Create a new account.
    
-   `POST /api/v1/login`: returns Sanctum Bearer Token.
    
-   `POST /api/v1/logout`: Revokes current token.
    

### Habits (Protected)

-   `GET /api/v1/habits`: List all user habits.
    
-   `POST /api/v1/habits`: Store a new habit.
    
-   `GET /api/v1/habits/{id}`: View specific habit details.
    
-   `PUT /api/v1/habits/{id}`: Update title or description.
    
-   `DELETE /api/v1/habits/{id}`: Remove habit and its tasks.
    

----------

## 🏗 Project Structure

**app/Console/Commands/**: SendTaskReminders.php (The Engine) **app/Http/Controllers/**: Habit & Task Management logic **app/Models/**: Activity, Habit, Task, User **app/Notifications/**: TaskReminderNotification.php **app/Observers/**: Habit & Task Observers (Auto-logging) **app/View/Presenters/**: ActivityPresenter (Format log text)

----------

## 🧪 Testing

Run the test suite: `php artisan test`

----------

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

**Happy Habit Tracking! 🎯**
