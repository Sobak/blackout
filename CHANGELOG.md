# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

## [Unreleased]
### Added
- Complete Translation of following screens:
    - Admin -> Add resources
    - Admin -> Build statistics
    - Admin -> Chat administration
    - Admin -> Configuration
    - Admin -> Errors
    - Admin -> md5 encoder
    - Admin -> Players list
    - Admin -> Subtract resources
    - Admin -> Universum Reset
    - Contact

### Changed
- Changed extension of language files from `*.mo` to `*.php`
- Improved translations of
    - Overview
    - left menu

### Removed
- Eliminated usage of `$phpEx`

## [0.1.1] - 2018-01-06
### Changed
- Added `config.php` to `.gitignore`
- Installation process is now actually available in English
- Switched default language to English

### Fixed
- Eliminate usage of deprecated PHP short tags (`<?`)
- Fixed errors during database creation which resulted in no styles being loaded
- Improved check for `config.php` so installation is triggered correctly

### Removed
- Remove French language files

## [0.1.0] - 2018-01-06
### Added
- Initial import of _xNova 0.3 Multilanguage_ (which is based off xNova 0.8)

### Removed
- Remove all languages except of French, English and Polish
