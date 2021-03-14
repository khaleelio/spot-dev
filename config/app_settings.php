<?php

return [

    // All the sections for the settings page
    'sections' => [
        'general' => [
            'title' => ' General Settings',
            'descriptions' => 'Application general settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Application Name', // label for input
                    // optional properties
                    'placeholder' => 'Application Name', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    // 'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'site_motto', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Site Motto', // label for input
                    // optional properties
                    'placeholder' => 'Site Motto', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'Copyright on footer of site.', // help block text for input
                ],
                [
                    'name' => 'site_icon', // unique key for setting
                    'type' => 'image', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Site Icon', // label for input
                    // optional properties
                    'placeholder' => 'Choose logo...', // placeholder for input
                    'class' => 'custom-file-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'image|max:500', // validation rules for this input
                    'disk' => 'public', // which disk you want to upload, default to 'public'
                    'path' => '', // path on the disk, default to '/',
                    'preview_class' => 'thumbnail', // class for preview of uploaded image
                    'preview_style' => 'height:40px' // style for preview
                ],
                [
                    'name' => 'primary_font', // unique key for setting
                    'type' => 'select_font', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Primary font', // label for input
                    // optional properties
                    'placeholder' => 'Primary font', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => 'You can set the Primary font here', // help block text for input
                    'options' => [
                        'Aclonica' => 'Aclonica','Allan' => 'Allan','Annie Use Your Telescope' => 'Annie Use Your Telescope','Anonymous Pro' => 'Anonymous Pro','Allerta Stencil' => 'Allerta Stencil','Allerta' => 'Allerta','Amaranth' => 'Amaranth','Anton' => 'Anton','Archivo' => 'Archivo','Architects Daughter' => 'Architects Daughter','Arimo' => 'Arimo','Artifika' => 'Artifika','Arvo' => 'Arvo','Asset' => 'Asset','Astloch' => 'Astloch','Bangers' => 'Bangers','Bentham' => 'Bentham','Bevan' => 'Bevan','Bigshot One' => 'Bigshot One','Bowlby One' => 'Bowlby One','Bowlby One SC' => 'Bowlby One SC','Brawler' => 'Brawler','Buda:300' => 'Buda:300','Cabin' => 'Cabin','Calligraffitti' => 'Calligraffitti','Candal' => 'Candal','Cantarell' => 'Cantarell','Cardo' => 'Cardo','Carter One' => 'Carter One','Caudex' => 'Caudex','Cedarville Cursive' => 'Cedarville Cursive','Cherry Cream Soda' => 'Cherry Cream Soda','Chewy' => 'Chewy','Coda' => 'Coda','Coming Soon' => 'Coming Soon','Copse' => 'Copse','Corben:700' => 'Corben:700','Cousine' => 'Cousine','Covered By Your Grace' => 'Covered By Your Grace','Crafty Girls' => 'Crafty Girls','Crimson Text' => 'Crimson Text','Crushed' => 'Crushed','Cuprum' => 'Cuprum','Damion' => 'Damion','Dancing Script' => 'Dancing Script','Dawning of a New Day' => 'Dawning of a New Day','DM Sans' => 'DM Sans','Didact Gothic' => 'Didact Gothic','Droid Sans' => 'Droid Sans','Droid Sans Mono' => 'Droid Sans Mono','Droid Serif' => 'Droid Serif','EB Garamond' => 'EB Garamond','Expletus Sans' => 'Expletus Sans','Fontdiner Swanky' => 'Fontdiner Swanky','Forum' => 'Forum','Francois One' => 'Francois One','Geo' => 'Geo','Give You Glory' => 'Give You Glory','Goblin One' => 'Goblin One','Goudy Bookletter 1911' => 'Goudy Bookletter 1911','Gravitas One' => 'Gravitas One','Gruppo' => 'Gruppo','Hammersmith One' => 'Hammersmith One','Holtwood One SC' => 'Holtwood One SC','Homemade Apple' => 'Homemade Apple','Inconsolata' => 'Inconsolata','Indie Flower' => 'Indie Flower','IM Fell DW Pica' => 'IM Fell DW Pica','IM Fell DW Pica SC' => 'IM Fell DW Pica SC','IM Fell Double Pica' => 'IM Fell Double Pica','IM Fell Double Pica SC' => 'IM Fell Double Pica SC','IM Fell English' => 'IM Fell English','IM Fell English SC' => 'IM Fell English SC','IM Fell French Canon' => 'IM Fell French Canon','IM Fell French Canon SC' => 'IM Fell French Canon SC','IM Fell Great Primer' => 'IM Fell Great Primer','IM Fell Great Primer SC' => 'IM Fell Great Primer SC','Irish Grover' => 'Irish Grover','Irish Growler' => 'Irish Growler','Istok Web' => 'Istok Web','Josefin Sans' => 'Josefin Sans','Josefin Slab' => 'Josefin Slab','Judson' => 'Judson','Jura' => 'Jura','Jura:500' => 'Jura:500','Jura:600' => 'Jura:600','Just Another Hand' => 'Just Another Hand','Just Me Again Down Here' => 'Just Me Again Down Here','Kameron' => 'Kameron','Kenia' => 'Kenia','Kranky' => 'Kranky','Kreon' => 'Kreon','Kristi' => 'Kristi','La Belle Aurore' => 'La Belle Aurore','Lato:100' => 'Lato:100','Lato:100italic' => 'Lato:100italic','Lato:300' => 'Lato:300','Lato' => 'Lato','Lato:bold' => 'Lato:bold','Lato:900' => 'Lato:900','League Script' => 'League Script','Lekton' => 'Lekton','Limelight' => 'Limelight','Lobster' => 'Lobster','Lobster Two' => 'Lobster Two','Lora' => 'Lora','Love Ya Like A Sister' => 'Love Ya Like A Sister','Loved by the King' => 'Loved by the King','Luckiest Guy' => 'Luckiest Guy','Maiden Orange' => 'Maiden Orange','Mako' => 'Mako','Maven Pro' => 'Maven Pro','Maven Pro:500' => 'Maven Pro:500','Maven Pro:700' => 'Maven Pro:700','Maven Pro:900' => 'Maven Pro:900','Meddon' => 'Meddon','MedievalSharp' => 'MedievalSharp','Megrim' => 'Megrim','Merriweather' => 'Merriweather','Metrophobic' => 'Metrophobic','Michroma' => 'Michroma','Miltonian Tattoo' => 'Miltonian Tattoo','Miltonian' => 'Miltonian','Modern Antiqua' => 'Modern Antiqua','Monofett' => 'Monofett','Molengo' => 'Molengo','Montserrat' => 'Montserrat','Mountains of Christmas' => 'Mountains of Christmas','Muli:300' => 'Muli:300','Muli' => 'Muli','Neucha' => 'Neucha','Neuton' => 'Neuton','News Cycle' => 'News Cycle','Nixie One' => 'Nixie One','Nobile' => 'Nobile','Noto Sans' => 'Noto Sans','Nova Cut' => 'Nova Cut','Nova Flat' => 'Nova Flat','Nova Mono' => 'Nova Mono','Nova Oval' => 'Nova Oval','Nova Round' => 'Nova Round','Nova Script' => 'Nova Script','Nova Slim' => 'Nova Slim','Nova Square' => 'Nova Square','Nunito:light' => 'Nunito:light','Nunito' => 'Nunito','Nunito Sans' => 'Nunito Sans','OFL Sorts Mill Goudy TT' => 'OFL Sorts Mill Goudy TT','Old Standard TT' => 'Old Standard TT','Open Sans:300' => 'Open Sans:300','Open Sans' => 'Open Sans','Open Sans:600' => 'Open Sans:600','Open Sans:800' => 'Open Sans:800','Open Sans Condensed:300' => 'Open Sans Condensed:300','Orbitron' => 'Orbitron','Orbitron:500' => 'Orbitron:500','Orbitron:700' => 'Orbitron:700','Orbitron:900' => 'Orbitron:900','Oswald' => 'Oswald','Over the Rainbow' => 'Over the Rainbow','Reenie Beanie' => 'Reenie Beanie','Pacifico' => 'Pacifico','Patrick Hand' => 'Patrick Hand','Paytone One' => 'Paytone One','Permanent Marker' => 'Permanent Marker','Philosopher' => 'Philosopher','Play' => 'Play','Playfair Display' => 'Playfair Display','Podkova' => 'Podkova','Poppins' => 'Poppins','PT Sans' => 'PT Sans','PT Sans Narrow' => 'PT Sans Narrow','PT Sans Narrow:regular,bold' => 'PT Sans Narrow:regular,bold','PT Serif' => 'PT Serif','PT Serif Caption' => 'PT Serif Caption','Puritan' => 'Puritan','Quattrocento' => 'Quattrocento','Quattrocento Sans' => 'Quattrocento Sans','Radley' => 'Radley','Raleway' => 'Raleway','Raleway:100' => 'Raleway:100','Redressed' => 'Redressed','Rock Salt' => 'Rock Salt','Rokkitt' => 'Rokkitt','Roboto' => 'Roboto','Roboto Condensed' => 'Roboto Condensed','Roboto Slab' => 'Roboto Slab','Ruslan Display' => 'Ruslan Display','Schoolbell' => 'Schoolbell','Shadows Into Light' => 'Shadows Into Light','Shanti' => 'Shanti','Sigmar One' => 'Sigmar One','Six Caps' => 'Six Caps','Slackey' => 'Slackey','Smythe' => 'Smythe','Sniglet:800' => 'Sniglet:800','Special Elite' => 'Special Elite','Stardos Stencil' => 'Stardos Stencil','Sue Ellen Francisco' => 'Sue Ellen Francisco','Sunshiney' => 'Sunshiney','Swanky and Moo Moo' => 'Swanky and Moo Moo','Syncopate' => 'Syncopate','Tajawal' => 'Tajawal','Tangerine' => 'Tangerine','Tenor Sans' => 'Tenor Sans','Terminal Dosis Light' => 'Terminal Dosis Light','The Girl Next Door' => 'The Girl Next Door','Tinos' => 'Tinos','Ubuntu' => 'Ubuntu','Ultra' => 'Ultra','Unkempt' => 'Unkempt','UnifrakturCook:bold' => 'UnifrakturCook:bold','UnifrakturMaguntia' => 'UnifrakturMaguntia','Varela' => 'Varela','Varela Round' => 'Varela Round','Vibur' => 'Vibur','Vollkorn' => 'Vollkorn','VT323' => 'VT323','Waiting for the Sunrise' => 'Waiting for the Sunrise','Wallpoet' => 'Wallpoet','Walter Turncoat' => 'Walter Turncoat','Wire One' => 'Wire One','Work Sans' => 'Work Sans','Yanone Kaffeesatz' => 'Yanone Kaffeesatz','Yanone Kaffeesatz:300' => 'Yanone Kaffeesatz:300','Yanone Kaffeesatz:400' => 'Yanone Kaffeesatz:400','Yanone Kaffeesatz:700' => 'Yanone Kaffeesatz:700','Yeseva One' => 'Yeseva One','Zeyada' => 'Zeyada',
                        
                    ]
                ],
                [
                    'name' => 'base_color', // unique key for setting
                    'id' => 'cp2', // unique key for setting
                    'type' => 'color', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Website Base Color', // label for input
                    // optional properties
                    'placeholder' => 'Website Base Color', // placeholder for input
                    'class' => 'form-control color-picker-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '#FFFFFF', // any default value
                    'hint' => 'Hex Color Code' // help block text for input
                ],
                [
                    'name' => 'base_hover_color', // unique key for setting
                    'id' => 'cp4', // unique key for setting
                    'type' => 'color', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Website Base Hover Color', // label for input
                    // optional properties
                    'placeholder' => 'Website Base Hover Color', // placeholder for input
                    'class' => 'form-control color-picker-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '#FFFFFF', // any default value
                    'hint' => 'Hex Color Code' // help block text for input
                ],
            ]
        ],
        'global_seo' => [
            'title' => ' Global Seo',
            'descriptions' => 'Global Seo.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'meta_title', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta Title', // label for input
                    // optional properties
                    'placeholder' => 'Meta Title', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    // 'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'meta_description', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta description', // label for input
                    // optional properties
                    'placeholder' => 'Meta description', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'Copyright on footer of site.', // help block text for input
                    'rows' => 6,
                ],
                [
                    'name' => 'meta_keywords', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta Keywords', // label for input
                    // optional properties
                    'placeholder' => 'Keyword,Keyword', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => 'Separate with coma', // help block text for input
                    'rows' => 6,
                ],
                [
                    'name' => 'meta_image', // unique key for setting
                    'type' => 'image', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta Image', // label for input
                    // optional properties
                    'placeholder' => 'Choose Meta Image...', // placeholder for input
                    'class' => 'custom-file-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'image|max:500', // validation rules for this input
                    'disk' => 'public', // which disk you want to upload, default to 'public'
                    'path' => '', // path on the disk, default to '/',
                    'preview_class' => 'thumbnail', // class for preview of uploaded image
                    'preview_style' => 'height:40px' // style for preview
                ],
            ]
        ],
        'social_links' => [
            'title' => ' Social Links',
            'descriptions' => '',
            'icon' => 'fas fa-bezier-curve',

            'inputs' => [
                // [
                //     'name' => 'social_links_name', // unique key for setting
                //     'url' => 'social_links_url', // unique key for setting
                //     'icon' => 'social_links_icon', // unique key for setting
                //     'type' => 'social_links', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                //     'label' => 'Social Links', // label for input
                //     // optional properties
                //     'placeholder' => 'Social Links', // placeholder for input
                //     'class' => 'form-control social-links', // override global input_class
                //     'style' => '', // any inline styles
                //     'rules' => '', // validation rules for this input
                //     'value' => '', // any default value
                //     // 'hint' => 'You can set the app name here' // help block text for input
                //     'options' => [
                //         'fab fa-facebook-square' => ' &#xf082; Facebook',
                //         'fab fa-twitter-square' => ' &#xf081; Twitter',
                //         'fab fa-linkedin' => ' &#xf08c; Linkedin',
                //         'fab fa-instagram-square' => ' &#xf16d; Instagram',
                //     ]
                // ],
                [
                    'name' => 'social_links', // unique key for setting
                    'type' => 'social_links', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Social Links', // label for input
                    'options' => [
                        'fab fa-facebook-square' => ' &#xf082; Facebook',
                        'fab fa-twitter-square' => ' &#xf081; Twitter',
                        'fab fa-linkedin' => ' &#xf08c; Linkedin',
                        'fab fa-instagram-square' => ' &#xf16d; Instagram',
                    ]
                ],
                [
                    'name' => 'social_links_name', // unique key for setting
                    'type' => 'array', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'data_type' => 'array',
                    'value' => '', // any default value
                ],
                [
                    'name' => 'social_links_icon', // unique key for setting
                    'label' => 'Social Links', // label for input
                    'type' => 'array', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'data_type' => 'array',
                    'value' => '', // any default value
                ],
            ]
        ],
        'cookies' => [
            'title' => ' Cookies Agreement',
            'descriptions' => 'Cookies Agreement.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'cookies_agreement_text', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Cookies Agreement Text', // label for input
                    // optional properties
                    'placeholder' => 'Cookies Agreement Text', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'Copyright on footer of site.', // help block text for input
                    'rows' => 6,
                ],
                [
                    'name' => 'show_cookies_agreement',
                    'type' => 'checkbox',
                    'label' => 'Show Cookies Agreement? : ',
                    'value' => '0',
                    'class' => 'w-auto form-control aiz-selectpicker',
                    
                ],
            ]
        ],
        'header' => [
            'title' => ' Header',
            'descriptions' => '',
            'icon' => 'fas fa-bezier-curve',

            'inputs' => [
                [
                    'name' => 'header_logo', // unique key for setting
                    'type' => 'image', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Header Logo', // label for input
                    // optional properties
                    'placeholder' => 'Choose logo...', // placeholder for input
                    'class' => 'custom-file-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'image|max:500', // validation rules for this input
                    'disk' => 'public', // which disk you want to upload, default to 'public'
                    'path' => '', // path on the disk, default to '/',
                    'preview_class' => 'thumbnail', // class for preview of uploaded image
                    'preview_style' => 'height:40px' // style for preview
                ],
                [
                    'name' => 'header_language',
                    'type' => 'checkbox',
                    'label' => 'Show Language Switcher : ',
                    'value' => '0',
                    'class' => 'w-auto form-control aiz-selectpicker',
                    
                ],
                [
                    'name' => 'header_currency',
                    'type' => 'checkbox',
                    'label' => 'Show Currency Switcher : ',
                    'value' => '0',
                    'class' => 'w-auto form-control aiz-selectpicker',
                    
                ],
                [
                    'name' => 'header_stikcy',
                    'type' => 'checkbox',
                    'label' => 'Stikcy header Switcher : ',
                    'value' => '0',
                    'class' => 'w-auto form-control aiz-selectpicker',
                    
                ],
            ]
        ],
        'footer' => [
            'title' => ' Footer',
            'descriptions' => '',
            'icon' => 'fas fa-bezier-curve',

            'inputs' => [
                [
                    'name' => 'footer_logo', // unique key for setting
                    'type' => 'image', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Footer Logo', // label for input
                    // optional properties
                    'placeholder' => 'Choose logo...', // placeholder for input
                    'class' => 'custom-file-input', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'image|max:500', // validation rules for this input
                    'disk' => 'public', // which disk you want to upload, default to 'public'
                    'path' => '', // path on the disk, default to '/',
                    'preview_class' => 'thumbnail', // class for preview of uploaded image
                    'preview_style' => 'height:40px' // style for preview
                ],
                [
                    'name' => 'footer_about_description', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'About description', // label for input
                    // optional properties
                    'placeholder' => 'About description', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'Copyright on footer of site.', // help block text for input
                    'rows' => 6,
                ],
                [
                    'name' => 'footer_contact_address', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Contact address', // label for input
                    // optional properties
                    'placeholder' => 'Contact address', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'footer_contact_phone', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Contact phone', // label for input
                    // optional properties
                    'placeholder' => 'Contact phone', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'footer_contact_email', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Contact email', // label for input
                    // optional properties
                    'placeholder' => 'Contact email', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'nullable|email', // validation rules for this input
                    'value' => '', // any default value
                    // 'hint' => 'You can set the app name here' // help block text for input
                ],
                [
                    'name' => 'footer_copy_right', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Copy right', // label for input
                    // optional properties
                    'placeholder' => 'Copy right', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => '', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => 'Copyright on footer of site.', // help block text for input
                    'rows' => 6,
                ],
            ]
        ],
    ],

    // Setting page url, will be used for get and post request
    'url' => 'admin/website/theme/option',

    // Any middleware you want to run on above route
    'middleware' => [],

    // View settings
    'setting_page_view' => 'backend.theme_option.index',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function() {
        // return 'user_'.auth()->id();
        return 'default';
    }
];
