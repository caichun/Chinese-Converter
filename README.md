## Chinese Converter

```php
function chinese_convert($input)
{
	$zh2tw      = include dirname(__FILE__) . '/libs/zh2tw.php';
	$zh2hant    = include dirname(__FILE__) . '/libs/zh2hant.php';
	$new_needle = array_merge($zh2tw, $zh2hant);
	$needle     = array_keys($new_needle);
	$output     = str_replace($needle, $new_needle, $input);
	return $output;
}
```