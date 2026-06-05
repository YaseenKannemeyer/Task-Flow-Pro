# TaskFlow Pro — Laravel Task Management Application

## Group Members & Naming Convention

> All Controllers, Models, Policies, and Middleware are suffixed with group initials **AMY**.
> Example: `TaskControllerAMY`, `TaskAMY`, `TaskPolicyAMY`, `RoleMiddlewareAMY`

---

## Technologies & Frameworks

| Layer | Technology | Version |
|---|---|---|
| Backend Framework | Laravel | 13.9.0 |
| Language | PHP | 8.5.4 |
| Authentication | Laravel Breeze | Latest |
| Database | MySQL | 8.x |
| Template Engine | Laravel Blade | Built-in |
| Queue Driver | Database | Built-in |
| Mail | SMTP / Mailpit (dev) | Built-in |
| ORM | Laravel Eloquent | Built-in |
| Package Manager | Composer | 2.9.5 |

---

## HTML/CSS Template Source

> **Disclosure (required by project specification)**

The application's layout, sidebar, navbar, card, and form UI components are adapted from:

- **AdminLTE 3** — https://adminlte.io
  - License: MIT
  - Used as structural and visual reference for the sidebar navigation, stat cards, and dashboard layout.
  - All templates have been fully **converted to Laravel Blade syntax** using `@extends`, `@section`, `@yield`, `@component`, `@can`, `@auth`, `@foreach`, `@error`, and Blade component tags (`<x-task-card />`, `<x-alert />`, etc.).
  - No AdminLTE JavaScript or CSS files are directly included — Tailwind CSS utility classes replace all custom CSS.

- **Tailwind CSS** — https://tailwindcss.com
  - License: MIT
  - All styling uses Tailwind utility classes. Zero inline CSS (except dynamic hex color values from the database for category color indicators).

---

## Project Structure

```
taskflowpro/
├── app/
│   ├── Console/Commands/
│   │   └── SendDeadlineRemindersAMY.php   # Scheduled artisan command
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── TaskControllerAMY.php       # Task CRUD + status/assign/archive
│   │   │   ├── CategoryControllerAMY.php   # Category CRUD
│   │   │   ├── AdminControllerAMY.php      # Admin panel, users, reports
│   │   │   ├── DashboardControllerAMY.php  # Dashboard stats
│   │   │   └── ProfileControllerAMY.php    # User profile
│   │   ├── Middleware/
│   │   │   ├── RoleMiddlewareAMY.php       # Role-based route protection
│   │   │   └── ActivityLogMiddlewareAMY.php # Request audit logging
│   │   └── Requests/
│   │       ├── StoreTaskRequestAMY.php     # Task creation validation
│   │       ├── UpdateTaskRequestAMY.php    # Task update validation
│   │       └── StoreCategoryRequestAMY.php # Category validation
│   ├── Mail/
│   │   └── DeadlineReminderMailAMY.php     # Deadline email mailable
│   ├── Models/
│   │   ├── User.php                        # Extended Breeze user model
│   │   ├── RoleAMY.php                     # Role model (admin/team_member/guest)
│   │   ├── TaskAMY.php                     # Task model with scopes & mutators
│   │   ├── CategoryAMY.php                 # Category model
│   │   └── TaskCommentAMY.php              # Task comments model
│   ├── Notifications/
│   │   └── TaskAssignedNotificationAMY.php # In-app + email notification
│   ├── Observers/
│   │   └── TaskObserverAMY.php             # Audit log observer
│   ├── Policies/
│   │   ├── TaskPolicyAMY.php               # Task authorization policy
│   │   └── CategoryPolicyAMY.php          # Category authorization policy
│   ├── Providers/
│   │   ├── AppServiceProvider.php          # Register observers
│   │   └── AuthServiceProviderAMY.php      # Register policies + gates
│   └── Services/
│       └── TaskServiceAMY.php              # Task business logic
├── database/
│   ├── factories/
│   │   └── TaskFactoryAMY.php
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_05_18_000001_create_roles_table.php
│   │   ├── 2026_05_18_000002_add_role_columns_to_users_table.php
│   │   ├── 2026_05_18_000003_create_categories_table.php
│   │   ├── 2026_05_18_000004_create_tasks_table.php
│   │   ├── 2026_05_18_000005_create_task_comments_table.php
│   │   └── 2026_05_18_000006_create_activity_logs_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleSeederAMY.php
│       ├── UserSeederAMY.php
│       ├── CategorySeederAMY.php
│       └── TaskSeederAMY.php
├── resources/views/
│   ├── layouts/app.blade.php               # Main layout
│   ├── components/
│   │   ├── task-card.blade.php             # Reusable task card
│   │   ├── status-badge.blade.php
│   │   ├── priority-badge.blade.php
│   │   └── alert.blade.php
│   ├── tasks/                              # Task views
│   ├── categories/                         # Category views
│   ├── admin/                              # Admin panel views
│   └── welcome.blade.php                   # Public landing page
├── routes/
│   ├── web.php                             # All web routes
│   └── auth.php                            # Breeze auth routes
└── bootstrap/
    ├── app.php                             # Middleware registration
    └── providers.php                       # Service provider registration
```

---

## Database Schema

### Tables

| Table | Purpose |
|---|---|
| `users` | Registered users (extended with role_id, avatar, is_active) |
| `roles` | Three roles: admin, team_member, guest |
| `categories` | Task categories with hex color codes |
| `tasks` | Core task table with status, priority, assignments, deadlines |
| `task_comments` | Comments on tasks |
| `activity_logs` | Polymorphic audit trail of all task actions |
| `sessions` | Laravel session storage |
| `cache` | Laravel cache storage |
| `jobs` | Queue job table for email notifications |

### User Roles

| Role | Permissions |
|---|---|
| **Admin** | Full access — all tasks, users, categories, reports, activity log |
| **Team Member** | Create/edit/assign tasks and categories they own |
| **Guest** | View only tasks assigned to them — read-only |

---

## Setup & Installation

### Prerequisites

- PHP >= 8.2
- Composer >= 2.x
- MySQL >= 8.x
- Node.js >= 18.x (for asset compilation)
- A mail server or Mailpit for local email testing

### Step 1 — Clone and Install Dependencies

```bash
git clone <your-repo-url> taskflowpro
cd taskflowpro
composer install
npm install
```

### Step 2 — Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database and mail credentials:

```env
APP_NAME=TaskFlow
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskflowpro
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_FROM_ADDRESS="noreply@taskflow.test"
MAIL_FROM_NAME="TaskFlow"

QUEUE_CONNECTION=database
```

### Step 3 — Create Database

```sql
CREATE DATABASE taskflowpro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 4 — Run Migrations and Seed

```bash
php artisan migrate:fresh --seed
```

This will create all tables and seed:
- 3 roles (admin, team_member, guest)
- 1 admin user (`admin@taskapp.test` / `password`)
- 5 team members
- 3 guest users
- 6 categories
- 50 sample tasks

### Step 5 — Compile Assets

```bash
npm run build
# or for development with hot reload:
npm run dev
```

### Step 6 — Start the Application

```bash
php artisan serve
```

Visit: **http://localhost:8000**

### Step 7 — Start the Queue Worker (for email notifications)

```bash
php artisan queue:work
```

### Step 8 — Start the Scheduler (for deadline reminders)

```bash
php artisan schedule:work
```

---

## Using the Application

### User Registration

1. Visit **http://localhost:8000**
2. Click **Get started** or **Register**
3. Fill in your name, email, and password
4. After registration, your account defaults to the **Guest** role
5. An Admin must promote you to **Team Member** before you can create tasks

### Logging In

1. Visit **http://localhost:8000/login**
2. Enter your email and password
3. Use the seeded admin account: `admin@taskapp.test` / `password`

### Default Test Accounts

| Email | Password | Role |
|---|---|---|
| admin@taskapp.test | password | Admin |
| (factory users) | password | Team Member / Guest |

---

### Creating a Task (Team Member / Admin)

1. Navigate to **Tasks** in the sidebar
2. Click **+ New Task**
3. Fill in:
   - **Title** (required, min 3 characters)
   - **Description** (optional)
   - **Status** — Pending, In Progress, Completed, Cancelled
   - **Priority** — Low, Medium, High, Critical
   - **Category** — select from existing categories
   - **Assign To** — select a team member
   - **Due Date** — must be today or future
4. Click **Create Task**
5. The assigned user receives an email notification

### Updating Task Status

- From the **task list**, hover a card and click the **✓** quick-complete button
- From the **task detail page**, use the **Status** dropdown and save
- Status changes are logged in the activity log automatically

### Assigning a Task

1. Open a task (click the title)
2. Click **Edit**
3. Change the **Assign To** field
4. Save — the new assignee receives an email notification

### Deleting a Task

- Hover a task card — the **trash icon** appears (only visible to the creator or admin)
- Click it and confirm the prompt
- Tasks are soft-deleted (recoverable from the database)

---

### Managing Categories (Team Member / Admin)

1. Click **Categories** in the sidebar
2. Click **+ New Category**
3. Set a name, pick a colour, and add an optional description
4. The colour appears as a pill on every task card in that category

---

### Administrative Functions (Admin Only)

#### Admin Dashboard — `/admin`
- Total tasks, pending, in-progress, completed, overdue counts
- Active user count
- Recent task list

#### User Management — `/admin/users`
- View all registered users
- Change any user's role (Admin → Team Member → Guest and back)
- Activate or deactivate user accounts

#### Reports — `/admin/reports`
- Tasks grouped by category
- Tasks grouped by priority
- Tasks grouped by status

#### Activity Log — `/admin/activity-log`
- Full audit trail of every task creation, update, and deletion
- Shows which user performed the action and what changed

---

### Deadline Reminder Emails

The system automatically sends email reminders for tasks due the next day.

To run manually:
```bash
php artisan reminders:send-deadlines
```

To run on a schedule (daily at 08:00), ensure the scheduler is running:
```bash
php artisan schedule:work
```

---

## Security Features

| Feature | Implementation |
|---|---|
| CSRF Protection | `@csrf` on all POST/PUT/PATCH/DELETE forms |
| XSS Prevention | All output uses `{{ }}` Blade escaping — no raw `{!! !!}` on user data |
| SQL Injection | All queries use Eloquent ORM or parameterised query builder |
| Authentication | Laravel Breeze with email verification |
| Role-Based Access | `RoleMiddlewareAMY` on routes + Policies on model actions |
| Rate Limiting | Built-in Breeze rate limiting on login (5 attempts) |
| Password Hashing | Bcrypt via Laravel's `'hashed'` cast |
| Soft Deletes | Tasks, categories, and comments use soft deletes |

---

## Key Artisan Commands

```bash
# Run all migrations and seed the database
php artisan migrate:fresh --seed

# List all registered routes
php artisan route:list

# Send deadline reminder emails manually
php artisan reminders:send-deadlines

# Clear all caches
php artisan optimize:clear

# Run the queue worker
php artisan queue:work

# Run the scheduler
php artisan schedule:work

# Open Laravel REPL
php artisan tinker

# Run tests
php artisan test
```

---

## Troubleshooting

| Problem | Fix |
|---|---|
| `users table does not exist` | Run `php artisan migrate:fresh --seed` |
| `403 on categories` | Check `bootstrap/providers.php` includes `AuthServiceProviderAMY` |
| `RoleMiddlewareAMY does not exist` | Add `use App\Http\Middleware\RoleMiddlewareAMY;` to `bootstrap/app.php` |
| Blade shows raw `@extends` text | Run `php artisan view:clear` and check file is saved as `.blade.php` |
| Emails not sending | Start `php artisan queue:work` and check `.env` mail settings |
