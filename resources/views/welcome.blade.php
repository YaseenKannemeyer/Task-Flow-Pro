{{--
    resources/views/welcome.blade.php
    TaskFlow — Public Landing / Welcome Page
    Design: Dark editorial with geometric accent lines, staggered reveal animations.
    Font: Syne (display) + DM Sans (body) via Google Fonts.
    No inline styles except CSS custom properties and animation delays.
    All user-output is escaped with {{ }}.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TaskFlow — A powerful team task management platform. Organize, assign, and track work across your entire team.">
    <title>{{ config('app.name', 'TaskFlow') }} — Team Task Management</title>

    {{-- Google Fonts: Syne (display) + DM Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    {{-- Vite compiled assets --}}
    @vite(['resources/css/app.css'])

    <style>
        /* ── Design Tokens ── */
        :root {
            --bg:        #0b0c0e;
            --surface:   #111316;
            --border:    rgba(255,255,255,0.07);
            --accent:    #d4f24a;       /* electric lime */
            --accent-dk: #a8c23a;
            --text-1:    #f0efe8;
            --text-2:    #8a897f;
            --text-3:    #4a4944;
            --font-display: 'Syne', sans-serif;
            --font-body:    'DM Sans', sans-serif;
        }

        /* ── Reset ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--bg);
            color: var(--text-1);
            font-family: var(--font-body);
            font-size: 16px;
            line-height: 1.65;
            font-weight: 300;
            overflow-x: hidden;
        }
        a { color: inherit; text-decoration: none; }

        /* ── Staggered reveal animation ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .reveal {
            opacity: 0;
            animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.18s; }
        .d3 { animation-delay: 0.32s; }
        .d4 { animation-delay: 0.48s; }
        .d5 { animation-delay: 0.62s; }
        .d6 { animation-delay: 0.76s; }

        /* ── Geometric background pattern ── */
        .geo-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .geo-bg::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 70vw;
            height: 70vw;
            border-radius: 50%;
            border: 1px solid rgba(212,242,74,0.06);
        }
        .geo-bg::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 55vw;
            height: 55vw;
            border-radius: 50%;
            border: 1px solid rgba(212,242,74,0.04);
        }
        .geo-line {
            position: absolute;
            background: rgba(212,242,74,0.08);
        }
        .geo-line-1 { top: 0; left: 48%; width: 1px; height: 100vh; }
        .geo-line-2 { top: 38%; left: 0; width: 100vw; height: 1px; }

        /* ── Layout ── */
        .wrapper {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ── Nav ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(20px);
            background: rgba(11,12,14,0.85);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .nav-logo {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-logo-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--text-2);
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--text-1); }
        .nav-cta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.55rem 1.25rem;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-ghost {
            color: var(--text-2);
            border-color: var(--border);
            background: transparent;
        }
        .btn-ghost:hover {
            color: var(--text-1);
            border-color: rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.04);
        }
        .btn-primary {
            color: #0b0c0e;
            background: var(--accent);
            border-color: var(--accent);
        }
        .btn-primary:hover {
            background: #e0ff5a;
            border-color: #e0ff5a;
            transform: translateY(-1px);
        }
        .btn-lg {
            font-size: 1rem;
            padding: 0.85rem 2rem;
            border-radius: 8px;
        }

        /* ── Hero ── */
        .hero {
            padding: 9rem 0 7rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 24px;
            height: 1px;
            background: var(--accent);
        }
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.0;
            letter-spacing: -0.03em;
            color: var(--text-1);
            margin-bottom: 1.5rem;
        }
        .hero-title em {
            font-style: normal;
            color: var(--accent);
        }
        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-2);
            line-height: 1.7;
            max-width: 42ch;
            margin-bottom: 2.5rem;
        }
        .hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .hero-note {
            font-size: 0.8rem;
            color: var(--text-3);
            margin-top: 1rem;
        }

        /* ── Hero visual (role cards) ── */
        .hero-visual {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .role-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: border-color 0.3s, transform 0.3s;
        }
        .role-card:hover {
            border-color: rgba(212,242,74,0.2);
            transform: translateX(4px);
        }
        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
        }
        .role-icon-admin  { background: rgba(212,242,74,0.12); color: var(--accent); }
        .role-icon-member { background: rgba(99,102,241,0.12); color: #818cf8; }
        .role-icon-guest  { background: rgba(251,191,36,0.10); color: #fbbf24; }
        .role-card-title {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-1);
        }
        .role-card-desc {
            font-size: 0.8rem;
            color: var(--text-2);
            margin-top: 2px;
        }
        .role-badge {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }
        .badge-admin  { background: rgba(212,242,74,0.1); color: var(--accent); }
        .badge-member { background: rgba(99,102,241,0.12); color: #818cf8; }
        .badge-guest  { background: rgba(251,191,36,0.1); color: #fbbf24; }

        /* ── Stats bar ── */
        .stats-bar {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 2.5rem 0;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
            margin-bottom: 6rem;
        }
        .stat-cell {
            background: var(--bg);
            padding: 1.5rem 2rem;
            text-align: center;
        }
        .stat-number {
            font-family: var(--font-display);
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-1);
            letter-spacing: -0.03em;
            line-height: 1;
        }
        .stat-number span { color: var(--accent); }
        .stat-label {
            font-size: 0.8rem;
            color: var(--text-2);
            margin-top: 6px;
            letter-spacing: 0.04em;
        }

        /* ── Features ── */
        .section-header {
            margin-bottom: 3.5rem;
        }
        .section-label {
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.75rem;
        }
        .section-title {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text-1);
            line-height: 1.1;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 6rem;
        }
        .feature-cell {
            background: var(--surface);
            padding: 2rem;
            transition: background 0.25s;
        }
        .feature-cell:hover { background: #13151a; }
        .feature-num {
            font-family: var(--font-display);
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-3);
            letter-spacing: 0.08em;
            margin-bottom: 1.25rem;
        }
        .feature-icon {
            width: 36px;
            height: 36px;
            background: rgba(212,242,74,0.08);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .feature-icon svg {
            width: 18px;
            height: 18px;
            stroke: var(--accent);
        }
        .feature-title {
            font-weight: 500;
            font-size: 1rem;
            color: var(--text-1);
            margin-bottom: 0.5rem;
        }
        .feature-desc {
            font-size: 0.875rem;
            color: var(--text-2);
            line-height: 1.6;
        }

        /* ── Task preview strip ── */
        .task-preview {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 6rem;
        }
        .task-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .task-preview-title {
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-2);
        }
        .dot-trio {
            display: flex;
            gap: 5px;
        }
        .dot-trio span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--border);
            display: block;
        }
        .task-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }
        .task-row:last-child { border-bottom: none; }
        .task-check {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid var(--text-3);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .task-check.done {
            background: var(--accent);
            border-color: var(--accent);
        }
        .task-check.done::after {
            content: '';
            display: block;
            width: 9px;
            height: 5px;
            border-left: 1.5px solid #0b0c0e;
            border-bottom: 1.5px solid #0b0c0e;
            transform: rotate(-45deg) translate(1px, -1px);
        }
        .task-name {
            flex: 1;
            font-size: 0.875rem;
            color: var(--text-1);
        }
        .task-name.done-text {
            text-decoration: line-through;
            color: var(--text-3);
        }
        .task-pill {
            font-size: 0.7rem;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .pill-high     { background: rgba(239,68,68,0.12); color: #f87171; }
        .pill-medium   { background: rgba(251,191,36,0.1); color: #fbbf24; }
        .pill-low      { background: rgba(74,222,128,0.1); color: #4ade80; }
        .pill-critical { background: rgba(239,68,68,0.22); color: #f87171; }
        .task-assignee {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(212,242,74,0.12);
            color: var(--accent);
            font-size: 0.65rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .task-due {
            font-size: 0.72rem;
            color: var(--text-3);
            white-space: nowrap;
        }
        .task-due.overdue { color: #f87171; }

        /* ── CTA ── */
        .cta-section {
            text-align: center;
            padding: 5rem 0 8rem;
            position: relative;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212,242,74,0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .cta-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }
        .cta-desc {
            font-size: 1.05rem;
            color: var(--text-2);
            margin-bottom: 2.5rem;
        }

        /* ── Footer ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 2rem 0;
        }
        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .footer-copy {
            font-size: 0.8rem;
            color: var(--text-3);
        }
        .footer-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }
        .footer-links a {
            font-size: 0.8rem;
            color: var(--text-3);
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--text-2); }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; gap: 3rem; padding: 5rem 0 4rem; }
            .hero-visual { display: none; }
            .stats-bar { grid-template-columns: repeat(2, 1fr); }
            .features-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
        @media (max-width: 600px) {
            .stats-bar { grid-template-columns: 1fr 1fr; }
            .footer-inner { flex-direction: column; gap: 1rem; text-align: center; }
        }
    </style>
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
                {{ config('app.name', 'TaskFlow') }}
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
                TaskFlow gives your team a shared view of every task — assigned,
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

    {{-- ========================================================= --}}
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
    </section>

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
                &copy; {{ date('Y') }} {{ config('app.name', 'TaskFlow') }}.
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