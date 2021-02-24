1.

tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | wc -l



2.

tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq | wc -l

tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq -c | sort -r | head -n 1



3.

