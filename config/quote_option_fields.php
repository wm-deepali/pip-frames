<?php
return [
    // 📄 Paper Options
    'Paper Type' => ['min_pages', 'max_pages', 'min_qty', 'price'],
    'Paper Size' => ['min_pages', 'max_pages', 'min_qty', 'price'], // assumed to impact per page pricing
    'Paper Weight' => ['min_pages', 'max_pages', 'min_qty', 'price'], // e.g., GSM-based rates
    'Printing Colour' => ['min_pages', 'max_pages', 'min_qty', 'price'], // used for colour vs B/W pricing
    'Orientation' => ['price'], // flat effect — no quantity/page condition

    // 📕 Cover Options
    'Cover Type' => ['min_qty', 'price'], // like hardbound, softcover
    'Cover Binding' => ['min_qty', 'price'], // spiral, perfect, etc.
    'Cover Finish' => ['min_qty', 'price'], // gloss, matte
    'Cover Printing Colour' => ['min_qty', 'price'], // full-color or monochrome
    'Cover Foiling' => ['min_qty', 'price'], // gold/silver foil etc.
];
