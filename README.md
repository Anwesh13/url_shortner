
# 🔗 Laravel 12 URL Shortener

A lightweight Laravel 12 application that lets you:

- ✅ Shorten long URLs like `https://github.com/Anwesh13`
- ✅ Get short URLs like `http://short.est/XyZ123`
- ✅ Decode shortened URLs back to the original
- ✅ Use the service via terminal (`curl`) or browser
- ✅ No database needed — works entirely in memory using Laravel Cache

This project includes a simple frontend built into Laravel's `welcome.blade.php` for browser usage.

---

## 🚀 Features

- REST API with `/api/encode` and `/api/decode`
- Blade-powered frontend at `http://127.0.0.1:8000`
- Works offline — no external service required
- Laravel 12 cache-based storage (no DB setup)

---

## 🛠 Requirements

To run this project, you’ll need PHP 8.1 or higher, Composer, and Git. Laravel CLI is optional but helpful.

---

## ⚙️ Installation

First, clone the repository using the command:

```bash
git clone https://github.com/Anwesh13/url_shortner.git
cd url_shortner
```

Once inside the project directory, install the required dependencies:

```bash
composer install
```

Next, copy the example environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

Make sure your Laravel 12 app is correctly loading the API routes. Open `bootstrap/app.php` and confirm the following routing block is included:

```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
```

Once that’s confirmed, you're ready to go.

To start the application, run:

```bash
php artisan serve
```

Then open your browser and go to:

```
http://127.0.0.1:8000
```

---

## 🌐 Using the App in Browser

The homepage includes a built-in UI where you can paste a long URL and click **"Shorten"** to get a short URL like `http://short.est/XyZ123`. You can also paste a short URL and click **"Decode"** to get the original back.

---

## 🧪 Using the API with cURL

To shorten a URL using the terminal, run:

```bash
curl -X POST http://127.0.0.1:8000/api/encode   -H "Content-Type: application/json"   -d '{"url": "https://github.com/Anwesh13"}'
```

This will return a response like:

```json
{
  "short_url": "http://short.est/XyZ123"
}
```

To decode it back:

```bash
curl -X POST http://127.0.0.1:8000/api/decode   -H "Content-Type: application/json"   -d '{"short_url": "http://short.est/XyZ123"}'
```

And you’ll get:

```json
{
  "original_url": "https://github.com/Anwesh13"
}
```

---

## 📁 Project Structure

- `routes/api.php`: Handles `/api/encode` and `/api/decode`
- `routes/web.php`: Loads the Blade view
- `resources/views/welcome.blade.php`: UI for encoding/decoding URLs
- `bootstrap/app.php`: Laravel 12 routing configuration

---

## 💾 No Database Required

This app does not use a database. It stores the short–original URL mappings in Laravel's in-memory cache. That means it's super lightweight and works instantly — no migration or DB setup needed.

---

## 👨‍💻 Author

Developed by [Anwesh](https://github.com/Anwesh13)
