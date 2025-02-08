# Summary: Exercise 1: : Laravel Api Endpoint & Laravel Artisan Command

## Installation: Step by Step

### Observations
- This app was developed with PHP v8.3
- You can give a look **Dockerfile** and **docker-compose.yaml** files and setup this app using it
- MySQL only for base migrations (configured in `.env`)
- I create a hexagonal architecture for this api using the different layouts as Application, Domain, 
  Infrastructure, etc.

### Setup Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/AndersonBH16/gb-softonic-interview.git
   cd https://github.com/AndersonBH16/gb-softonic-interview.git
   ```

2. Configure environment variables.
   ```sh
   cp .env.example .env
   ```
    - Set database connection details in `.env`

    ```.env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=test-gb-softonic
    DB_USERNAME=testuser
    DB_PASSWORD=T3z6PoW9
    ```

3. Using dockers (Optional)
    - Create and run containers: (it may take some minutes to configure all environment)
         ```sh
         docker-compose up -d --build
         ```
    - Show containers
       ```sh
       docker ps
       ```
    - Access containers:
         ```sh
         docker exec -it app-interview bash
         ```

    - if you need remove the containers created, run: (Optional)
       ```sh
        docker-compose down
      ```

    You can run the next steps also within dockers or local environment

4. Install composer dependencies:
   ```sh
   composer install
   ```

5. Create laravel key
    ```sh
   php artisan key:generate
   ```

6. Run database migrations:
   ```sh
   php artisan migrate
   ```
  
7. Start the application: (if you don't use dockers)
   ```sh
   php artisan serve
   ```
8. If you are using dockers, you must access in you browser:
   ```sh
   localhost:8009
   ```

## 2. Execution Artisan Commands & Testing

### Running the Application
- The main functionality can be accessed via the CLI command:
  ```sh
  php artisan app:get-info {appId}
  ```
  where `{appId}` is the ID of the application to retrieve information for.


- Through browser
   ```
  http://localhost:8009/api/<id>
  ```
  for example:
  ```
  http://localhost:8009/api/21824
  ```
  

### Running Tests
- Execute unit and integration tests using PHPUnit:
  ```sh
  php artisan test
  ```

## 3. Performance & Scalability Considerations
- **Optimized Queries**: Leveraging Services layout, the database queries were optimized.
- **Asynchronous Processing**: We could add jobs or queues can be used to handle large requests in the background.
- **Caching**: We could add caching mechanism can be introduced to avoid redundant data retrieval.
 

## 4. Potential Improvements
- **Better Exception Handling**: Implement custom exceptions to improve error management.
- **Logging & Monitoring**: Use Laravel’s logging capabilities to track posible application behavior.
- **GraphQL or API Gateway**: To make the system more extensible for future integrations.
- **Rate Limiting**: Prevent API abuse by limiting excessive requests.
- **UI/UX**: Can add ui views for users improvement ui/ux experience
- It could be a microservice to proccess data from another app.

## 5. Architectural Overview
This project follows **Hexagonal Architecture (Ports & Adapters)**:
- **Application Layer**: `AppService` handles business logic.
- **Domain Layer**: `App` and `Developer` encapsulate domain models.
- **Infrastructure Layer**: `AppDataService` interacts with external data sources.
- **CLI Interface (Prompt or terminal)**: `GetAppInfo` command acts as the primary entry point for execution.

By structuring the application this way, we ensure **high testability, maintainability, and flexibility** for future modifications.

