# YoPrint

YoPrint is a small Laravel 10 application used to upload and process large CSV
files.  Users can sign up / log in, upload a CSV, and then watch progress on
the dashboard as a queued job parses each row and stores the data in the
`products` table.  The UI is built with TailwindCSS and Font‑Awesome, and the
backend uses Laravel’s authentication, queues, and filesystem features.

## Features

- User registration/login/logout (`App\Http\Controllers\Auth\UserController`)
- Dashboard with statistics and file‑upload form
- `FileUpload` model & `csv_uploads` storage directory
- `ProcessCsvUpload` job for asynchronous processing
- Real‑time polling of file status (`FileUploadController@getFileStatuses`)
- Custom artisan command `log:clean` (`app/Console/Commands/ClearLog.php`)
- Configurable via `.env`, uses database for sessions and cache by default

## Requirements

- PHP ≥ 8.1
- Composer
- Node.js & npm
- A database supported by Laravel (sqlite, mysql, pgsql, etc.)
- Redis (optional – only if you change the queue/cache driver)
- [Laravel](https://laravel.com) dependencies (installed via Composer)

## Installation

```bash
git clone <your‑repo‑url> YoPrint
cd YoPrint

composer install
cp [.env.example](http://_vscodecontentref_/1) .env
php artisan key:generate

# configure DB/redis in .env before running migrations
php artisan migrate --seed

npm install
npm run dev         # or `npm run build` for production

# start a queue worker if you want CSV processing to run immediately
php artisan queue:work --tries=3

php artisan serve    # serves the app at http://localhost:8000