<?php

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings' => [
        'default' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'p,br,b,strong,i,em,u,s,ul,ol,li,h2,h3,h4,h5,h6,blockquote,a[href|title|target],img[src|alt|width|height],span,div,table,thead,tbody,tr,th,td,hr,pre,code',
            'HTML.AllowedAttributes' => 'a.href, a.title, a.target, img.src, img.alt, img.width, img.height',
            'URI.AllowedSchemes' => ['http' => true, 'https' => true, 'mailto' => true],
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => true,
            'HTML.SafeIframe' => false,
        ],
        'strict' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'p,br,b,strong,i,em,ul,ol,li,h2,h3,h4,a[href|title],img[src|alt]',
            'AutoFormat.RemoveEmpty' => true,
        ],
    ],
];
