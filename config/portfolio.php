<?php

return [
    'name'   => 'Kenneth Malinao',
    'email'  => 'kennethmalinao40@gmail.com',
    'github' => 'kenzzz20',

    // Mga group sa sidebar: [label, route name]. May divider sa pagitan ng bawat group.
    // Para mag-hide, maglagay lang ng "//" sa unahan ng linya.
    'nav' => [
        [
            // ['Shop', 'shop'], 
            ['Blog', 'blog'], 
            ['Gear', 'gear'], 
            // ['Resources', 'resources']
        ],
        [
            // ['Collabs', 'collabs'], 
            // ['Consulting', 'consulting']
        ],
        [
            ['Projects', 'projects'],
            ['Experience', 'experience'],
            ['Stack', 'stack'],
            ['Certifications', 'certifications'],
            // ['Recommendations', 'recommendations'],
            // ['Affiliations', 'affiliations']
        ],
    ],

    'socials' => [
        ['github', 'https://github.com/kenzzz20'],
        ['linkedin', 'https://linkedin.com'],
        ['facebook', 'https://www.facebook.com/kennet.malinao37'],
    ],

    'projects' => [
        ['title' => 'Portfolio CMS', 'desc' => 'Laravel content system for case studies, with a dark admin UI and Alpine inline editing.', 'tags' => ['Laravel', 'Tailwind', 'Alpine.js', 'MySQL'], 'image' => 'https://picsum.photos/seed/cms1/800/500', 'badge' => 'Featured', 'demo' => '#', 'repo' => '#'],
        ['title' => 'Taskflow', 'desc' => 'Lightweight project tracker with Kanban boards and role-based access.', 'tags' => ['Laravel', 'Alpine.js'], 'image' => 'https://picsum.photos/seed/task1/800/500', 'badge' => null, 'demo' => '#', 'repo' => '#'],
        ['title' => 'InvoiceKit', 'desc' => 'Client invoicing dashboard with PDF exports, reminders, and MySQL reporting.', 'tags' => ['Laravel', 'Tailwind', 'MySQL'], 'image' => 'https://picsum.photos/seed/inv1/800/500', 'badge' => null, 'demo' => '#', 'repo' => '#'],
        ['title' => 'Studio Landing', 'desc' => 'High-contrast marketing site with bento layouts and a daisyUI kit.', 'tags' => ['Tailwind', 'daisyUI', 'Alpine.js'], 'image' => 'https://picsum.photos/seed/studio1/800/500', 'badge' => null, 'demo' => '#', 'repo' => '#'],
    ],

    'experience' => [
        ['year' => '2025', 'role' => 'Full-Stack Developer', 'org' => 'Surigao City Jail · BJMP'],
        ['year' => '2024', 'role' => 'Freelance Web Developer', 'org' => 'Self-employed'],
        ['year' => '2023', 'role' => 'Front-end / UI Designer', 'org' => 'Freelance'],
    ],

    'skills' => ['Laravel 12', 'PHP 8.3', 'MySQL', 'REST APIs', 'Tailwind CSS', 'daisyUI', 'Alpine.js', 'Blade', 'Vite', 'Git', 'UI Design', 'Responsive Layouts', 'Figma', 'Adobe Photoshop', 'Capcut'],

    'certifications' => [
        ['name' => 'Certificate of Participation', 'issuer' => 'Benneth A. Aloyon', 'image' => 'certs/COP.jpg', 'url' => '#'],
        ['name' => 'Certificate of Recognition (2024-2025)', 'issuer' => 'Benneth A. Aloyon', 'image' => 'certs/COR1.jpg', 'url' => '#'],
        ['name' => 'Certificate of Recognition (2025-2026)', 'issuer' => 'Benneth A. Aloyon', 'image' => 'certs/COR2.jpg', 'url' => '#'],
    ],

    'recommendations' => [
        ['quote' => 'Palitan mo ito ng totoong testimonial.', 'who' => 'Juan Dela Cruz', 'title' => 'Position, Company'],
        ['quote' => 'Palitan mo ito ng totoong testimonial.', 'who' => 'Maria Santos', 'title' => 'Position, Company'],
    ],

    'affiliations' => [
        ['name' => 'Community Name', 'role' => 'Member', 'url' => '#'],
        ['name' => 'Organization', 'role' => 'Organizer', 'url' => '#'],
    ],

    'hackathons' => [
        ['result' => 'Finalist · 2025', 'name' => 'Hackathon Name', 'org' => 'Organizer'],
    ],

    'posts' => [
        [
            'slug' => 'first-post',
            'title' => 'My first post',
            'excerpt' => 'Short summary here.',
            'date' => 'Nov 2026',
            'body' => "Unang paragraph.\n\nPangalawang paragraph."
        ],
    ],

    // shop / resources: name, desc, tag, url
    'shop' => [
        ['name' => 'Laravel Starter Kit', 'desc' => 'Auth + admin + Tailwind.', 'tag' => '₱499', 'url' => '#'],
    ],

    // Gear is now grouped by sections (Desk Setup, Everyday Carry, etc.)
    'gear' => [
        [
            'title' => 'Desk Setup',
            'items' => [
                [
                    'name' => 'Acer Aspire Go 14',
                    'desc' => 'Ryzen 5 7520U, 8GB RAM, 256GB SSD.',
                    'image' => 'images/Gear/Laptop.jpg',
                    'url'  => 'https://www.acer.com/ph-en/laptops/aspire/aspire-go-amd/pdp/NX.KSKSP.001',
                ],
                [
                    'name' => 'N-Vision N2455GT-B Monitor',
                    'desc' => '23.8" FHD 144Hz IPS Monitor.',
                    'image' => 'images/Gear/Monitor.jpg',
                    'url'  => 'https://easypc.com.ph/collections/nvision/products/nvision-n2455gt-b-23-8-fhd-144hz-ips-monitor?variant=46445082476715',
                ],
                [
                    'name' => 'Inplay STX390 Keyboard & Mouse Combo',
                    'desc' => 'RGB Lighting Effects, Multimedia Keys.',
                    'image' => 'images/Gear/Keyboard.jpg',
                    'url'  => 'https://business.shoppable.ph/inplay-b.158/inplay-stx390-2-in-1-multimedia-keyboard-and-mouse-or-rgb-combo-p.65417',
                ],
                [
                    'name' => 'Inplay Laptop Cooling Pad',
                    'desc' => 'Keep your laptop cool during long sessions.',
                    'image' => 'images/Gear/CoolingPad.jpg',
                    'url'  => 'https://www.lazada.com.ph/products/inplay-n33-laptop-cooling-pad-stand-adjustable-bottom-corner-with-phone-holder-for-12-17-inch-laptop-i4395828618-s133157605357.html?from_gmc=1&fl_tag=1',
                ],
                [
                    'name' => 'Jolly Plastic Rattan Table & Chair Set',
                    'desc' => 'Outdoor furniture for the balcony.',
                    'image' => 'images/Gear/Furniture.jpg',
                    'url'  => 'https://jollyplastic.ph/product/rattan-table-30x48-6-seaters/',
                ],
            ]
        ],
        [
            'title' => 'Everyday Carry',
            'items' => [
                [
                    'name' => 'Redmi Turbo 4 Pro',
                    'desc' => 'White, 8GB RAM, 256GB Storage.',
                    'image' => 'images/Gear/Redmi.jpg', // Palitan ng totoong path
                    'url'  => 'https://www.gsmarena.com/xiaomi_redmi_turbo_4_pro-13617.php',
                ],
                [
                    'name' => 'Redmi Buds 6 Play',
                    'desc' => 'Daily audio & calls.',
                    'image' => 'images/Gear/RedmiBuds.jpg', // Palitan ng totoong path
                    'url'  => 'https://www.mi.com/ph/product/redmi-buds-6-play/',
                ],
            ]
        ],
    ],

    'resources' => [
        ['name' => 'Laravel Docs', 'desc' => 'Official documentation.', 'tag' => 'Docs', 'url' => 'https://laravel.com/docs'],
        ['name' => 'daisyUI', 'desc' => 'Tailwind component library.', 'tag' => 'UI', 'url' => 'https://daisyui.com'],
    ],

    'collabs' => [
        ['name' => 'Brand / Org', 'role' => 'Ambassador', 'url' => '#'],
    ],

    'services' => [
        ['title' => 'Laravel Web Apps', 'desc' => 'Custom systems from idea to deploy.'],
        ['title' => 'UI / Front-end', 'desc' => 'Tailwind + Alpine interfaces.'],
        ['title' => 'Code Review', 'desc' => 'Audit and cleanup of existing projects.'],
    ],

    // Heroicons (outline) paths
    'icons' => [
        'shop'            => 'M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        'blog'            => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z',
        'gear'            => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
        'resources'       => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
        'collabs'         => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z',
        'consulting'      => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155',
        'projects'        => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z',
        'experience'      => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0',
        'stack'           => 'M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3',
        'certifications'  => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5',
        'recommendations' => 'M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z',
        'affiliations'    => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z',
        'ask'             => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.847a4.5 4.5 0 003.09 3.09L15.75 12l-2.847.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z',
        'typing'          => 'M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z',
        'system'          => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
        'light'           => 'M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364-6.364l-1.06 1.06M6.696 17.304l-1.06 1.06m12.728 0l-1.06-1.06M6.696 6.696l-1.06-1.06M16 12a4 4 0 11-8 0 4 4 0 018 0z',
        'dark'            => 'M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z',
    ],
];