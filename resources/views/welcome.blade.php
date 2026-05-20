<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TaskFlow Pro — A powerful team task management platform. Organize, assign, and track work across your entire team.">
    <title>{{ config('app.name', 'TaskFlow Pro') }} — Team Task Management</title>

    {{-- Google Fonts: Syne (display) + DM Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    {{-- Vite compiled assets --}}
    @vite(['resources/css/app.css'])

</head>
<body>

    {{-- ── Geometric background lines ── --}}
    <div class="geo-bg" aria-hidden="true">
        <div class="geo-line geo-line-1"></div>
        <div class="geo-line geo-line-2"></div>
    </div>

    {{-- ========================================================= --}}
    {{-- NAVIGATION                                                 --}}
    {{-- ========================================================= --}}
    <nav>
        <div class="wrapper nav-inner">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="nav-logo">
                <span class="nav-logo-dot" aria-hidden="true"></span>
                TaskFlow Pro
            </a>

            {{-- Nav links --}}
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#roles">Roles</a></li>
                <li><a href="#preview">Preview</a></li>
            </ul>

            {{-- Auth CTA --}}
            <div class="nav-cta">
                @auth
                    {{-- Already logged in — go to dashboard --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        Go to Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Sign in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get started</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ========================================================= --}}
    {{-- HERO                                                       --}}
    {{-- ========================================================= --}}
    <section class="wrapper hero">

        {{-- Left: copy --}}
        <div>
            <p class="hero-eyebrow reveal d1">Team Task Management</p>

            <h1 class="hero-title reveal d2">
                Work flows<br>when tasks<br><em>don't slip.</em>
            </h1>

            <p class="hero-desc reveal d3">
                TaskFlow Pro gives your team a shared view of every task — assigned,
                prioritised, and tracked to completion. Built on Laravel with
                role-based access for Admins, Team Members, and Guests.
            </p>

            <div class="hero-actions reveal d4">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        Open Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Start for free &rarr;
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">
                        Sign in
                    </a>
                @endauth
            </div>

            <p class="hero-note reveal d5">No credit card required &nbsp;·&nbsp; Laravel Breeze auth &nbsp;·&nbsp; Email reminders included</p>
        </div>

        {{-- Right: role cards (decorative) --}}
        <div class="hero-visual" aria-hidden="true" id="roles">

            {{-- Admin card --}}
            <div class="role-card reveal d2">
                <div class="role-icon role-icon-admin">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="role-card-title">Administrator</p>
                    <p class="role-card-desc">Full access — users, reports, audit log, all tasks</p>
                </div>
                <span class="role-badge badge-admin">Admin</span>
            </div>

            {{-- Team Member --}}
            <div class="role-card reveal d3">
                <div class="role-icon role-icon-member">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="role-card-title">Team Member</p>
                    <p class="role-card-desc">Create, assign, and manage tasks &amp; categories</p>
                </div>
                <span class="role-badge badge-member">Member</span>
            </div>

            {{-- Guest --}}
            <div class="role-card reveal d4">
                <div class="role-icon role-icon-guest">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="role-card-title">Guest</p>
                    <p class="role-card-desc">View only assigned tasks — read-only access</p>
                </div>
                <span class="role-badge badge-guest">Guest</span>
            </div>
        </div>
    </section>

    {{-- ========================================================= --}}
    {{-- STATS BAR                                                  --}}
    {{-- ========================================================= --}}
    <div class="wrapper">
        <div class="stats-bar reveal d5">
            <div class="stat-cell">
                <p class="stat-number">3<span>×</span></p>
                <p class="stat-label">User Roles</p>
            </div>
            <div class="stat-cell">
                <p class="stat-number">4<span>+</span></p>
                <p class="stat-label">Task Statuses</p>
            </div>
            <div class="stat-cell">
                <p class="stat-number">∞</p>
                <p class="stat-label">Tasks &amp; Categories</p>
            </div>
            <div class="stat-cell">
                <p class="stat-number">1<span>d</span></p>
                <p class="stat-label">Email Reminders</p>
            </div>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- FEATURES                                                   --}}
    {{-- ========================================================= --}}
    <section class="wrapper" id="features">
        <div class="section-header reveal d1">
            <p class="section-label">What's inside</p>
            <h2 class="section-title">Everything your team needs</h2>
        </div>

        <div class="features-grid reveal d2">

            {{-- Feature 1 --}}
            <div class="feature-cell">
                <p class="feature-num">01</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <p class="feature-title">Full Task CRUD</p>
                <p class="feature-desc">Create, edit, assign, and delete tasks. Set status, priority, category, deadline, and assignee in one form.</p>
            </div>

            {{-- Feature 2 --}}
            <div class="feature-cell">
                <p class="feature-num">02</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="feature-title">Role-Based Access</p>
                <p class="feature-desc">Admin, Team Member, and Guest roles enforced via Laravel Policies, Gates, and custom middleware on every route.</p>
            </div>

            {{-- Feature 3 --}}
            <div class="feature-cell">
                <p class="feature-num">03</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="feature-title">Deadline Reminders</p>
                <p class="feature-desc">Scheduled Artisan command sends queued email reminders to assignees 24 hours before any task is due.</p>
            </div>

            {{-- Feature 4 --}}
            <div class="feature-cell">
                <p class="feature-num">04</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <p class="feature-title">Categories &amp; Priorities</p>
                <p class="feature-desc">Organise tasks into color-coded categories. Four priority levels: Low, Medium, High, and Critical.</p>
            </div>

            {{-- Feature 5 --}}
            <div class="feature-cell">
                <p class="feature-num">05</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <p class="feature-title">Secure by Default</p>
                <p class="feature-desc">CSRF tokens on all forms, XSS-safe Blade escaping, Eloquent-parameterised queries, and rate-limited auth.</p>
            </div>

            {{-- Feature 6 --}}
            <div class="feature-cell">
                <p class="feature-num">06</p>
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="feature-title">Admin Reports &amp; Logs</p>
                <p class="feature-desc">Admins get a full activity audit log, per-category task reports, and user management with role assignment.</p>
            </div>

        </div>
    </section>

    <!-- {{-- ========================================================= --}}
    {{-- TASK PREVIEW                                               --}}
    {{-- ========================================================= --}}
    <section class="wrapper" id="preview">
        <div class="section-header reveal d1">
            <p class="section-label">Live preview</p>
            <h2 class="section-title">What your task list looks like</h2>
        </div>

        <div class="task-preview reveal d2">
            <div class="task-preview-header">
                <p class="task-preview-title">My Tasks &nbsp;·&nbsp; All Statuses</p>
                <div class="dot-trio" aria-hidden="true">
                    <span></span><span></span><span></span>
                </div>
            </div>

            {{-- Sample task rows (static demo — no real data) --}}
            <div class="task-row">
                <div class="task-check done" aria-label="Completed"></div>
                <p class="task-name done-text">Set up Laravel project &amp; Breeze auth</p>
                <span class="task-pill pill-low">Low</span>
                <div class="task-assignee" title="Admin User">AU</div>
                <span class="task-due">14 May</span>
            </div>

            <div class="task-row">
                <div class="task-check done" aria-label="Completed"></div>
                <p class="task-name done-text">Create database migrations with indexes</p>
                <span class="task-pill pill-medium">Medium</span>
                <div class="task-assignee" title="Team Member">TM</div>
                <span class="task-due">16 May</span>
            </div>

            <div class="task-row">
                <div class="task-check" aria-label="Pending"></div>
                <p class="task-name">Implement role-based middleware</p>
                <span class="task-pill pill-high">High</span>
                <div class="task-assignee" title="Alice B">AB</div>
                <span class="task-due">Today</span>
            </div>

            <div class="task-row">
                <div class="task-check" aria-label="Pending"></div>
                <p class="task-name">Wire up deadline reminder email queue</p>
                <span class="task-pill pill-critical">Critical</span>
                <div class="task-assignee" title="Bob C">BC</div>
                <span class="task-due overdue">Yesterday</span>
            </div>

            <div class="task-row">
                <div class="task-check" aria-label="Pending"></div>
                <p class="task-name">Convert AdminLTE templates to Blade components</p>
                <span class="task-pill pill-medium">Medium</span>
                <div class="task-assignee" title="Carol D">CD</div>
                <span class="task-due">22 May</span>
            </div>
        </div>
    </section> -->

    {{-- ========================================================= --}}
    {{-- CTA                                                        --}}
    {{-- ========================================================= --}}
    <section class="wrapper cta-section reveal d1">
        <h2 class="cta-title">Ready to bring order<br>to the chaos?</h2>
        <p class="cta-desc">Register your account and start managing tasks in under a minute.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                Open Dashboard &rarr;
            </a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                Create your account &rarr;
            </a>
        @endauth
    </section>

    {{-- ========================================================= --}}
    {{-- FOOTER                                                     --}}
    {{-- ========================================================= --}}
    <footer>
        <div class="wrapper footer-inner">
            <p class="footer-copy">
                &copy; {{ date('Y') }} {{ config('app.name', 'TaskFlow Pro') }}.
                Built with Laravel &amp; Breeze.
            </p>
            <ul class="footer-links">
                <li><a href="{{ route('login') }}">Sign in</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endauth
            </ul>
        </div>
    </footer>

</body>
</html>