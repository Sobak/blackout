# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

## [Unreleased]
### Introducing Laravel proxy
Starting with this version all requests are routed through the **Laravel framework**
with original XNova files serving as a fallback wherever it's needed. Such approach
allows to refactor parts of the system independently of each other and mix both
codebases when needed.

### Added
- Added `mysql_*` compatibility layer so that code can run on PHP 7+

### Changed
- Changed minimal version to PHP 7

## [0.4.2] - 2018-01-13
### Added
- Added support for global template variables
- Added `dpath` as global template variable

### Fixed
- Fixed broken installer
- Fixed debug mode reporting incorrect callers for queries
- Fixed incorrect behavior when logged out user was redirected to login when
  visiting main game URL
- Fixed incorrect error time being reported in Admin -> Errors screen
- Fixed incorrect table styling on Defense/Shipyard pages
- Fixed JavaScript errors in chat
- Fixed maintenance mode
- Fixed missing percent sign on "Developed fields" bar in Overview
- Fixed possible SQL Injection via HTTP User Agent
- Fixed unauthenticated user being incorrectly marked as signed in

### Changed
- Dropped chat support for Internet Explorer 6
- Dropped unused and broken `calc.php` file
- More readable design for Admin -> Errors screen
- Queries are only logged when debug mode is enabled
- Redirect to installer regardless of current location in the script
- Refactored the code around user authentication
- Refactored the code for chats

### Removed
- Dropped mercenary report converter
- Dropped unused JS files
- Dropped unused images

## [0.4.1] - 2018-01-11
This version focused on codestyle changes only so that diffs for future releases
will be more meaningfull.

## [0.4.0] - 2018-01-11
### Added
- Added abbility to choose from installed skins using Options screen
- Introduced `dd()` to quickly dump list of passed arguments and halt script execution
- Introduced `message_simple()` to show inline feedback message anywhere on the site
- Password length is now actually enforced when saving options

### Fixed
- Fixed inconsistent number of rows in Galaxy view
- Fixed missing message content in Merchant screen
- Fixed missing message content in Officers screen

### Changed
- Available skins are now discovered dynamically instead of being hardcoded
- Improved translation of following screens
    - Galaxy
    - Officers
    - Friends
    - Imperium
    - Messages
    - Merchant
    - Records
    - Resources
- Minimal password length when changing from options screen is now consistent with signup
- Refactored message-related stuff

### Removed
- Dropped unused _"Use the skin?"_ user option
- Dropped unused _Sex_ user option
- Dropped unused `neusuw.php` file
- Dropped unused field `users.current_luna`
- Dropped unused field `users.sign`
- Dropped unused field `users.kiler`
- Dropped unused fields `users.kolorplus`, `users.kolorminus`, `users.kolorpoziom`
- Dropped unused field `users.raids`
- Dropped unused field `users.p_infligees`
- Dropped abbility to use remote skins
- Dropped concept of user avatars which was never properly implemented

## [0.3.0] - 2018-01-09
### Fixed
- Language selectors for logged out users
- Redirects after displaying a message

### Changed
- **Frames are no longer used**
- Available languages are now discovered dynamically instead of being hardcoded
- Cleaner Options screen
- Deduplicated header-related functions
- Deduplicated language strings for buildings/defenses/officers/ships/technologies
- Improved translation of
    - Admin -> List of Moons
    - Admin -> List of Planets
    - Admin -> Queue fixer
    - Credits
    - Info screen for buildings, defenses, ships and technologies
    - Log in screen
    - Officers
    - Options
    - Overview
    - Registration
- Installer improvements
    - Default database texts (like overview news) are now localized
    - Improved translation
    - Installer generates cleaner config
    - Installer is blocked if config file already exists
- Multiple improvements to the debug mode
- Refactored menu templates
- Refactored planets/moons list in admin panel
- Signin no longer gives a hint whether username or password was incorrect
- Slightly refactored Overview
- Slightly refactored Registration
- Various optimizations

### Removed
- Eliminated redundant `config.users_amount`
- Removed `AdminMessage()`, `message()` should be used instead
- Removed `StdUserHeader()` and `AdminUserHeader()`, `ShowHeader()` should be used instead
- Removed `$AdminPanel` attribute of the `display()` function
- Removed Changelog screen
- Removed bogus Upgrade section of installer
- Removed `informations.php` as it was unused
- Removed UGamela->XNova converter

## [0.2.0] - 2018-01-07
### Added
- Complete translation of following screens:
    - Admin -> Add resources
    - Admin -> Build statistics
    - Admin -> Chat administration
    - Admin -> Configuration
    - Admin -> Errors
    - Admin -> Players list
    - Admin -> Subtract resources
    - Admin -> Universum Reset
    - Contact

### Changed
- Changed extension of language files from `*.mo` to `*.php`
- Improved indentation for most of the files
- Improved translations of
    - Banned
    - Buildings
    - Overview
    - Notes
    - left menu
- Refactored Banned players screen
- Refactored Errors admin panel's screen
- Refactored PHP code for left menus
- Renamed default template from `OpenGame` to `default`

### Removed
- Eliminated usage of `$phpEx`
- Removed Google Adsense code from the template
- Removed md5 encoder from the admin panel

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
