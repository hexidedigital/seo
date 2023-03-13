<?php

use Hexide\Seo\Models\XmlSitemap;

return [
    'fields' => [
        'group' => 'Group name',
        'title' => 'Title',
        'description' => 'Description',
        'keywords' => 'Keywords',
        'og_title' => 'OG Title',
        'og_description' => 'OG Description',
        'og_image' => 'OG Image',
        'image_alt' => 'Image Alt',
        'image_title' => 'Image Title',
        'models' => 'Connected Models',
        'microformat_title' => 'Microformat Title',
        'text' => 'Text',
        'gtm_id' => 'Google Tag Manager (GTM id)',
        'ga_tracking_id' => 'Google analytics (GA Tracking id)',
        'fb_pixel_id' => 'Meta Pixel (FB Pixel id)',
        'hjar_id' => 'Hotjar (hjid)',
        'script_type' => 'Script Type',
        'redirect_url' => 'Redirect Url (To)',
        'rule' => 'Redirect Rule (From)',
        'slug' => 'Slug',
        'name' => 'Name',
        'priority' => 'Priority',
        'changefreq' => 'Changefreq',
        'frequency' => 'Update frequency',
        'path' => 'Path',
        'generator' => 'Generetor path',
    ],

    'buttons' => [
        'add' => 'Add',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'submit' => 'Save',
        'back' => 'Back',
    ],

    'actions' => 'Actions',
    'delete_confirmation' => 'Are you sure you want to delete this?',
    'frequencies' => [
        XmlSitemap::FREQUENCY_30_MIN => 'Every 30 minutes',
        XmlSitemap::FREQUENCY_HOUR => 'Every hour',
        XmlSitemap::FREQUENCY_DAY => 'Every day',
        XmlSitemap::FREQUENCY_WEEK => 'Every week',
        XmlSitemap::FREQUENCY_MONTH => 'Every month',
    ],
];
