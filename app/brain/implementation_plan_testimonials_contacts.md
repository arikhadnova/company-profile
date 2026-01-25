# Implementation Plan - Testimonial & Contact Management

This plan outlines the steps to implement management systems for testimonials and inbound contact messages, making them dynamic and manageable via the admin panel.

## Proposed Changes

### Database
- **[NEW] Table: `testimonials`**
    - `id` (INT, AI, PK)
    - `name` (VARCHAR)
    - `role_id` (VARCHAR) - for role in Indonesian
    - `role_en` (VARCHAR) - for role in English
    - `content_id` (TEXT) - for testimonial in Indonesian
    - `content_en` (TEXT) - for testimonial in English
    - `image` (VARCHAR, NULL) - for profile photo
    - `status` (ENUM: 'active', 'inactive')
    - `created_at` (TIMESTAMP)
- **[NEW] Table: `contacts`**
    - `id` (INT, AI, PK)
    - `name` (VARCHAR)
    - `email` (VARCHAR)
    - `message` (TEXT)
    - `is_read` (TINYINT, default 0)
    - `created_at` (TIMESTAMP)

### Models
- **[NEW] `Testimonial_model.php`**: CRUD methods for testimonials.
- **[NEW] `Contact_model.php`**: Methods for saving and retrieving contact messages.

### Admin Controller
#### [MODIFY] [admin.php](file:///c:/laragon/www/gosirk_website/app/controllers/admin.php)
- Add methods for Testimonial CRUD: `testimonials()`, `testimonials_create()`, `testimonials_store()`, `testimonials_edit()`, `testimonials_update()`, `testimonials_delete()`.
- Add methods for Contact Management: `contacts()`, `contacts_view()`, `contacts_delete()`.

### Contact Controller
#### [MODIFY] [contact.php](file:///c:/laragon/www/gosirk_website/app/controllers/contact.php)
- Add a `store()` method to handle contact form submissions via AJAX.

### Views
- **Admin**:
    - [NEW] `admin/testimonials.php` (List)
    - [NEW] `admin/testimonials_create.php` (Form)
    - [NEW] `admin/testimonials_edit.php` (Form)
    - [NEW] `admin/contacts.php` (List/Inbox)
- **Layouts**:
    - [MODIFY] `admin_header.php`: Add sidebar links for Testimonials and Contacts.
- **Public**:
    - [MODIFY] `contact/index.php`: Functionalize form with AJAX.

## Verification Plan

### Manual Verification
- **Testimonials**: 
    - Add a new testimonial in admin.
    - Verify it appears on the home page.
    - Edit and delete it to ensure full CRUD functionality.
- **Contacts**:
    - Submit the contact form on the public page.
    - Verify the message appears in the admin "Inbox".
    - Mark as read and delete to verify management.
