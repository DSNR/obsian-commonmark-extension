# obsidian-commonmark-extension

obsidian-commonmark-extension is a custom extension for the CommonMark markdown parser that adds a new inline element and renderer for displaying images with a configurable base URL. A new inline element and parser for obsidian style links and anchors

---
## Installation
You can install the extension using Composer:

```bash
composer require dsnr/obsidian-commonmark-extension
```
## Usage

To use the extension, create a new `League\CommonMark\Environment\Environment` instance, register the extension with the `addExtension()` method, and pass the environment to a new `League\CommonMark\CommonMarkConverter` instance:

The extension expects the image file names to be kebab cased eg. `example-image.ong`

```php
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use Dsnr\ObsidianCommonmarkExtension\ObsidianConverterExtension;


$environment = new Environment();
  $environment->addExtension(new ObsidianConverterExtension());

$converter = new CommonMarkConverter([], $environment);

echo $converter->convertToHtml('![[Example Image.png]]);
```
---
## Configuration
obsidian-commonmark-extension includes a configuration schema that defines the `obsidian.image_base_url` option as a string type with an empty default value. You can modify this option by passing an array of configuration options.

By default, the extension's image base URL is an empty string, so the image URL will be displayed exactly as written. To set a custom image base URL, set the `obsidian.image_base_url ` :

```php
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use Dsnr\ObsidianCommonmarkExtension\ObsidianConverterExtension;

$config = [
  'obsidian' => [
    'base_image_path' => asset('/images/')
  ]
];

$environment = new Environment($config);
$environment->addExtension(new ObsidianConverterExtension());

$converter = new CommonMarkConverter([], $environment);

echo $converter->convertToHtml('![[Example Image.png]]);
```
---

## License
obsidian-commonmark-extension is licensed under the MIT license.

Please let me know if you need any further modifications or clarifications in the readme file.