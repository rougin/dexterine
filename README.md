# Dextra

`Dextra` is a PHP utility package that provides templates based on [alpine.js](https://alpinejs.dev/) for handling frontend CRUD.

## Installation

Install the package using [Composer](https://getcomposer.org/):

``` bash
$ composer require rougin/dextra
```

## Basic usage

Use the `Depot` class to create CRUD methods based on JavaScript:

``` php
// src/Pages/Items.php

// ...

use Psr\Http\Message\ServerRequestInterface;
use Rougin\Dextra\Depot;
use Rougin\Gable\Pagee;

class Items
{
    public function index(ItemDepot $item, ServerRequestInterface $request)
    {
        // "items" will be the variable name in the frontend ---
        $depot = new Depot('items');
        // -----------------------------------------------------

        // Prepare the pagination --------------------------
        $pagee = Pagee::fromRequest($request)->asAlpine();

        $link = $plate->getLinkHelper()->set('items');

        $pagee->setLink($link)->setTotal($item->getTotal());

        $data['pagee'] = $pagee;
        // -------------------------------------------------

        $data = compact('depot', 'pagee');

        // ...
    }
}
```

> [!NOTE]
> `Pagee` from the `Gable` package may be required if there's a need to load paginated data.

## Methods

### withInit

Creates an `init` method. This method initializes any defined `Select` elements using [tom-select](https://tom-select.js.org/). After initialization, it calls the `load` method with the initial page number to fetch data:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withInit($pagee->getPage()) ?>
</script>
```

### withLoad

Creates the `load` method. This method fetches paginated data from a `GET` request. Upon receiving a response, it updates the component's `items` data property with the fetched data and the `pagee` data property with pagination details (limit, pages, total):

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withLoad($pagee)
  ->setLink($url->set('/v1/items')) ?>
</script>
```

### withStore

Creates a `store` method. This is used for sending a `POST` request to the specified link to create a new item. It collects data from the defined fields, and shows an alert upon successful creation before reloading the data:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withStore()
  ->addField('name')
  ->addField('detail')
  ->setAlert('Item created!', 'Item successfully created.')
  ->setLink($url->set('/v1/items')) ?>
</script>
```

### withEdit

Creates an `edit` method. This method is used to populate a modal with the data of a selected item. It takes an `item` object as a parameter and assigns its properties to the corresponding fields in the modal. It can also show or hide other modals:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withEdit()
  ->addField('name')
  ->addField('detail')
  ->addField('id')
  ->showModal('item-detail-modal') ?>
</script>
```

### withUpdate

Creates an `update` method. This method is used for sending a `PUT` request to the specified link to update an existing item. It collects data from the defined fields, includes the item's ID in the request, and shows an alert upon successful update before reloading the data:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withUpdate()
  ->addField('name')
  ->addField('detail')
  ->setAlert('Item updated!', 'Item successfully updated.')
  ->setLink($url->set('/v1/items')) ?>
</script>
```

### withTrash

Creates a `trash` method. This method is used to populate a modal for confirming the deletion of an item. It takes an `item` object as a parameter and assigns its properties to the corresponding fields in the modal. It can also show or hide other modals:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withTrash()
  ->addField('name')
  ->addField('id')
  ->showModal('delete-item-modal') ?>
</script>
```

### withRemove

Creates a `remove` method. This method is used for sending a `DELETE` request to the specified link to remove an item. It takes the item's ID as a parameter, includes it in the request, and shows an alert upon successful deletion before reloading the data:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withUpdate()
  ->addField('name')
  ->addField('detail')
  ->setAlert('Item updated!', 'Item successfully updated.')
  ->setLink($url->set('/v1/items')) ?>
</script>
```

### withClose

Creates a `close` method. This method is used to close modals and reset the values of specified fields. It can also hide other modals and reset fields based on a provided script:

``` html
// app/plates/items/depot.php

<script type="text/javascript">

// ...

<?= $depot->withClose()
  ->withScript($script)
  ->hideModal('delete-item-modal')
  ->hideModal('item-detail-modal')
  ->resetField('detail')
  ->resetField('error')
  ->resetField('id')
  ->resetField('name')
  ->resetField('loadError') ?>
</script>
```

## Change log

See [CHANGELOG](CHANGELOG.md) for more recent changes.

## Development

Includes tools for code quality, coding style, and unit tests.

### Code quality

Analyze code quality using [phpstan](https://phpstan.org/):

``` bash
$ phpstan
```

### Coding style

Enforce coding style using [php-cs-fixer](https://cs.symfony.com/):

``` bash
$ php-cs-fixer fix --config=phpstyle.php
```

### Unit tests

Execute unit tests using [phpunit](https://phpunit.de/index.html):

``` bash
$ composer test
```
