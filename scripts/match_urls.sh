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
awk '{print tolower($0)}' "$CATALOG_FILE" | sed 's|https\?://||; s|www\.||; s|/$||' | sort -t ',' -k1,1 -u > "$TEMP_DIR/normalized_catalog.txt"

echo "Starting comparison process..."
join -t ',' -1 2 -2 1 "$TEMP_DIR/normalized_source.txt" "$TEMP_DIR/normalized_catalog.txt" > "$OUTPUT_FILE"

echo "Process completed!"
echo "Results saved to: $OUTPUT_FILE"

exit 0
