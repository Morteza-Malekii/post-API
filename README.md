Laravel Post API

🇮🇷 نسخه فارسی

معرفی

یک API ساده و تمیز برای مدیریت پست‌ها (CRUD) با Laravel 12 که شامل اعتبارسنجی (Form Request)، Route Model Binding، و ساختار RESTful است. این پروژه برای تمرین و همچنین پایه‌سازی یک سرویس واقعی مناسب است.

امکانات (Features)
	•	ایجاد، خواندن، به‌روزرسانی، حذف پست‌ها (CRUD کامل)
	•	Route Model Binding خودکار
	•	اعتبارسنجی ورودی با Form Request (Store / Update)
	•	پاسخ‌های JSON استاندارد
	•	پیام‌های خطای اعتبارسنجی سفارشی
	•	بروزرسانی جزئی با متد PATCH و Rule sometimes
	•	آماده برای توسعه بیشتر (Auth, Pagination, Filter, Test)

ساختار پوشه (خلاصه)

app/
  Http/
    Controllers/
      Api/
        PostController.php
    Requests/
      StorePostRequest.php
      UpdatePostRequest.php
routes/
  api.php
database/
  migrations/

مدل داده (Post)

فیلد	نوع	توضیح
id	integer	کلید اصلی
title	string	عنوان پست (حداکثر 50 کاراکتر)
description	text/string	توضیحات
author	string	نویسنده (حداکثر 30 کاراکتر)
isComentOn	boolean	فعال بودن امکان کامنت
timestamps	datetime	created_at / updated_at

🔧 پیشنهاد: نام فیلد isComentOn را در آینده به isCommentOn یا comments_enabled تغییر بده.

پیش‌نیازها
	•	PHP 8.2+
	•	Composer
	•	MySQL یا MariaDB
	•	(اختیاری) NodeJS برای فرانت/Build

نصب و راه‌اندازی

git clone https://github.com/USERNAME/REPO.git
cd REPO
composer install
cp .env.example .env
php artisan key:generate

# تنظیمات دیتابیس در .env
php artisan migrate
php artisan serve

Base URL:

http://127.0.0.1:8000

Endpoint ها

Method	URI	توضیح	کد موفق
GET	/api/posts	لیست پست‌ها	200
POST	/api/posts	ایجاد پست	201
GET	/api/posts/{id}	نمایش یک پست	200
PUT	/api/posts/{id}	بروزرسانی کامل	200
PATCH	/api/posts/{id}	بروزرسانی جزئی	200
DELETE	/api/posts/{id}	حذف	200 / 204

نمونه ایجاد پست

curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "First Post",
    "description": "Simple description",
    "author": "Morteza",
    "isComentOn": true
  }'

نمونه پاسخ موفق (201)

{
  "id": 1,
  "title": "First Post",
  "description": "Simple description",
  "author": "Morteza",
  "isComentOn": true,
  "created_at": "2025-07-20T10:12:33.000000Z",
  "updated_at": "2025-07-20T10:12:33.000000Z"
}

نمونه خطای اعتبارسنجی (422)

{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["عنوان الزامی است."]
  }
}

نمونه بروزرسانی جزئی (PATCH)

curl -X PATCH http://127.0.0.1:8000/api/posts/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{ "title": "Edited Title" }'

حذف

curl -X DELETE http://127.0.0.1:8000/api/posts/1 \
  -H "Accept: application/json"

قوانین اعتبارسنجی

Store:

title: required|string|max:50
description: required|string
author: required|string|max:30
isComentOn: boolean

Update:

title: sometimes|required|string|max:50
description: sometimes|required|string
author: sometimes|required|string|max:30
isComentOn: sometimes|boolean

Roadmap (برنامه توسعه)
	•	Pagination
	•	جستجو و فیلتر
	•	احراز هویت (Sanctum)
	•	Authorization (Policies)
	•	تست‌های Feature / Unit
	•	OpenAPI / Swagger
	•	اصلاح نام فیلد isComentOn

⸻

🇬🇧 English Version

Overview

A clean Laravel 12 REST API for managing posts with full CRUD, validation via Form Requests, and Route Model Binding.

Features
	•	CRUD (Create / Read / Update / Delete)
	•	Route Model Binding
	•	Separate Store / Update Form Requests
	•	Partial updates (PATCH + sometimes)
	•	Custom validation messages (multi-language ready)
	•	Ready to extend (Auth, Filters, Pagination)

Folder Structure

app/
  Http/
    Controllers/
      Api/
        PostController.php
    Requests/
      StorePostRequest.php
      UpdatePostRequest.php
routes/
  api.php
database/
  migrations/

Data Model (Post)

Field	Type	Notes
id	integer	PK
title	string	max 50
description	text/string	body
author	string	max 30
isComentOn	boolean	comments enabled
timestamps	datetime	created_at / updated_at

Requirements
	•	PHP 8.2+
	•	Composer
	•	MySQL / MariaDB
	•	(Optional) Node / npm if you add frontend assets

Installation

git clone https://github.com/USERNAME/REPO.git
cd REPO
composer install
cp .env.example .env
php artisan key:generate
# configure DB in .env
php artisan migrate
php artisan serve

Base URL:

http://127.0.0.1:8000

Endpoints

Method	URI	Action	Success
GET	/api/posts	List posts	200
POST	/api/posts	Create post	201
GET	/api/posts/{id}	Show one	200
PUT	/api/posts/{id}	Full update	200
PATCH	/api/posts/{id}	Partial update	200
DELETE	/api/posts/{id}	Delete	200 / 204

Create Example

curl -X POST http://127.0.0.1:8000/api/posts \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "First Post",
    "description": "Simple description",
    "author": "Morteza",
    "isComentOn": true
  }'

Validation Error (422)

{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["Title is required."]
  }
}

Partial Update

curl -X PATCH http://127.0.0.1:8000/api/posts/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{ "title": "Edited Title" }'

Delete

curl -X DELETE http://127.0.0.1:8000/api/posts/1 -H "Accept: application/json"

Validation Rules

Store:

title: required|string|max:50
description: required|string
author: required|string|max:30
isComentOn: boolean

Update:

title: sometimes|required|string|max:50
description: sometimes|required|string
author: sometimes|required|string|max:30
isComentOn: sometimes|boolean

Roadmap
	•	Pagination
	•	Search / Filtering
	•	Authentication (Sanctum)
	•	Authorization (Policies / Gates)
	•	Tests (Feature + Unit)
	•	OpenAPI / Swagger Docs
	•	Rename isComentOn field

License

MIT (optional). Add a LICENSE file if you want.
