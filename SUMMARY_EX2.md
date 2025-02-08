# Exercise 2: Laravel Artisan Command Detect Duplicates

## How to Run code/tests
**Important:**

This exercise was developed in the same project as exercise 1. So you can follow the same steps in `SUMMARY_EX1.md`

1. Execute the command:
```bash
php artisan app:detect-duplicates
```

2. Run tests:
```bash
php artisan test --filter=DetectDuplicatesCommandTest
```

## Why I choose Bash?

1. **Performance**: Bash is perfect for file operations, with built-in commands optimized for these tasks
2. **System Resources**: Bash scripts have minimal overhead and don't require additional runtime environments
3. Because some instructions as `awk`, `sed`, and `tr` are highly efficient for string manipulation
5. And also I had some knowledge on bash scripts 😁

## What would you do to improve the performance/scalability if you would not have any constraints?

I would consider:

1. Parallel Processing with multiple files.
2. Database Integration adding indexing.
3. Implementing a caching system for frequently accessed URLs.
4. Integrate with another processing services as scraping with curl. 
4. Using distributed computing, yey maybe.

## What would you have done differently if you had had more time

I would:

1. Create UI/UX for improving users experience.
2. Add more sophisticated URL normalization.
3. Implement better error handling and logging.
4. Add progress reporting for large files, it allows us checking the advance.
5. Implement more unit tests.
6. Maybe Optimize the similarity calculation algorithm.
7. We have the input files hardcoded located on: `storage/input-files` and the output file located on: `storage/output-files`,
   but you could add external files dynamically
