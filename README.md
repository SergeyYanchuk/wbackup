wbackup
=======

Simple command-line utulity for creating backups wallet.dat files

Requiments
==========

PHP 5.4 or above
php-zip extension for support zip-archives


Usage
=====

./wbackup.php --scan=put_you_scan_directory_here --format=format_here

Supported formats:
- Gzip param value 'gz'
- Zip param value 'zip'
- Bzip2 param value 'bz'
