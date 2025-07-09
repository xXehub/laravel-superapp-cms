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
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => "Welcome to our Laravel Superapp CMS!\n\nThis is a powerful content management system built with Laravel 12, featuring:\n\n• Role-based access control using Spatie Laravel Permission\n• Dynamic menu system based on user roles\n• Clean, modular architecture\n• Responsive Bootstrap UI\n• Dynamic page routing\n\nOur system is designed to be flexible and scalable, perfect for modern web applications that need robust user management and content organization.",
            'meta_title' => 'About Our Laravel CMS - Learn More',
            'meta_description' => 'Learn about our powerful Laravel CMS with role-based permissions, dynamic menus, and clean architecture.',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Features',
            'slug' => 'features',
            'content' => "Our Laravel Superapp CMS comes packed with powerful features:\n\n🔐 AUTHENTICATION & AUTHORIZATION\n• Laravel UI Bootstrap authentication\n• Spatie Laravel Permission integration\n• Role-based access control\n• Permission-based route protection\n\n📋 MENU MANAGEMENT\n• Dynamic hierarchical menus\n• Role-based menu visibility\n• Clean relationship queries\n• No manual conditionals\n\n📄 DYNAMIC PAGES\n• Slug-based routing\n• Custom page templates\n• SEO-friendly URLs\n• Content management\n\n🎨 CLEAN CODE\n• Minimal conditionals\n• Blade components\n• Policies and gates\n• Modern Laravel practices",
            'meta_title' => 'CMS Features - What Makes Us Special',
            'meta_description' => 'Discover the powerful features of our Laravel CMS including role-based permissions, dynamic menus, and clean architecture.',
            'is_published' => true,
            'sort_order' => 2,
        ]);

        Page::create([
            'title' => 'Getting Started',
            'slug' => 'getting-started',
            'content' => "Ready to get started with our Laravel Superapp CMS? Here's how:\n\n1. LOGIN WITH TEST ACCOUNTS\n• Admin: admin@example.com / password\n• Editor: editor@example.com / password\n• Viewer: viewer@example.com / password\n\n2. EXPLORE THE DASHBOARD\n• View your role and permissions\n• Navigate through available menus\n• Test different access levels\n\n3. MANAGE CONTENT\n• Create and edit pages\n• Manage users (admin only)\n• Configure settings\n\n4. UNDERSTAND THE ARCHITECTURE\n• Check the menu system\n• Review role permissions\n• Explore the codebase\n\nThe system is built with clean code principles and follows Laravel best practices for maintainable, scalable applications.",
            'meta_title' => 'Getting Started Guide - Laravel CMS',
            'meta_description' => 'Step-by-step guide to get started with our Laravel CMS. Learn about user roles, permissions, and features.',
            'is_published' => true,
            'sort_order' => 3,
        ]);

        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => "PRIVACY POLICY\n\nThis is a sample privacy policy for demonstration purposes.\n\nData Collection\nWe collect information you provide directly to us, such as when you create an account, update your profile, or contact us.\n\nData Usage\nWe use the information we collect to provide, maintain, and improve our services.\n\nData Protection\nWe implement appropriate security measures to protect your personal information.\n\nContact Us\nIf you have any questions about this privacy policy, please contact us.\n\nLast updated: " . now()->format('F d, Y'),
            'meta_title' => 'Privacy Policy - Your Data Protection',
            'meta_description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
            'is_published' => true,
            'sort_order' => 10,
        ]);

        // Create a draft page
        Page::create([
            'title' => 'Coming Soon',
            'slug' => 'coming-soon',
            'content' => "This page is under construction and will be available soon.\n\nStay tuned for exciting updates!",
            'meta_title' => 'Coming Soon - Exciting Updates Ahead',
            'meta_description' => 'Exciting new features and content coming soon to our Laravel CMS.',
            'is_published' => false,
            'sort_order' => 99,
        ]);
    }
}
