# RateMedia.ru adapters for your sites

This repository contains adapters for integrating survey into your site.

Currently we provide only simple PHP adapter - `RateMediaAdapter.php`.

## Using simple PHP adapter

```php
    
    // include PHP adapter class
    include_once('RateMediaAdapter.php');


    // outputs <A> tag
    echo RateMediaAdapter::generateAnchor(
        'Take the survey',  // Anchor(link) text for your link
        1101, // Survey ID provided on ratemedia.ru integration apge
        'btn btn-primary', // add 'class' attribute to <A> tag
        'survey-button', // add 'id' attribute to <A> tag. You can leave it - adapter will generate unique id for this tag
        'survey-button-click', // Describe event for tracking incoming survey visitors
        'http://example.com/survey-success-page', // Success page
        'http://example.com/',
        array(
            'user_name' => Yii::$app->user->identity->username,
            'order_number' => $order->id,
        )
    );

```

This function will generate a special <A> tag with the correct 'href' attribute.
Also, it will append to URL a special parameter - `piwik_visitor_id`, if there is correct setup of piwik on your site. You may also need jQuery working on your site.

