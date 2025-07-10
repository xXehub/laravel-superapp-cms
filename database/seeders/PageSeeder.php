<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(['slug' => 'about-us'], [
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => "Welcome to our Laravel Superapp CMS!\n\nThis is a powerful content management system built with Laravel 12, featuring:\n\n• Role-based access control using Spatie Laravel Permission\n• Dynamic menu system based on user roles\n• Clean, modular architecture\n• Responsive Bootstrap UI\n• Dynamic page routing\n\nOur system is designed to be flexible and scalable, perfect for modern web applications that need robust user management and content organization.",
            'meta_title' => 'About Our Laravel CMS - Learn More',
            'meta_description' => 'Learn about our powerful Laravel CMS with role-based permissions, dynamic menus, and clean architecture.',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        Page::updateOrCreate(['slug' => 'contact'], [
            'title' => 'Contact Us',
            'slug' => 'contact',
            'content' => "Get in touch with us! We would love to hear from you.\n\nContact Information:\n📧 Email: info@company.com\n📞 Phone: +1 (555) 123-4567\n📍 Address: 123 Business Street, Suite 100, City, State 12345\n\nBusiness Hours:\nMonday - Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM\nSunday: Closed\n\nFor technical support, please email: support@company.com\nFor general inquiries, please email: info@company.com\n\nWe aim to respond to all inquiries within 24 hours.",
            'meta_title' => 'Contact Us - Get in Touch',
            'meta_description' => 'Contact us for any inquiries. Find our email, phone, and address information.',
            'is_published' => true,
            'sort_order' => 2,
        ]);

        Page::updateOrCreate(['slug' => 'services'], [
            'title' => 'Our Services',
            'slug' => 'services',
            'content' => "We offer a comprehensive range of services to meet your business needs.\n\nOur Core Services:\n\n1. Web Development\n   - Custom website development\n   - E-commerce solutions\n   - Content management systems\n   - Responsive design\n\n2. Digital Marketing\n   - Search engine optimization (SEO)\n   - Social media marketing\n   - Pay-per-click advertising\n   - Content marketing\n\n3. Consulting Services\n   - Business strategy consulting\n   - Technology consulting\n   - Digital transformation\n   - Process optimization\n\n4. Support & Maintenance\n   - 24/7 technical support\n   - Regular updates and maintenance\n   - Security monitoring\n   - Performance optimization\n\nContact us to learn more about how we can help your business grow!",
            'meta_title' => 'Our Professional Services',
            'meta_description' => 'Discover our comprehensive range of web development, digital marketing, and consulting services.',
            'is_published' => true,
            'sort_order' => 3,
        ]);

        Page::updateOrCreate(['slug' => 'news'], [
            'title' => 'Latest News',
            'slug' => 'news',
            'content' => "Stay updated with our latest news and announcements.\n\nRecent Updates:\n\n📅 December 2024 - New Website Launch\nWe are excited to announce the launch of our newly redesigned website! The new site features improved navigation, mobile responsiveness, and enhanced user experience.\n\n📅 November 2024 - Service Expansion\nWe have expanded our service offerings to include advanced analytics and business intelligence solutions.\n\n📅 October 2024 - Team Growth\nWelcome to our new team members! We have added talented developers and consultants to better serve our growing client base.\n\n📅 September 2024 - Partnership Announcement\nWe are proud to announce our strategic partnership with leading technology providers to deliver enhanced solutions.\n\n📅 August 2024 - Awards Recognition\nOur company has been recognized for excellence in customer service and innovation in the industry.\n\nStay tuned for more exciting updates!",
            'meta_title' => 'Latest News and Updates',
            'meta_description' => 'Stay informed with our latest company news, updates, and announcements.',
            'is_published' => true,
            'sort_order' => 4,
        ]);

        Page::updateOrCreate(['slug' => 'privacy-policy'], [
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => "PRIVACY POLICY\n\nThis is a sample privacy policy for demonstration purposes.\n\nData Collection\nWe collect information you provide directly to us, such as when you create an account, update your profile, or contact us.\n\nData Usage\nWe use the information we collect to provide, maintain, and improve our services.\n\nData Protection\nWe implement appropriate security measures to protect your personal information.\n\nContact Us\nIf you have any questions about this privacy policy, please contact us.\n\nLast updated: " . now()->format('F d, Y'),
            'meta_title' => 'Privacy Policy - Your Data Protection',
            'meta_description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
            'is_published' => true,
            'sort_order' => 10,
        ]);
    }
}
