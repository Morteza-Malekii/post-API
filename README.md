[English](#english) | [farsi](#persian)

---

<a id="english"></a>
## 🇬🇧 English


### 1. Overview  
A versioned RESTful Post API (Laravel 12) with:  
- Full CRUD (List, Retrieve, Create, Update, Delete)  
- Validation via FormRequest  
- JSON Resource output with consistent fields & meta  
- Pagination  
- Response caching (Spatie Response Cache)  
  - **Time‐cached** header  
  - **Cache‐age** header  
- Configurable TTL, store, bypass & per‐route exclusions  

### 2. Installation & Setup

1. **Clone & install dependencies**  
    ```bash
    git clone <your-repo-url>
    cd <project-folder>
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

2. **Environment** (`.env`)  
    ```
    DB_CONNECTION=...
    DB_DATABASE=...
    DB_USERNAME=...
    DB_PASSWORD=...

    CACHE_DRIVER=redis
    RESPONSE_CACHE_LIFETIME=300               # TTL in seconds (e.g. 5 minutes)
    RESPONSE_CACHE_HEADER_NAME=X-Response-Cache
    RESPONSE_CACHE_AGE_HEADER_NAME=X-Response-Cache-Age
    ```

3. **Install & publish Spatie Response Cache**  
    ```bash
    composer require spatie/laravel-responsecache
    php artisan vendor:publish \
      --provider="Spatie\ResponseCache\ResponseCacheServiceProvider" \
      --tag="responsecache-config"
    ```

4. **Edit `config/responsecache.php`**  
    ```php
    return [
      'enabled'                    => env('RESPONSE_CACHE_ENABLED', true),
      'cache_lifetime_in_seconds'  => (int) env('RESPONSE_CACHE_LIFETIME', 60 * 5),
      'add_cache_time_header'      => true,
      'add_cache_age_header'       => true,
      'cache_time_header_name'     => env('RESPONSE_CACHE_HEADER_NAME', 'X-Response-Cache'),
      'cache_age_header_name'      => env('RESPONSE_CACHE_AGE_HEADER_NAME', 'X-Response-Cache-Age'),
      'cache_store'                => env('RESPONSE_CACHE_DRIVER', null),
      // … other settings …
    ];
    ```

5. **Register middleware** (in `bootstrap/app.php` or `app/Http/Kernel.php`)  
    ```php
    ->withMiddleware(function (Middleware $middleware) {
      $middleware->append(\Spatie\ResponseCache\Middlewares\CacheResponse::class);
      $middleware->alias([
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
      ]);
    })
    ```

6. **Clear caches & restart**  
    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    php artisan serve
    ```

### 3. Routes & Cache Behavior

| Method | URI               | Action   | Cache?            |
|:------:|:-----------------:|:--------:|:-----------------:|
| GET    | `/api/posts`        | index    | ✅ cached GET     |
| GET    | `/api/posts/{id}`   | show     | ✅ cached GET     |
| POST   | `/api/posts`        | store    | ❌ not cached     |
| PATCH  | `/api/posts/{id}`   | update   | ❌ not cached     |
| DELETE | `/api/posts/{id}`   | destroy  | ❌ not cached     |

- **Bypass cache** on any GET route:
    ```php
    Route::get('/posts/search', [PostController::class,'search'])
         ->middleware('doNotCacheResponse');
    ```

- **Invalidate cache** after write:
    ```php
    use Spatie\ResponseCache\Facades\ResponseCache;
    // inside store/update/destroy:
    ResponseCache::clear();
    ```

### 4. Examples (cURL)

```bash
# List (cached)
curl -H "Accept: application/json" http://127.0.0.1:8000/api/posts

# Show (cached)
curl -H "Accept: application/json" http://127.0.0.1:8000/api/posts/1

# Create (clears cache)
curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Accept: application/json" -H "Content-Type: application/json" \
  -d '{"title":"New","description":"Desc","author":"Bob","isComentOn":1}'

# Update (clears cache)
curl -X PATCH http://127.0.0.1:8000/api/posts/1 \
  -H "Accept: application/json" -H "Content-Type: application/json" \
  -d '{"title":"Updated"}'

# Delete (clears cache)
curl -X DELETE http://127.0.0.1:8000/api/posts/1 \
  -H "Accept: application/json"
 ```
‍‍



<a id="persian"></a>
## 🇮🇷 فارسی

### ۱. معرفی  
یک API پست ساده با Laravel 12، ویژگی‌ها:  
- CRUD کامل  
- اعتبارسنجی با FormRequest  
- خروجی JSON با Resource و meta  
- صفحه‌بندی  
- کش پاسخ‌ها با Spatie Response Cache  
  - هدر «زمان کش‌شدن»  
  - هدر «عمر کش»  
- تنظیم TTL، استور، مستثنی‌سازی مسیر  

### ۲. نصب و راه‌اندازی

1. **کلون و نصب وابستگی‌ها**  
    ```bash
    git clone <آدرس-ریپو>
    cd <پوشه‌ پروژه>
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

2. **تنظیمات `.env`**  
    ```
    DB_CONNECTION=…
    DB_DATABASE=…
    DB_USERNAME=…
    DB_PASSWORD=…

    CACHE_DRIVER=redis
    RESPONSE_CACHE_LIFETIME=300         # زمان TTL بر حسب ثانیه
    RESPONSE_CACHE_HEADER_NAME=X-Response-Cache
    RESPONSE_CACHE_AGE_HEADER_NAME=X-Response-Cache-Age
    ```

3. **نصب & انتشار کانفیگ**  
    ```bash
    composer require spatie/laravel-responsecache
    php artisan vendor:publish \
      --provider="Spatie\ResponseCache\ResponseCacheServiceProvider" \
      --tag="responsecache-config"
    ```

4. **ویرایش `config/responsecache.php`**  
    ```php
    return [
      'enabled'                   => env('RESPONSE_CACHE_ENABLED', true),
      'cache_lifetime_in_seconds' => (int) env('RESPONSE_CACHE_LIFETIME', 300),
      'add_cache_time_header'     => true,
      'add_cache_age_header'      => true,
      'cache_time_header_name'    => env('RESPONSE_CACHE_HEADER_NAME','X-Response-Cache'),
      'cache_age_header_name'     => env('RESPONSE_CACHE_AGE_HEADER_NAME','X-Response-Cache-Age'),
      'cache_store'               => env('RESPONSE_CACHE_DRIVER', null),
      // … بقیه تنظیمات …
    ];
    ```

5. **ثبت Middleware**  
    ```php
    ->withMiddleware(function (Middleware $middleware) {
      $middleware->append(\Spatie\ResponseCache\Middlewares\CacheResponse::class);
      $middleware->alias([
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
      ]);
    })
    ```

6. **پاک‌سازی & راه‌اندازی مجدد**  
    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan serve
    ```

### ۳. مسیرها و رفتار کش

| متد    | مسیر                  | کش می‌شود؟ |
|:------:|:---------------------:|:-----------:|
| GET    | `/api/posts`          | ✅          |
| GET    | `/api/posts/{id}`     | ✅          |
| POST   | `/api/posts`          | ❌          |
| PATCH  | `/api/posts/{id}`     | ❌          |
| DELETE | `/api/posts/{id}`     | ❌          |

- برای مستثنی‌سازی کش در یک GET:
    ```php
    Route::get('/posts/search', …)
         ->middleware('doNotCacheResponse');
    ```

- برای باطل‌سازی کش پس از نوشتن:
    ```php
    use Spatie\ResponseCache\Facades\ResponseCache;
    ResponseCache::clear();
    ```

### ۴. مثال cURL

```bash
curl -H "Accept: application/json" http://127.0.0.1:8000/api/posts
curl -X POST http://127.0.0.1:8000/api/posts \
     -H "Content-Type: application/json" \
     -d '{"title":"New","description":"","author":"Bob","isComentOn":1}'
curl -H "Accept: application/json" http://127.0.0.1:8000/api/posts/1
curl -X PATCH http://127.0.0.1:8000/api/posts/1 \
     -H "Content-Type: application/json" \
     -d '{"title":"Updated"}'
curl -X DELETE http://127.0.0.1:8000/api/posts/1
