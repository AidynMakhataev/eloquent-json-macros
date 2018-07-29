<h1 align="center">Laravel Eloquent JSON Macros</h1>

<p align="center">This package helps you to use MySQL JSON functions in Eloquent style and as helper functions.</p>

<p align="center">
<a href="https://packagist.org/packages/aidynmakhataev/eloquent-json-macros"><img src="https://poser.pugx.org/aidynmakhataev/eloquent-json-macros/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/aidynmakhataev/eloquent-json-macros"><img src="https://poser.pugx.org/aidynmakhataev/eloquent-json-macros/v/unstable" alt="Latest Unstable Version"></a>
<a href="https://styleci.io/repos/142687239"><img src="https://github.styleci.io/repos/142687239/shield"></a>
<a href="https://packagist.org/packages/aidynmakhataev/eloquent-json-macros"><img src="https://poser.pugx.org/aidynmakhataev/eloquent-json-macros/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/aidynmakhataev/eloquent-json-macros"><img src="https://poser.pugx.org/aidynmakhataev/eloquent-json-macros/license" alt="License"></a>
</p>    

## Installation

You can install the package using composer

```sh
$ composer require aidynmakhataev/eloquent-json-macros
```

## Features

- Support macros:
    - [`jsonContains`](#jsonContains)
    - [`orJsonContains`](#orJsonContains)
    - whereJsonContainsPath
    - orWhereJsonContainsPath
    - whereJsonDepth
    - orWhereJsonDepth
    - whereJsonExtract
    - orWhereJsonExtract
    - whereJsonLength
    - orWhereJsonLength
    - selectJsonDepth
    - selectJsonLength

- Available helpers:
    - json_array_append
    - json_array_insert
    - json_insert
    - json_remove
    - json_replace
    - json_set

## Usage

Let's say we have a table `events` with json columns - `browser` and `members`;

###### Browser (dummy json object)
```json 
{"os": "Windows", "name": "Safari", "resolution": {"x": 1920, "y": 1080}}  
```

###### Members (dummy json array)

```json
[{"id": 6, "info": {"job": "Electrolytic Plating Machine Operator", "email": "prohaska.mervin@example.net", "card_type": "Visa"}, "name": "Prof. Eldridge Legros"}, {"id": 8, "info": {"job": "Urban Planner", "email": "casandra54@example.org", "card_type": "Master Card"}, "name": "Ms. Alayna Ziemann DDS"}]
```



### `jsonContains`

Add where clause to the query for indicates whether JSON document contains specific object at path

##### Example (for `browser`json object column)
```php
use App\Models\Event;

Event::jsonContains('browser->os', 'Windows')->get();
Event::jsonContains('browser->resolution.x', 1920)->get();

```

##### Example (for `member`json array column)

```php
use App\Models\Event;

Event::jsonContains('members->[*].id', 6)->get();
Event::jsonContains('members->[1].info.email', 'casandra54@example.org')->get();

```

### `orJsonContains`

Add orWhere clause to the query for indicates whether JSON document contains specific object at path

Usage will be same as in [`jsonContains`](#jsonContains) macro;

### TODO EXPLANATION FOR OTHER MACROS AND HELPERS

## Contributing

1. Fork it (<https://github.com/AidynMakhataev/eloquent-json-macros/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request


## Security

If you discover any security related issues, please email makataev.7@gmail.com instead of using the issue tracker.


## License

MIT