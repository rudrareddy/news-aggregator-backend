```
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

2. Configuration
Bash

```
cp .env.example .env
php artisan key:generate

```

Update `.env` with your database credentials and API keys:
* `NEWS_API_KEY`
* `GUARDIAN_API_KEY`
* `NYT_API_KEY`
3. Database & Data
Bash

```
php artisan migrate
php artisan news:fetch

```

4. Run Server
Bash

```
php artisan serve

```

🔌 API Documentation
Get Articles
Endpoint: `GET /api/articles`
ParameterTypeDescription`qstring`Search keyword`categories[]array`One or more categories (e.g. `tech`, `sports`)`sources[]array`Specific news source names`authors[]array`Specific author names`datestring`Filter by date (`YYYY-MM-DD`)
Example Query: `GET /api/articles?q=crypto&categories[]=finance&categories[]=tech&sources[]=The+Guardian`
🏗 Architectural Implementation
Dependency Inversion (SOLID)
The `ArticleController` does not depend on a concrete repository. It depends on `ArticleRepositoryInterface`. This is managed via the `RepositoryServiceProvider`.
Data Strategy
We use the Strategy Pattern for news sources. Each API has a dedicated Service class. To add a new source (e.g., BBC), you simply create a new Service implementing `NewsSourceInterface` and register it in the aggregator—no existing code needs to be modified.
Deduplication
To prevent database bloating, we use a unique index on the article `url` and the `updateOrCreate()` method. This ensures that even if articles are fetched multiple times, they are updated rather than duplicated.
🧪 Testing
Run the test suite to verify API functionality:
Bash

```
php artisan test

```


```

---

### **One Last Step**
Since this is a backend challenge, recruiters usually appreciate it if you also include a **Postman Collection** (JSON export). 

Would you like me to generate the **JSON for a Postman Collection** so you can include it in your submission? This allows the recruiter to click "Import" and test your work in seconds.

```

Create downloadable file