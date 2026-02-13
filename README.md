# 📰 News Aggregator Backend API



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

### 🔌 API Documentation
- **Get Articles**
- **Endpoint:** GET /api/articles

Endpoint: GET /api/articles

- **Example Query**
```bash
GET /api/articles?q=crypto&categories[]=finance&categories[]=tech&sources[]=The+Guardian
```


### 🏗 Architectural Implementation
- **Dependency Inversion (SOLID)**
The ArticleController does not depend on a concrete repository. It depends on ArticleRepositoryInterface. This is managed via the RepositoryServiceProvider.

- **Data Strategy**
We use the Strategy Pattern for news sources. Each API has a dedicated Service class. To add a new source (e.g., BBC), you simply create a new Service implementing NewsSourceInterface and register it in the aggregator—no existing code needs to be modified.

- **Deduplication**
To prevent database bloating, we use a unique index on the article url and the updateOrCreate() method. This ensures that even if articles are fetched multiple times, they are updated rather than duplicated.

