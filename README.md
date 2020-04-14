<p align="center"><img src="https://imgur.com/FKVEMEe.jpg" width="400"></p>

<h1 align="center">Fashion</h1>
<p align="center">
    A fashion discovery website.
</p>
<p align="center">
    <img src="https://github.com/Sniddl/fashion/workflows/Laravel/badge.svg">
    <a href="https://discord.gg/CKUHe6r"><img src="https://img.shields.io/badge/dynamic/json?color=blueviolet&label=Discord&query=presence_count&url=https%3A%2F%2Fdiscordapp.com%2Fapi%2Fguilds%2F669623307225661479%2Fwidget.json"></a>
</p>
<hr>

# About

Think PC Part Picker but clothing.

# Goals
- Create testable/maintainable code.
- Create Laravel 7/Vue components.
- Assure proper Laravel code style is used. (custom services, validators, queues, etc.)

# Installation
Clone the repo.
```
git clone https://github.com/Sniddl/fashion
```

Install composer and npm dependencies.
```
composer install && npm install
```

Generate an environment key.
```
php artisan key:generate
```

Migrate the data base.
```
php artisan migrate
```

Run tests for good measure.
```
php artisan test
```
