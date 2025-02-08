#!/bin/bash

if [ "$#" -ne 4 ]; then
    echo "Usage: $0 source_file catalog_file output_file threshold"
    exit 1
fi

SOURCE_FILE=$1
CATALOG_FILE=$2
OUTPUT_FILE=$3
THRESHOLD=$4

echo "Starting process..."
echo "Reading source file: $SOURCE_FILE"
echo "Reading catalog file: $CATALOG_FILE"

TEMP_DIR=$(mktemp -d)
trap 'rm -rf "$TEMP_DIR"' EXIT

echo "Normalizing and sorting source URLs..."
awk -F',' '{print $1","tolower($2)}' "$SOURCE_FILE" | sed 's|https\?://||; s|www\.||; s|/$||' | sort -t ',' -k2,2 -u > "$TEMP_DIR/normalized_source.txt"

echo "Normalizing and sorting catalog URLs..."
awk '{print tolower($0)}' "$CATALOG_FILE" | sed 's|https\?://||; s|www\.||; s|/$||' | sort -u > "$TEMP_DIR/normalized_catalog.txt"

echo "Counting duplicates..."
MATCH_COUNT=$(join -t ',' -1 2 -2 1 "$TEMP_DIR/normalized_source.txt" "$TEMP_DIR/normalized_catalog.txt" | wc -l)

if [ "$MATCH_COUNT" -eq "0" ]; then
    echo "No duplicates found."
    echo "Writing IDs from source file to output."
    # Write all IDs from source to output
    awk -F',' '{print $1}' "$SOURCE_FILE" > "$OUTPUT_FILE"
else
    echo "Duplicated entries found. Writing non-duplicated IDs to output."
    # This line should be altered to capture those that are NOT a match
    join -t ',' -v 1 -1 2 -2 1 "$TEMP_DIR/normalized_source.txt" "$TEMP_DIR/normalized_catalog.txt" > "$OUTPUT_FILE"
fi

echo "Process completed!"
echo "Results saved to: $OUTPUT_FILE"

exit 0
