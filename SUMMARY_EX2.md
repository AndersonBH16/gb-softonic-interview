# Exercise 2: Duplicate Detection Summary

## How to Run

1. Execute the command:
```bash
php artisan app:detect-duplicates {source_file} {catalog_file} {output_file}
```

2. Run tests:
```bash
php artisan test --filter=DetectDuplicatesCommandTest
```

## Why Bash?

I chose Bash for several reasons:
1. **Performance**: Bash is excellent for text processing and file operations, with built-in commands optimized for these tasks
2. **System Resources**: Bash scripts have minimal overhead and don't require additional runtime environments
3. **Text Processing Tools**: Built-in tools like `awk`, `sed`, and `tr` are highly efficient for string manipulation
4. **Process Management**: Easy integration with the system and excellent process handling

## Performance/Scalability Improvements

Without constraints, I would consider:

1. **Parallel Processing**: Process the files in chunks using parallel execution
2. **Database Integration**: For very large datasets, using a database with proper indexing
3. **Memory-Mapped Files**: For better performance with large files
4. **Optimized Data Structures**: Using bloom filters for initial filtering
5. **Caching**: Implementing a caching system for frequently accessed URLs
6. **Distributed Processing**: Using distributed computing frameworks for massive datasets

## What I Would Do Differently

With more time, I would:

1. Add more sophisticated URL normalization
2. Implement better error handling and logging
3. Add progress reporting for large files
4. Implement more unit tests and edge cases
5. Add configuration options for similarity algorithm parameters
6. Optimize the similarity calculation algorithm
7. Add validation for file formats and content
8. Implement batch processing for better memory management
