# Things3 Reviewer

You can create GTD type reviews with this script.


## Usage

- Clone repository
- Clone config: `cp config.php.example config.php`
- Get area IDs from Things3
    - Right-click on area header
    - Click "Share > Copy link" (e.g. `things:///show?id=3VFGRj4kQW1TL2mrJ1sWYN`)
    - Paste ID in area_id array (e.g. `3VFGRj4kQW1TL2mrJ1sWYN`)


## Files

- `activeProjectsQuery.php` - the query template to get the projects from the Things3 SQLite database
- `config.php.example` - the template for the settings
- `LICENSE.md` - MIT license file
- `README.md` - this file
- `review.php` - the script


## Challenges

- Projects with no task are being ignored
- `config.php` style may not be best (but Wordpress uses this as well)
- Sorting is done by count, no options to sort A-Z or group by areas with headlines yet
- SQLite path is taken from terminal path not from config