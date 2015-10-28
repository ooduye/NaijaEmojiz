# NaijaEmojiz

[![Build Status][ico-travis]][link-travis]

A RestAPI service for Nigeria's favorite emojis. The API uses simple token based authentication

## Testing

The phpspec suite for testing is used to perform unit test on the classes. The TDD principle has been employed to make the application robust

Run this on bash to execute the tests

 ```bash
 $ vendor/bin/phpspec run
 ```
 
## Usage

Visit [NaijaEmojiz](http://naijaemojiz.herokuapp.com/).

## Methods accessible to the public

* Single emoji retrieval

REQUEST:
``` bash
GET https://naijaemojiz.herokuapp.com/emoji/2
HEADER: {"Content-Type": "application/json"}
```
RESPONSE: If resource 2 exist, the response should be:
``` bash
HEADER: {"status": 200}
BODY:
{
  "id": 2,
  "name": "Olorun Maje",
  "emoji_char": "🙅",
  "keywords": [
    "God forbid",
    " Lailai",
    " Never"
  ],
  "category": "people",
  "date_created": "2015-10-28 11:56:59",
  "date_updated": "2015-10-28 11:59:16",
  "created_by": "yemisi"
}
```
Else the response would be:
``` bash
HEADER: {"status": 404}
BODY:
{
  "message": "Emoji ID 2 does not exist"
}
```

* All emojis retrieval

REQUEST:
``` php
HEADER: GET https://naijaemojiz.herokuapp.com/emojiz
BODY: If there are saved resources
[
  {
    "id": 1,
    "name": "Mogbe",
    "emoji_char": "🙆",
    "keywords": [
      "I’m in trouble",
      " Wahala"
    ],
    "category": "people",
    "date_created": null,
    "date_updated": null,
    "created_by": "yemisi"
  },
  {
    "id": 2,
    "name": "Olorun Maje",
    "emoji_char": "🙅",
    "keywords": [
      "God forbid",
      " Lailai",
      " Never"
    ],
    "category": "people",
    "date_created": "2015-10-28 11:56:59",
    "date_updated": "2015-10-28 11:59:16",
    "created_by": "yemisi"
  }
]
```

* Login authentication

REQUEST:
``` bash
POST https://naijaemojiz.herokuapp.com/login
HEADER: {"Content-Type": "application/json"}
BODY:
{
  "username": your_username,
  "password": your_password
}
```
RESPONSE:
``` bash
HEADER: {"status": 200}
BODY:
{
  "username": "ogeni1",
  "token": "dff6e05687698b9a7b4dc7ed32bef67d"
}
```

## Private Methods (Registration required)

* Registration

REQUEST:
``` bash
POST https://naijaemojiz.herokuapp.com/register
HEADER: {"Content-Type": "application/json"}
BODY:
{
  "username": your_preferred_username,
  "password": your_preferred_password,
  "name": your_name,
  "purpose": your_purpose_for_registration
}
```
RESPONSE:
``` bash
HEADER: {"status": 200}
BODY:
{
  "username": "ogeni",
  "message": "User has been created"
}
```

* Logout

REQUEST:
``` bash
GET https://naijaemojiz.herokuapp.com/logout
HEADER:
{
  "Content-Type": "application/json",
  "Authorization": "dff6e05687698b9a7b4dc7ed32bef67d"
}
```
RESPONSE:
``` bash
HEADER: {"status": 200}
BODY:
{
  "message": "You have been successfully logged out"
}
```

* Posting of emojis

REQUEST:
``` bash
POST https://naijaemojiz.herokuapp.com/emoji
HEADER:
{
  "Content-Type": "application/json",
  "Authorization": "dff6e05687698b9a7b4dc7ed32bef67d"
}
BODY:
{
  "emoji_name": "ojuju calabar",
  "emoji_char": "👹",
  "category": "festival",
  "keyword": "masquerade eegun ojuju_calabar"
}
```
RESPONSE:
```bash
HEADER: {"status": 200}
BODY:
{
    "message": "Emoji was created"
}
```

* Updating emojis

REQUEST:
``` bash
PUT https://naijaemojiz.herokuapp.com/emoji/20
PATCH https://naijaemojiz.herokuapp.com/emoji/20
HEADER:
{
  "Content-Type": "application/json",
  "Authorization": "dff6e05687698b9a7b4dc7ed32bef67d"
}
BODY:
{
  "category": "scary"
}
```
RESPONSE:
```bash
HEADER: {"status": 200}
BODY:
{
  "message": "Emoji 20 updated successfully"
}
```

* Deletion of emojis

REQUEST:
```bash
DELETE https://naijaemojiz.herokuapp.com/emoji/20
HEADER:
{
  "Content-Type": "application/json",
  "Authorization": "dff6e05687698b9a7b4dc7ed32bef67d"
}
```
RESPONSE:
``` bash
HEADER: {"status": 200}
BODY:
{
  "message": "Emoji 20 deleted sucessfully"
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email oluwayemisioduye@gmail.com instead of using the issue tracker.

## Credits

- Oduye Oluwayemisi

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-travis]: https://img.shields.io/travis/andela-ooduye/EvangelistStatus/master.svg?style=flat-square

[link-travis]: https://travis-ci.org/andela-ooduye/EvangelistStatus
[link-author]: https://github.com/andela-ooduye
[link-contributors]: ../../contributors