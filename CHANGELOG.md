# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

## [Unreleased]
### Added
- Full translation of Admin -> Add resources
- Full translation of Admin -> Build statistics
- Full translation of Admin -> Chat administration
- Full translation of Admin -> Configuration page
- Full translation of Admin -> Errors
- Full translation of Admin -> md5 encoder
- Full translation of Admin -> Players list
- Full translation of Admin -> Subtract resources
- Full translation of Admin -> Universum Reset

### Changed
- Changed extension of language files from `*.mo` to `*.php`
- Improved translation of left menu

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
