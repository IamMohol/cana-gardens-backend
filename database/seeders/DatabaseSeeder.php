<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\BlogPost;
use App\Models\FeatureHighlight;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User (Direct creation without dev-dependency Faker)
        User::firstOrCreate(
            ['email' => 'admin@canagardens.co.ke'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('CanaAdmin2026!'),
                'email_verified_at' => now(),
            ]
        );

        // SiteSetting
        SiteSetting::create([
            'site_name' => 'Cana Gardens',
            'tagline' => 'The stunning countryside wedding venue you thought you would never find.',
            'phone_primary' => '+254 706 948 574',
            'phone_secondary' => '+254 722 527 927',
            'email' => 'info@canagardens.co.ke',
            'address' => 'Off Kiambu Road, Nairobi, Kenya',
            'opening_hours' => 'Monday - Sunday: 8:00am - 7:00pm',
            'consultation_hours' => 'Grounds open for viewing 7:00am - 6:00pm',
            'facebook_url' => 'https://www.facebook.com/Paradise-Gardens-704387486244600/',
            'instagram_url' => 'https://www.instagram.com/canagardens_ke/?hl=en',
            'whatsapp_number' => '254706948574',
            'video_url' => 'https://canagardens.co.ke/wp-content/uploads/2022/01/Paradise-Garden.mp4',
            'video_poster' => 'https://canagardens.co.ke/wp-content/uploads/2022/01/Paradise-Gardens-scaled.jpg',
        ]);

        // Services
        $servicesData = [
            [
                'title' => 'Weddings & Receptions',
                'slug' => Str::slug('Weddings & Receptions'),
                'icon_name' => 'ring',
                'short_description' => 'A romantic lakeside setting for your perfect day. With 1-acre of manicured lawns.',
                'detailed_description' => 'Our grounds easily accommodate 1000+ guests with a lakeside view.',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-weddings-events-scaled-pjlia5mw353fr3ks278c0zxa7ce40gqk5pbnwpvzew.jpg',
                'featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Corporate Events',
                'slug' => Str::slug('Corporate Events'),
                'icon_name' => 'users',
                'short_description' => 'Professional environment for team buildings and end-of-year parties.',
                'detailed_description' => 'Host your company with our spacious grounds.',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-corporate-events-scaled-pjli9mu4agdpawc33z3sn4o2bmyrqinxf49yb6nuvc.jpg',
                'featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Picnics & Parties',
                'slug' => Str::slug('Picnics & Parties'),
                'icon_name' => 'tree',
                'short_description' => 'Open spaces for relaxing family picnics, birthdays, and baby showers.',
                'detailed_description' => 'Relax under the trees with a basket.',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-picnic-events1-pjli9zzuy4vptfsyz4skm1cin15wqa464xer124cg8.jpeg',
                'featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Photography & Shoots',
                'slug' => Str::slug('Photography & Shoots'),
                'icon_name' => 'camera',
                'short_description' => 'Scenic backdrops for commercial, bridal, or personal photoshoots.',
                'detailed_description' => 'Capture memories with our serene landscapes.',
                'cover_image' => '/img/photo_shoots.png',
                'featured' => false,
                'order' => 4,
            ],
        ];

        foreach ($servicesData as $service) {
            Service::create($service);
        }

        // Feature Highlights
        $featuresData = [
            [
                'title' => 'Convenient Location',
                'description' => 'Esteemed as one of the leading wedding venues in Kenya, there is no doubt that our most distinctive feature is our gardens. Set across 1 acre, enjoy a strong country feel while only 10KM from the City Center.',
                'icon_name' => 'city',
                'column_side' => 'left',
                'order' => 1,
            ],
            [
                'title' => 'Ample Parking',
                'description' => 'No need to worry about where your guests should park their vehicles. The grounds parking area can easily and securely accommodate 400 cars.',
                'icon_name' => 'car',
                'column_side' => 'left',
                'order' => 2,
            ],
            [
                'title' => 'Best of Both Worlds',
                'description' => 'Cana Gardens has two well-manicured lawns making it convenient for couples to easily host both the church ceremony and reception party all in one breathtaking venue.',
                'icon_name' => 'layers',
                'column_side' => 'right',
                'order' => 1,
            ],
            [
                'title' => 'Free Consultations',
                'description' => 'The grounds are open for viewing anytime from 7:00 AM to 6:00 PM every day. Karibu Cana Gardens to explore your dream event venue!',
                'icon_name' => 'calendar-check',
                'column_side' => 'right',
                'order' => 2,
            ],
        ];

        foreach ($featuresData as $feature) {
            FeatureHighlight::create($feature);
        }

        // Activities
        $activitiesData = [
            ['title' => 'Photoshoots', 'slug' => 'photo-shoots', 'image_url' => '/img/photo_shoots.png', 'order' => 1],
            ['title' => 'Birthday Celebrations', 'slug' => 'birthday-celebrations', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-gardens-birthday--pjhxk76lwcwmjqrb10wjphof2q8kidw03lum6uctjc.jpeg', 'order' => 2],
            ['title' => 'Picnic & Family Days', 'slug' => 'picnic-family-days', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-picnic-events1-pjli9zztlw89jvwkw0dzo61bx6tqltr6iseohrrvd4.jpeg', 'order' => 3],
            ['title' => 'Events & Showers', 'slug' => 'events-showers', 'image_url' => '/img/events_showers.png', 'order' => 4],
        ];

        foreach ($activitiesData as $activity) {
            Activity::create([
                'title' => $activity['title'],
                'slug' => $activity['slug'],
                'image_url' => $activity['image_url'],
                'order' => $activity['order'],
                'is_active' => true,
            ]);
        }

        // Blog Posts
        $postsData = [
            [
                'title' => 'Mother’s Day Celebration at Cana Gardens Nairobi',
                'slug' => 'mothers-day-celebration-at-paradise-gardens-nairobi',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/2026/05/WhatsApp-Image-2026-05-10-at-10.31.32-AM-768x1087.jpeg',
                'excerpt' => 'Mother’s Day is a time to slow down and appreciate the women who give so much to our families and communities. Celebrate in serene garden luxury.',
                'content' => 'Mother’s Day Celebration at Cana Gardens is designed to create unforgettable moments. Set against lush green landscapes, refreshing countryside breezes, and elegant garden seating, we offer tailor-made dining and picnic packages to honor mothers and matriarchs in an atmosphere of refined peace.',
                'category' => 'Events',
                'author' => 'Cana Gardens',
                'published_at' => Carbon::create(2026, 5, 10),
                'read_time' => '2 min read',
                'is_published' => true,
            ],
            [
                'title' => 'Party Events at Cana Gardens',
                'slug' => 'party-events-at-paradise-gardens',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/2026/04/53e2d78e-1e7f-40ed-bab8-115dbf735a53-1-768x576.jpg',
                'excerpt' => 'Planning a party in Nairobi starts with one key decision: the venue. Discover why open manicured lawns elevate every milestone celebration.',
                'content' => 'From milestone anniversaries and lavish birthdays to graduation celebrations, hosting your party at Cana Gardens provides unmatched freedom. With ample 400-car secure parking, versatile catering zones, and sunset views, your guests will talk about the experience for years.',
                'category' => 'Music & Parties',
                'author' => 'Cana Gardens',
                'published_at' => Carbon::create(2026, 4, 9),
                'read_time' => '3 min read',
                'is_published' => true,
            ],
            [
                'title' => 'Old School & Vibe Brunch: A Successful Easter Event at Cana Gardens',
                'slug' => 'old-school-vibe-brunch-nairobi-a-successful-easter-event-at-paradise-gardens',
                'cover_image' => 'https://canagardens.co.ke/wp-content/uploads/2026/04/867d0ffc-6028-4dde-816f-07b0aed8ff14-768x895.jpg',
                'excerpt' => 'A review of the Old School & Vibe Brunch Event. Easter brought great energy to Nairobi, and Cana Gardens was the destination of choice.',
                'content' => 'Our Easter Sunday Old School & Vibe Brunch welcomed hundreds of music lovers, families, and brunch enthusiasts. Guests enjoyed live DJ sets, handcrafted barbecues, cocktail lounges, and serene lakeside chillout zones across our manicured lawns.',
                'category' => 'Corporate & Music',
                'author' => 'Cana Gardens',
                'published_at' => Carbon::create(2026, 4, 8),
                'read_time' => '4 min read',
                'is_published' => true,
            ],
        ];

        foreach ($postsData as $post) {
            BlogPost::create($post);
        }

        // Gallery Items
        $galleryData = [
            ['title' => 'Cana Gardens Panorama View', 'category' => 'gardens', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/2022/01/Paradise-Gardens-view.jpeg', 'is_featured' => true, 'order' => 1],
            ['title' => 'Wedding Arch & Setup', 'category' => 'weddings', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-weddings-events-scaled-pjlia5mw353fr3ks278c0zxa7ce40gqk5pbnwpvzew.jpg', 'is_featured' => true, 'order' => 2],
            ['title' => 'Lakeside Corporate Pavilion', 'category' => 'corporate', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-corporate-events-scaled-pjli9mu4agdpawc33z3sn4o2bmyrqinxf49yb6nuvc.jpg', 'is_featured' => true, 'order' => 3],
            ['title' => 'Bridal Photoshoot on Lawn', 'category' => 'photoshoot', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-Photo-shoot-events-pjliln7vm8tlniw0z606i3k3kvrm3acgekdb2gurd4.jpg', 'is_featured' => true, 'order' => 4],
            ['title' => 'Family Lawn Picnic', 'category' => 'picnics', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-picnic-events1-pjli9zzuy4vptfsyz4skm1cin15wqa464xer124cg8.jpeg', 'is_featured' => true, 'order' => 5],
            ['title' => 'Lush Gardens for Photoshoots', 'category' => 'gardens', 'image_url' => '/img/photo_shoots.png', 'is_featured' => false, 'order' => 6],
            ['title' => 'Sunset Reception Ambiance', 'category' => 'weddings', 'image_url' => 'https://canagardens.co.ke/wp-content/uploads/elementor/thumbs/Paradise-Gardens-weddings-events1-scaled-pjliaf19zhgaz774jbalpxjw573s5frvizuiphi1oo.jpeg', 'is_featured' => false, 'order' => 7],
            ['title' => 'Waterfront Event Deck', 'category' => 'gardens', 'image_url' => '/img/events_showers.png', 'is_featured' => false, 'order' => 8],
        ];

        foreach ($galleryData as $item) {
            GalleryItem::create([
                'title' => $item['title'],
                'category' => $item['category'],
                'image_url' => $item['image_url'],
                'caption' => "{$item['title']} at Cana Gardens Nairobi",
                'is_featured' => $item['is_featured'],
                'order' => $item['order'],
            ]);
        }
    }
}
