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
    - [`whereJsonContainsPath`](#whereJsonContainsPath)
    - [`orWhereJsonContainsPath`](#orWhereJsonContainsPath)
    - [`whereJsonDepth`](#whereJsonDepth)
    - [`orWhereJsonDepth`](#orWhereJsonDepth)
    - [`whereJsonExtract`](#whereJsonExtract)
    - [`orWhereJsonExtract`](#orWhereJsonExtract)
    - [`whereJsonLength`](#whereJsonLength)
    - [`orWhereJsonLength`](#orWhereJsonLength)
    - [`selectJsonDepth`](#selectJsonDepth)
    - [`selectJsonLength`](#selectJsonLength)

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

Add where 'JSON_CONTAINS' clause to the query for indicates whether JSON document contains specific object at path

More on: [https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-contains](https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-contains)

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

Add an orWhere 'JSON_CONTAINS' clause to the query for indicates whether JSON document contains specific object at path

Usage will be same as in [`jsonContains`](#jsonContains) macro;

### `whereJsonContainsPath`

Add a where 'JSON_CONTAINS_PATH' clause to the query for indicates whether JSON document contains any data at path

More on: [https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-contains-path](https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-contains-path)

##### Example (for `browser`json object column)

For single path
```php
Event::whereJsonContainsPath('browser', 'resolution')->get();

```
For multiple path

```php
Event::whereJsonContainsPath('browser', ['resolution', 'os'])->get();

```

You can also optionally pass a third parameter ('one' or 'all'), by default used 'one'

```php
Event::whereJsonContainsPath('browser', ['resolution', 'test'], 'all')->get();

```


##### Example (for `member`json array column)

```php
Event::whereJsonContainsPath('members', '[*].info')->get();
Event::whereJsonContainsPath('members', ['[*].info', '[1].test'])->get();
```

### `orWhereJsonContainsPath`
Add an orWhere 'JSON_CONTAINS_PATH' clause to the query for indicates whether JSON document contains any data at path

Usage will be same as in [`whereJsonContainsPath`](#whereJsonContainsPath) macro;


### `whereJsonDepth`
Add a where 'JSON_DEPTH' clause to the query for indicates depth of JSON document

More on: [https://dev.mysql.com/doc/refman/5.7/en/json-attribute-functions.html#function_json-depth](https://dev.mysql.com/doc/refman/5.7/en/json-attribute-functions.html#function_json-depth)

##### Example (for `browser`json object column)
```php
Event::whereJsonDepth('browser->resolution', '>', 1)->get();
Event::whereJsonDepth('browser->os',  2)->get();
Event::whereJsonDepth('browser->resolution.x',  '<=', 1)->get();

```

##### Example (for `member`json array column)

```php
Event::whereJsonDepth('members->[*].info.job', '>=', 1)->get();
Event::whereJsonDepth('members->[1].info.phones[0].fax', '>', 0)->get();

```

### `orWhereJsonDepth`

Add an orWhere 'JSON_DEPTH' clause to the query for indicates depth of JSON document

Usage will be same as in [`whereJsonDepth`](#whereJsonDepth) macro;

### `whereJsonExtract`

Add a where "JSON_EXTRACT" clause to the query.

More on: [https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-extract](https://dev.mysql.com/doc/refman/5.7/en/json-search-functions.html#function_json-extract)

##### Example (for `browser`json object column)
```php
Event::whereJsonExtract('browser->resolution.x', '>', 1500)->get();
Event::whereJsonExtract('browser->name', 'Mozilla Firefox')->get();

```

##### Example (for `member`json array column)

```php
Event::whereJsonExtract('members->[0].id', '>=', 9)->get();
Event::whereJsonExtract('members->[*].info.job', 'LIKE', '%Cleaners%')->get();

```

### `orWhereJsonExtract`

Add an orWhere "JSON_EXTRACT" clause to the query.

Usage will be same as in [`whereJsonExtract`](#whereJsonExtract) macro;

### `whereJsonLength`
Add a where 'JSON_LENGTH' clause to the query.

More on: [https://dev.mysql.com/doc/refman/5.7/en/json-attribute-functions.html#function_json-length](https://dev.mysql.com/doc/refman/5.7/en/json-attribute-functions.html#function_json-length)

##### Example (for `browser`json object column)
```php
Event::whereJsonLength('browser->resolution', '>', 1)->get();
Event::whereJsonLength('browser->os',  4)->get();
Event::whereJsonLength('browser->resolution.x',  '>=', 1)->get();

```

##### Example (for `member`json array column)

```php
Event::whereJsonLength('members->[*]', '>=', 1)->get();
Event::whereJsonLength('members->[1].info.phones[*].fax', '>', 0)->get();

```

### `orWhereJsonLength`

Add an orWhere 'JSON_LENGTH' clause to the query

Usage will be same as in [`whereJsonLength`](#whereJsonLength) macro;



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