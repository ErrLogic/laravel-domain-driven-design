# Laravel Domain-Driven Design (DDD) Boilerplate

This repository provides a clean, opinionated **Domain-Driven Design (DDD)** architecture implemented on top of **Laravel 12**, powered by **FrankenPHP** for a modern, high-performance PHP runtime.

It is designed for engineers who want to move beyond traditional Laravel MVC and adopt a more scalable, maintainable, and explicit domain architecture.

---

## 📚 Table of Contents

* [Overview](#overview)
* [Key Features](#key-features)
* [Architecture Structure](#architecture-structure)
* [Why DDD?](#why-ddd)
* [FrankenPHP Integration](#frankenphp-integration)
* [API Response Format](#api-response-format)
* [Testing & Coverage](#testing--coverage)
* [Running Tests](#running-tests)
* [Perfect For](#perfect-for)
* [License](#license)

---

## 🔍 Overview

This boilerplate enforces clear separation between:

* **Domain**
* **Application**
* **Infrastructure**
* **Interface (HTTP)**

and aims to keep business rules pure while containing Laravel-specific code within the framework boundaries.

With the addition of **FrankenPHP**, the project benefits from:

* Worker mode
* Native caching
* Faster boot time
* Better performance than traditional PHP-FPM

---

## ✨ Key Features

### ✔ Pure Domain Layer (framework-free)

* Domain Entities with explicit invariants
* Strongly typed `ValueObjects`
* Domain Services for business operations
* Repository interfaces defined around domain needs

### ✔ Application Layer (Use Cases & DTOs)

* Each workflow becomes an explicit **Use Case Handler**
* DTOs map request input to domain values
* Encapsulated logic that remains testable without Laravel

### ✔ Infrastructure Layer (Persistence, Eloquent, Mappers)

* Eloquent Models isolated under `Infrastructure/`
* ORMs never leak into domain
* Mappers handle conversion between Domain Entities ↔ Eloquent Models
* Repository implementations fulfill domain-defined contracts

### ✔ Interface Layer (HTTP Controllers, Requests, Resources)

* Ultra-thin controllers using dependency injection
* Form Requests handle validation
* API Resources transform domain entities into JSON

### ✔ Consistent API Response System

All responses follow this structure:

```json
{
  "success": true,
  "message": "Users retrieved successfully.",
  "data": [...],
  "meta": {
    "total": 10,
    "count": 10,
    "per_page": 15,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

## 🏛 Architecture Structure

```
app/
  Domain/
    User/
      Entities/
      ValueObjects/
      Services/
      Repositories/
      Exceptions/

  Application/
    User/
      DTO/
      UseCases/

  Infrastructure/
    Persistence/
      Eloquent/
        Models/
        Repositories/
        Mappers/
    Http/
      Clients/

  Interfaces/
    Http/
      Controllers/
      Requests/
      Resources/
      Responses/
```

This structure keeps domain logic pure and infrastructure replaceable.

---

## 🎯 Why DDD?

Traditional Laravel MVC encourages:

* Fat controllers
* Fat models
* Tight coupling between domain & framework
* Difficulty testing business rules

This project solves those issues by:

* Keeping **business logic in the domain**
* Using **use cases** to express application flows
* Making infrastructure (Eloquent, API clients) replaceable
* Improving testability through pure domain logic

Perfect for large codebases, microservices, or teams that need engineering discipline.

---

## ⚡ FrankenPHP Integration

This project supports running Laravel using **FrankenPHP**, which provides:

* Worker mode (Octane-like performance)
* Built-in caching & session support
* Faster request handling
* Reduced bootstrapping overhead
* Better memory efficiency

### 🔧 Running Laravel via FrankenPHP

Install frankenphp:

```bash
composer require laravel/octane
```

Run the app:

```bash
php artisan octane:install --server=frankenphp
```

This gives you a persistent worker with much better throughput than PHP-FPM. More config, please visit https://frankenphp.dev/docs/laravel/

---

## 🧪 Testing & Coverage

The project includes:

* **Feature tests** for API endpoints
* **Unit tests** for Domain & Application layers
* **Clover coverage** output for SonarQube

### PHPUnit Coverage Example

```bash
composer test:coverage
```

Generates:

```
storage/logs/clover.xml
```

Which SonarQube can read for code coverage.

---

## 🧵 Running Tests

Feature tests:

```bash
composer test
```

Coverage + reports:

```bash
composer test:coverage
```

---

## 🚀 Perfect For

* Large-scale Laravel applications
* Microservices using PHP
* Teams adopting DDD / Clean Architecture / Hexagonal
* Developers moving to FrankenPHP for performance gains
* Projects requiring long-term maintainability and testability

---

## 📜 License

This project is open-source and available under the MIT license.

---
