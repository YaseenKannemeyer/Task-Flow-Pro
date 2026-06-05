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
├── 📁 app
│   ├── 📁 Console
│   │   └── 📁 Commands
│   │       └── 🐘 SendDeadlineRemindersAMY.php
│   ├── 📁 Http
│   │   ├── 📁 Controllers
│   │   │   ├── 📁 Auth
│   │   │   │   ├── 🐘 AuthenticatedSessionController.php
│   │   │   │   ├── 🐘 ConfirmablePasswordController.php
│   │   │   │   ├── 🐘 EmailVerificationNotificationController.php
│   │   │   │   ├── 🐘 EmailVerificationPromptController.php
│   │   │   │   ├── 🐘 NewPasswordController.php
│   │   │   │   ├── 🐘 PasswordController.php
│   │   │   │   ├── 🐘 PasswordResetLinkController.php
│   │   │   │   ├── 🐘 RegisteredUserController.php
│   │   │   │   └── 🐘 VerifyEmailController.php
│   │   │   ├── 🐘 AdminControllerAMY.php
│   │   │   ├── 🐘 CategoryControllerAMY.php
│   │   │   ├── 🐘 Controller.php
│   │   │   ├── 🐘 DashboardControllerAMY.php
│   │   │   ├── 🐘 NotificationControllerAMY.php
│   │   │   ├── 🐘 ProfileController.php
│   │   │   ├── 🐘 ProfileControllerAMY.php
│   │   │   ├── 🐘 TaskAMYController.php
│   │   │   ├── 🐘 TaskCommentControllerAMY.php
│   │   │   └── 🐘 TaskControllerAMY.php
│   │   ├── 📁 Middleware
│   │   │   ├── 🐘 ActivityLogMiddlewareAMY.php
│   │   │   ├── 🐘 GuestRedirectMiddlewareAMY.php
│   │   │   └── 🐘 RoleMiddlewareAMY.php
│   │   └── 📁 Requests
│   │       ├── 📁 Auth
│   │       │   └── 🐘 LoginRequest.php
│   │       ├── 🐘 AssignTaskRequestAMY.php
│   │       ├── 🐘 ProfileUpdateRequest.php
│   │       ├── 🐘 StoreCategoryRequestAMY.php
│   │       ├── 🐘 StoreCommentRequestAMY.php
│   │       ├── 🐘 StoreTaskRequestAMY.php
│   │       ├── 🐘 UpdateCategoryRequestAMY.php
│   │       ├── 🐘 UpdateProfileRequestAMY.php
│   │       └── 🐘 UpdateTaskRequestAMY.php
│   ├── 📁 Mail
│   │   └── 🐘 DeadlineReminderMailAMY.php
│   ├── 📁 Models
│   │   ├── 🐘 ActivityLog.php
│   │   ├── 🐘 CategoryAMY.php
│   │   ├── 🐘 DeadlineReminderAMY.php
│   │   ├── 🐘 PriorityAMY.php
│   │   ├── 🐘 RoleAMY.php
│   │   ├── 🐘 TaskAMY.php
│   │   ├── 🐘 TaskCommentAMY.php
│   │   └── 🐘 User.php
│   ├── 📁 Notifications
│   │   ├── 🐘 DeadlineApproachingNotificationAMY.php
│   │   ├── 🐘 TaskAssignedNotificationAMY.php
│   │   └── 🐘 TaskStatusChangedNotificationAMY.php
│   ├── 📁 Observers
│   │   └── 🐘 TaskObserverAMY.php
│   ├── 📁 Policies
│   │   ├── 🐘 AdminPolicyAMY.php
│   │   ├── 🐘 CategoryPolicyAMY.php
│   │   ├── 🐘 CommentPolicyAMY.php
│   │   └── 🐘 TaskPolicyAMY.php
│   ├── 📁 Providers
│   │   ├── 🐘 AppServiceProvider.php
│   │   ├── 🐘 AuthServiceProviderAMY.php
│   │   └── 🐘 RepositoryServiceProviderAMY.php
│   ├── 📁 Services
│   │   ├── 🐘 NotificationServiceAMY.php
│   │   └── 🐘 TaskServiceAMY.php
│   └── 📁 View
│       └── 📁 Components
│           ├── 🐘 Alert.php
│           ├── 🐘 AppLayout.php
│           ├── 🐘 Breadcrumb.php
│           ├── 🐘 GuestLayout.php
│           ├── 🐘 Modal.php
│           ├── 🐘 Navbar.php
│           ├── 🐘 PriorityBadge.php
│           ├── 🐘 Sidebar.php
│           ├── 🐘 StatusBadge.php
│           └── 🐘 TaskCard.php
├── 📁 bootstrap
│   ├── 🐘 app.php
│   └── 🐘 providers.php
├── 📁 config
│   ├── 🐘 app.php
│   ├── 🐘 auth.php
│   ├── 🐘 cache.php
│   ├── 🐘 database.php
│   ├── 🐘 filesystems.php
│   ├── 🐘 logging.php
│   ├── 🐘 mail.php
│   ├── 🐘 queue.php
│   ├── 🐘 services.php
│   └── 🐘 session.php
├── 📁 database
│   ├── 📁 factories
│   │   ├── 🐘 CategoryFactoryAMYFactory.php
│   │   ├── 🐘 TaskAMYFactory.php
│   │   ├── 🐘 TaskCommentFactoryAMYFactory.php
│   │   ├── 🐘 TaskFactoryAMYFactory.php
│   │   └── 🐘 UserFactory.php
│   ├── 📁 migrations
│   │   ├── 🐘 2026_05_18_000000_create_users_table.php
│   │   ├── 🐘 2026_05_18_095655_create_roles_table.php
│   │   ├── 🐘 2026_05_18_095700_add_role_id_to_users_table.php
│   │   ├── 🐘 2026_05_18_095705_create_categories_table.php
│   │   ├── 🐘 2026_05_18_095717_create_tasks_table.php
│   │   ├── 🐘 2026_05_18_095722_create_task_comments_table.php
│   │   ├── 🐘 2026_05_18_095731_create_activity_logs_table.php
│   │   ├── 🐘 2026_05_18_100646_add_completed_at_to_tasks_table.php
│   │   ├── 🐘 2026_05_18_100646_add_role_to_users_table.php
│   │   ├── 🐘 2026_05_18_101229_create_sessions_table.php
│   │   ├── 🐘 2026_05_18_113128_create_cache_table.php
│   │   ├── 🐘 2026_05_18_173134_create_notifications_table.php
│   │   └── 🐘 2026_05_18_181345_create_activity_logs_table.php
│   ├── 📁 seeders
│   │   ├── 🐘 CategorySeederAMY.php
│   │   ├── 🐘 DatabaseSeeder.php
│   │   ├── 🐘 RoleSeederAMY.php
│   │   ├── 🐘 TaskAMYSeeder.php
│   │   ├── 🐘 TaskSeederAMY.php
│   │   └── 🐘 UserSeederAMY.php
│   ├── ⚙️ .gitignore
│   └── 📄 database.sqlite
├── 📁 public
│   ├── ⚙️ .htaccess
│   ├── 📄 favicon.ico
│   ├── 🐘 index.php
│   └── 📄 robots.txt
├── 📁 resources
│   ├── 📁 css
│   │   └── 🎨 app.css
│   ├── 📁 js
│   │   ├── 📄 app.js
│   │   └── 📄 bootstrap.js
│   └── 📁 views
│       ├── 📁 admin
│       │   ├── 🐘 activity-log.blade.php
│       │   ├── 🐘 index.blade.php
│       │   ├── 🐘 reports.blade.php
│       │   └── 🐘 users.blade.php
│       ├── 📁 auth
│       │   ├── 🐘 confirm-password.blade.php
│       │   ├── 🐘 forgot-password.blade.php
│       │   ├── 🐘 login.blade.php
│       │   ├── 🐘 register.blade.php
│       │   ├── 🐘 reset-password.blade.php
│       │   └── 🐘 verify-email.blade.php
│       ├── 📁 categories
│       │   ├── 🐘 create.blade.php
│       │   ├── 🐘 edit.blade.php
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 show.blade.php
│       ├── 📁 components
│       │   ├── 🐘 alert.blade.php
│       │   ├── 🐘 application-logo.blade.php
│       │   ├── 🐘 auth-session-status.blade.php
│       │   ├── 🐘 breadcrumb.blade.php
│       │   ├── 🐘 danger-button.blade.php
│       │   ├── 🐘 dropdown-link.blade.php
│       │   ├── 🐘 dropdown.blade.php
│       │   ├── 🐘 input-error.blade.php
│       │   ├── 🐘 input-label.blade.php
│       │   ├── 🐘 modal.blade.php
│       │   ├── 🐘 nav-link.blade.php
│       │   ├── 🐘 navbar.blade.php
│       │   ├── 🐘 primary-button.blade.php
│       │   ├── 🐘 priority-badge.blade.php
│       │   ├── 🐘 responsive-nav-link.blade.php
│       │   ├── 🐘 secondary-button.blade.php
│       │   ├── 🐘 sidebar.blade.php
│       │   ├── 🐘 status-badge.blade.php
│       │   ├── 🐘 task-card.blade.php
│       │   └── 🐘 text-input.blade.php
│       ├── 📁 emails
│       │   └── 🐘 deadline-reminder.blade.php
│       ├── 📁 errors
│       │   └── 🐘 404.blade.php
│       ├── 📁 layouts
│       │   ├── 🐘 app.blade.php
│       │   ├── 🐘 guest.blade.php
│       │   └── 🐘 navigation.blade.php
│       ├── 📁 profile
│       │   ├── 📁 partials
│       │   │   ├── 🐘 delete-user-form.blade.php
│       │   │   ├── 🐘 update-password-form.blade.php
│       │   │   └── 🐘 update-profile-information-form.blade.php
│       │   └── 🐘 edit.blade.php
│       ├── 📁 tasks
│       │   ├── 🐘 assigned.blade.php
│       │   ├── 🐘 calendar.blade.php
│       │   ├── 🐘 create.blade.php
│       │   ├── 🐘 edit.blade.php
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 show.blade.php
│       └── 🐘 welcome.blade.php
├── 📁 routes
│   ├── 🐘 auth.php
│   ├── 🐘 console.php
│   └── 🐘 web.php
├── 📁 storage
│   ├── 📁 app
│   │   ├── 📁 private
│   │   │   └── ⚙️ .gitignore
│   │   ├── 📁 public
│   │   │   └── ⚙️ .gitignore
│   │   └── ⚙️ .gitignore
│   ├── 📁 framework
│   │   ├── 📁 sessions
│   │   │   ├── ⚙️ .gitignore
│   │   │   ├── 📄 P8vkQKqE7gtDeKjuNbkb9mJdsdF5YkIidwWpUzRo
│   │   │   ├── 📄 S21JVnAknO8Kw4ty9r9dLFrjF17A9xUbxJoAkdUg
│   │   │   └── 📄 V4hSGK0yMtnLoMHUa9E9BPZgGZPEru755ifw1cHJ
│   │   ├── 📁 testing
│   │   │   └── ⚙️ .gitignore
│   │   ├── 📁 views
│   │   │   ├── ⚙️ .gitignore
│   │   │   ├── 🐘 018f5fb19fb41ea196187cde0e16339d.php
│   │   │   ├── 🐘 046bb67d361e02a76ea5299d5e411f2f.php
│   │   │   ├── 🐘 0898a631b59f92ce44e39a12fcd62fbb.php
│   │   │   ├── 🐘 08e17a4b70dbe55dc6172d80a3300700.php
│   │   │   ├── 🐘 0b3347a1073331ddd4362ce051ba85df.php
│   │   │   ├── 🐘 0b338b38175742801ce9cd760c599bd1.php
│   │   │   ├── 🐘 0b497d0b2396e1ea5d1427d0af082610.php
│   │   │   ├── 🐘 0ba37a291f26548ac1c3e9dc7f081adb.php
│   │   │   ├── 🐘 0d979abc255b78e42d578a6f078c49cd.php
│   │   │   ├── 🐘 0f332b981f5a52cabdd34f2d08823f59.php
│   │   │   ├── 🐘 1421f79ed281e268ba9e49227de414e9.php
│   │   │   ├── 🐘 1e2332cdb4362cb29fe0ed5191bd4058.php
│   │   │   ├── 🐘 24bf1913d257234f6662cb47a81af509.php
│   │   │   ├── 🐘 26374f0f63f5384f69b539d28c348ad8.php
│   │   │   ├── 🐘 2a4317060ed93565927e8050be6819d7.php
│   │   │   ├── 🐘 2c23e755294481cfdfdb78502a2f55d1.php
│   │   │   ├── 🐘 2d46d09e1a539e4be9271e273e819412.php
│   │   │   ├── 🐘 30e528fe92504ac7bfedcac15fc33584.php
│   │   │   ├── 🐘 3a1cc2af4ad005a7a99cece605435ca5.php
│   │   │   ├── 🐘 3f68dd790b03897df61b70a531176dcf.php
│   │   │   ├── 🐘 403a39911faf4fbbdd9235cd51a83b85.php
│   │   │   ├── 🐘 41241012543dc3f393c4350c2415a4ee.php
│   │   │   ├── 🐘 44d136acedd088d12ee832fb3d2cd05e.php
│   │   │   ├── 🐘 4743e905439061f57904b298daca2c4d.php
│   │   │   ├── 🐘 499f8114633c8a4ea91eec98d8381820.php
│   │   │   ├── 🐘 4b40d0e423873bec3087d2d185d25f17.php
│   │   │   ├── 🐘 553489753a6d713c5c53f6c1c2538613.php
│   │   │   ├── 🐘 5579ee1f5c9518e15f557b6deea582ff.php
│   │   │   ├── 🐘 5adc8eb22166589b6bcb8eda9d320831.php
│   │   │   ├── 🐘 669befe49d3ce5f2ff6b465f2a566887.php
│   │   │   ├── 🐘 68a20ccb9f0d7117dee6b352eb409ee0.php
│   │   │   ├── 🐘 69634fd3febc519342b43bb54761c786.php
│   │   │   ├── 🐘 69a0766d27bdeeb27c6f4cc6dd940755.php
│   │   │   ├── 🐘 69b2b8b205987a15564bfa8d517a19e2.php
│   │   │   ├── 🐘 6c69deb2b3a923a0cd83c6abf4f89e1e.php
│   │   │   ├── 🐘 6db8d75bdcedbfbd51239ba1d471b0d9.php
│   │   │   ├── 🐘 71fdacb32e8bb2b81ecc3dcb69dd83b9.php
│   │   │   ├── 🐘 734f2ee259a76bdf46b4e291f08b857e.php
│   │   │   ├── 🐘 74945bcc4e09d6af98df224c283a44c3.php
│   │   │   ├── 🐘 75f7ae4dbeddfae50f7a623ac6643048.php
│   │   │   ├── 🐘 76abcb04c9b3140331876226155e9d3c.php
│   │   │   ├── 🐘 76f00209cb2cc52fc1956022b50c130a.php
│   │   │   ├── 🐘 772e77475ba7a3ae9bc16e0d3c919ab2.php
│   │   │   ├── 🐘 77c34c3778b3ba17f214178149cd4dc8.php
│   │   │   ├── 🐘 7f5300f9de503d601652031875eba9bd.php
│   │   │   ├── 🐘 80cb50025e000aaa556b25eaca48bf8c.php
│   │   │   ├── 🐘 81903831b5140f8718c479a89ce1cd20.php
│   │   │   ├── 🐘 85c70dedbb28b3f5d3da108f1b8478ca.php
│   │   │   ├── 🐘 875bceae23d11627f8d2ba80a1e6b3e1.php
│   │   │   ├── 🐘 8b34610690c4c8fc10428e58d932b4cf.php
│   │   │   ├── 🐘 900cdbc478aed6ff0f2c94cf283b9c97.php
│   │   │   ├── 🐘 923c925f1bf925ff69d4d075e353527e.php
│   │   │   ├── 🐘 938da516a0c159cbba4a36b8a518fc5b.php
│   │   │   ├── 🐘 9a2c0d6a61e1453ff09d0ac67bd971d6.php
│   │   │   ├── 🐘 9c47fd6661aac3e8684ddc3e50852904.php
│   │   │   ├── 🐘 a0c595321bf49e0926c698bf3443cf67.php
│   │   │   ├── 🐘 a4b62ecedaa48a9d1c7dfaf3048a6436.php
│   │   │   ├── 🐘 a852c1ca9d3d9da6fd1d1e82b9738aa1.php
│   │   │   ├── 🐘 a8d8556477948cc301cbc06ac2041ab5.php
│   │   │   ├── 🐘 af0370e5b921452bdac1ffe57a8880ff.php
│   │   │   ├── 🐘 b79d8aa20d1540db83d816498109a783.php
│   │   │   ├── 🐘 b88e06ea7c044c03924bf613c5d1f85a.php
│   │   │   ├── 🐘 b8f249cdc03cb44115bda5f2ed33c165.php
│   │   │   ├── 🐘 bb77520ceb2b46c5f9db2d74ee75f3ac.php
│   │   │   ├── 🐘 bc73dd188f03d169dac2c109575f02a3.php
│   │   │   ├── 🐘 bc9ec824e45257967b6e57af90fbf6d2.php
│   │   │   ├── 🐘 beadb2fc0091a6b6f7c33a521e66675e.php
│   │   │   ├── 🐘 c6c98901329ba287455c98db639210a8.php
│   │   │   ├── 🐘 c83d620462f6e7be9d745dcdcf8a2079.php
│   │   │   ├── 🐘 cd2af9e381d7f7994a1e93b363741eb6.php
│   │   │   ├── 🐘 d042b2dd9931a427273963f93d635139.php
│   │   │   ├── 🐘 d376b5f2d4b7f55e0efabd62504d1667.php
│   │   │   ├── 🐘 d7bbac0c84efab62b14d210c262eed73.php
│   │   │   ├── 🐘 dcd5687b4509417078d4aaff83cbbc87.php
│   │   │   ├── 🐘 dedd7c3c48381b0202d3b043098a72c6.php
│   │   │   ├── 🐘 e3b544e751a27a4ea49e8764b7b01b13.php
│   │   │   ├── 🐘 e4ec547eb2301d9f82315be5b9ad4631.php
│   │   │   ├── 🐘 e626ecd459a6ff4483d9051732cf4586.php
│   │   │   ├── 🐘 e6bec58cb307302e3a66d6420824b7d7.php
│   │   │   ├── 🐘 ec04e3daeb7fe820da56dc7e477df193.php
│   │   │   ├── 🐘 ed61f173e405600f20bc28784bcd2070.php
│   │   │   ├── 🐘 f6893ee00fd295abfc6ccfb649e057d2.php
│   │   │   └── 🐘 fd517f9bbe7b720dd252842fd5f45616.php
│   │   └── ⚙️ .gitignore
│   └── 📁 logs
│       └── ⚙️ .gitignore
├── 📁 tests
│   ├── 📁 Feature
│   │   ├── 📁 Auth
│   │   │   ├── 🐘 AuthenticationTest.php
│   │   │   ├── 🐘 EmailVerificationTest.php
│   │   │   ├── 🐘 PasswordConfirmationTest.php
│   │   │   ├── 🐘 PasswordResetTest.php
│   │   │   ├── 🐘 PasswordUpdateTest.php
│   │   │   └── 🐘 RegistrationTest.php
│   │   ├── 🐘 ExampleTest.php
│   │   └── 🐘 ProfileTest.php
│   ├── 📁 Unit
│   │   └── 🐘 ExampleTest.php
│   └── 🐘 TestCase.php
├── 📄 -dir
├── ⚙️ .editorconfig
├── ⚙️ .env.example
├── ⚙️ .gitattributes
├── ⚙️ .gitignore
├── ⚙️ .npmrc
├── 📝 README.md
├── 📄 artisan
├── ⚙️ composer.json
├── 📄 dir
├── 📄 dir]
├── ⚙️ package-lock.json
├── ⚙️ package.json
├── ⚙️ phpunit.xml
├── 📄 postcss.config.js
├── 📄 tailwind.config.js
└── 📄 vite.config.js
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
