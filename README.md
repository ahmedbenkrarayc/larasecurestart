
# LaraSecureStart

**LaraSecureStart** is a secure, scalable Laravel 12+ starter kit developed by **Ahmed Benkrara** that brings modern JWT-based authentication with **HTTP-only cookies** and built-in **role-based access control**. It's built with clarity, security, and real-world API architecture in mind.

---

## ⚙️ Features

- ✅ JWT authentication via **secure HTTP-only cookies**
- 🔄 Automatic token **refresh endpoint**
- 🔐 Pre-configured **middlewares**:
  - `jwt.api` → Auth guard via access token (cookie-based)
  - `jwt.refreshtoken` → Refresh token validation
  - `role` → Role-based route restrictions
- 👥 Multi-role support (`admin`, `storeowner`, `customer`, etc.)
- 📩 Forgot and reset password endpoints
- 🌍 CORS fully configured for SPA/frontend interaction
- 📦 Easy installation via **Composer** or **Laravel Installer**
- 🚀 Production-ready out of the box (automated `.env`, `APP_KEY`, and `JWT_SECRET` generation)

---

## 🚀 Installation

### Option 1: Laravel Installer (Recommended)

```bash
laravel new your-app-name --using=ahmedbenkrarayc/larasecurestart
```

### Option 2: Composer

```bash
composer create-project ahmedbenkrarayc/larasecurestart your-app-name
```

🛠 After installation:

```bash
cd your-app-name
php artisan migrate
php artisan serve
```

> ✅ `.env`, `APP_KEY`, and `JWT_SECRET` are all generated automatically.

---

## 🔐 Authentication Flow

| Endpoint               | Method | Description                       | Middleware              |
|------------------------|--------|-----------------------------------|--------------------------|
| `/api/register`        | POST   | Register a new user               | –                        |
| `/api/login`           | POST   | Authenticate and issue tokens     | –                        |
| `/api/logout`          | POST   | Clear tokens from HTTP-only cookie| `jwt.api`                |
| `/api/refresh`         | POST   | Get a new access token            | `jwt.refreshtoken`       |
| `/api/forgot-password` | POST   | Send reset link via email         | –                        |
| `/api/reset-password`  | POST   | Reset password with email token   | –                        |
| `/api/user`            | GET    | Get authenticated user            | `jwt.api`                |

---

## 🔐 Role-Based Access Middleware

Use the `role` middleware to restrict access to routes by user role:

```php
Route::middleware(['jwt.api', 'role:admin'])->get('/admin/dashboard', ...);
Route::middleware(['jwt.api', 'role:storeowner'])->post('/products', ...);
Route::middleware(['jwt.api', 'role:storeowner,superadmin'])->delete('/stores/{id}', ...);
```

Middleware logic is located in:

```
app/Http/Middleware/
├── JwtMiddleware.php
├── JwtRefreshMiddleware.php
└── RoleMiddleware.php
```

---

## 🧠 Example Route Group Usage

Your `api.php` might look like this:

```php
// Public
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Refresh
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.refreshtoken');

// Authenticated
Route::middleware(['jwt.api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

// Role-protected
Route::get('/storeowners', [AuthController::class, 'storeOwnersList'])->middleware(['jwt.api', 'role:superadmin']);
```

---

## 🌐 CORS Configuration

Preconfigured and located at:

```bash
config/cors.php
```

Supports:
- Multiple domains
- `withCredentials: true` for HTTP-only cookie handling
- Safe for SPAs like Vue, React, Nuxt, etc.

---

## 🧑‍💻 About the Creator

**Ahmed Benkrara**  
📧 [ahmed.benkrara11@gmail.com](mailto:ahmed.benkrara11@gmail.com)  
🔗 [GitHub: ahmedbenkrarayc](https://github.com/ahmedbenkrarayc)

---

## 📝 License

This project is licensed under the Creative Commons Attribution 4.0 International License (CC BY 4.0).
