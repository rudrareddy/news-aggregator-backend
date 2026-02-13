# 📰 News Aggregator Backend API

This is a technical assessment project for the Backend Developer position. The system aggregates news articles from multiple sources and serves them via a highly flexible, filtered API.

## 🚀 Key Features
- **Data Aggregation:** Automated fetching from **The Guardian**, **New York Times**, and **NewsAPI.org**.
- **SOLID Architecture:** Implements the Repository Pattern and Dependency Inversion.
- **Advanced Filtering:** Search by keyword, multiple categories, specific sources, and authors.
- **Automated Sync:** Custom Artisan command ready for scheduling.

---

## 🛠 Setup Instructions

### 1. Clone & Install
```bash
git clone <your-repo-link>
cd news-aggregator-backend
composer install
```

### 2.Configuration
 ```bash
cp .env.example .env
php artisan key:generate
```