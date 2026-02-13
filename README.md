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

### 2. Configuration
 ```bash
cp .env.example .env
php artisan key:generate
```
Update .env with your database credentials and API keys:

NEWSAPI_KEY

GUARDIAN_API_KEY

NYTIMES_KEY

### 3. Database & Data
```bash
php artisan migrate
php artisan news:fetch
```
### 4. Run Server
```bash
php artisan serve
```

🔌 API Documentation
Get Articles
Endpoint: GET /api/articles

Parameter   Type    Description
q   string  Search keyword
categories[]    array   One or more categories (e.g. tech, sports)
sources[]   array   Specific news source names
authors[]   array   Specific author names
date    string  Filter by date (YYYY-MM-DD)

