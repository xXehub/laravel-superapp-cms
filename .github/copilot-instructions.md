# Copilot Instructions for Laravel 12 Project

<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

## Project Overview
This is a Laravel 12 project with a complete authentication system using Laravel UI Bootstrap and Spatie Laravel Permission for role-based access control with dynamic menu management.

## Key Features
- Laravel UI Bootstrap authentication scaffolding
- Spatie Laravel Permission for roles and permissions
- Dynamic menu system with role-based access
- Database tables: users, roles, permissions, master_menus, menu_roles
- Responsive Bootstrap UI with sidebar navigation
- Role-based menu rendering

## Architecture
- **Authentication**: Laravel UI with Bootstrap styling
- **Authorization**: Spatie Laravel Permission package
- **Menu System**: Dynamic menus based on user roles
- **Database**: SQLite (for development)
- **Frontend**: Bootstrap 5 with Font Awesome icons

## Important Files
- `app/Models/User.php` - User model with HasRoles trait
- `app/Models/MasterMenu.php` - Menu model with hierarchical structure
- `app/Models/MenuRole.php` - Junction table for menu-role relationships
- `app/Providers/MenuServiceProvider.php` - Menu composition for views
- `resources/views/layouts/app-with-sidebar.blade.php` - Main layout with sidebar
- `database/seeders/` - Contains role, permission, and menu seeders

## Development Guidelines
1. Always use `@can()`, `@role()`, and `@permission()` directives for access control
2. Use the `app-with-sidebar` layout for authenticated pages
3. Follow Bootstrap 5 conventions for styling
4. Menu access is controlled through the `menu_roles` table
5. All routes should be properly protected with middleware

## Database Schema
- `master_menus`: id, nama_menu, parent_id, route_name, icon, urutan
- `menu_roles`: id, role_id, menu_id
- Standard Spatie permission tables: roles, permissions, role_has_permissions, etc.

## Testing Accounts
- Admin: admin@example.com / password
- Editor: editor@example.com / password  
- Viewer: viewer@example.com / password
