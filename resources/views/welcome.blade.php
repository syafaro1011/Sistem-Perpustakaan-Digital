<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital — Sistem Manajemen Perpustakaan Modern</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap"
        rel="stylesheet">
    <style>
        /* ── Reset & Base ─────────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --ink: #0d2b26;
            --teal: #0f9b7a;
            --teal-mid: #0d7a61;
            --teal-lt: #f0fdf9;
            --teal-bd: #d1f5e8;
            --amber: #fbbf24;
            --amber-lt: #fef3c7;
            --white: #ffffff;
            --muted: #64748b;
            --surface: #f8fffe;
            --code-bg: #0a1f1b;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            background: var(--white);
            overflow-x: hidden;
        }

        /* ── NAV ──────────────────────────────────────────────── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(13, 43, 38, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: background .3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            text-decoration: none;
        }

        .nav-logo {
            width: 36px;
            height: 36px;
            background: var(--teal);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .nav-name {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.01em;
        }

        .nav-name span {
            color: var(--amber);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, .65);
            text-decoration: none;
            font-size: .85rem;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: #fff;
        }

        .nav-cta {
            background: var(--teal);
            color: #fff !important;
            padding: .45rem 1.1rem;
            border-radius: 8px;
            font-weight: 600 !important;
            transition: background .2s !important;
        }

        .nav-cta:hover {
            background: var(--teal-mid) !important;
        }

        /* ── HERO ─────────────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            background: var(--ink);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 64px;
        }

        /* Subtle grid pattern */
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(15, 155, 122, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(15, 155, 122, .06) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* Glow blob */
        .hero::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(15, 155, 122, .18) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(15, 155, 122, .15);
            border: 1px solid rgba(15, 155, 122, .3);
            color: #6ee7c7;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 20px;
            margin-bottom: 1.5rem;
        }

        .hero-eyebrow::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--teal);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .5;
                transform: scale(.8);
            }
        }

        .hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(2.4rem, 5vw, 3.8rem);
            font-weight: 900;
            line-height: 1.1;
            color: #fff;
            letter-spacing: -.02em;
            margin-bottom: 1.4rem;
        }

        .hero-title em {
            font-style: normal;
            color: var(--teal);
            position: relative;
        }

        .hero-title em::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--teal);
            opacity: .4;
            border-radius: 2px;
        }

        .hero-desc {
            color: rgba(255, 255, 255, .6);
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 2.2rem;
            max-width: 480px;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--teal);
            color: #fff;
            text-decoration: none;
            padding: .75rem 1.6rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: .95rem;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 16px rgba(15, 155, 122, .3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 155, 122, .4);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            padding: .75rem 1.6rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: .95rem;
            border: 1px solid rgba(255, 255, 255, .12);
            transition: background .2s;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, .1);
        }

        /* ── Buku Animasi ──────────────────────────────────────── */
        .hero-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .book-scene {
            position: relative;
            width: 340px;
            height: 400px;
        }

        /* Card UI mockup */
        .ui-card {
            position: absolute;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 14px;
            backdrop-filter: blur(8px);
            padding: 1rem;
            animation: float 6s ease-in-out infinite;
        }

        .ui-card.main {
            width: 280px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(15, 155, 122, .08);
            border-color: rgba(15, 155, 122, .25);
        }

        .ui-card.sm1 {
            width: 160px;
            right: -20px;
            top: 20px;
            animation-delay: -2s;
            animation-duration: 5s;
        }

        .ui-card.sm2 {
            width: 150px;
            left: -10px;
            bottom: 40px;
            animation-delay: -4s;
            animation-duration: 7s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .ui-card.main {
            animation: floatMain 6s ease-in-out infinite;
        }

        @keyframes floatMain {

            0%,
            100% {
                transform: translate(-50%, -50%) translateY(0);
            }

            50% {
                transform: translate(-50%, -50%) translateY(-8px);
            }
        }

        .card-header-mock {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: .75rem;
            padding-bottom: .6rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot.green {
            background: #4ade80;
        }

        .dot.yellow {
            background: #fbbf24;
        }

        .dot.red {
            background: #f87171;
        }

        .card-title-mock {
            font-size: .72rem;
            color: rgba(255, 255, 255, .4);
            font-family: 'JetBrains Mono', monospace;
            margin-left: auto;
        }

        .book-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .35rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
        }

        .book-row:last-child {
            border-bottom: none;
        }

        .book-cover-mini {
            width: 28px;
            height: 36px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .book-info-mini {
            flex: 1;
            overflow: hidden;
        }

        .book-title-mini {
            font-size: .68rem;
            color: rgba(255, 255, 255, .8);
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .book-author-mini {
            font-size: .6rem;
            color: rgba(255, 255, 255, .4);
            margin-top: 1px;
        }

        .badge-mini {
            font-size: .58rem;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .badge-mini.green {
            background: rgba(74, 222, 128, .15);
            color: #4ade80;
        }

        .badge-mini.red {
            background: rgba(248, 113, 113, .15);
            color: #f87171;
        }

        .badge-mini.amber {
            background: rgba(251, 191, 36, .15);
            color: #fbbf24;
        }

        /* Small cards */
        .stat-row {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .stat-icon-mini {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
        }

        .stat-val-mini {
            font-size: .9rem;
            font-weight: 700;
            color: #fff;
        }

        .stat-lbl-mini {
            font-size: .6rem;
            color: rgba(255, 255, 255, .45);
        }

        /* ── STATS BAR ───────────────────────────────────────── */
        .stats-bar {
            background: var(--teal-lt);
            border-top: 1px solid var(--teal-bd);
            border-bottom: 1px solid var(--teal-bd);
            padding: 1.8rem 2rem;
        }

        .stats-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            text-align: center;
        }

        .stat-item-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--teal);
            line-height: 1;
        }

        .stat-item-lbl {
            font-size: .8rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: .3rem;
        }

        /* ── FITUR ───────────────────────────────────────────── */
        .section {
            padding: 6rem 2rem;
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-eyebrow {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--teal);
            margin-bottom: .75rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -.02em;
            color: var(--ink);
            margin-bottom: 1rem;
        }

        .section-desc {
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 540px;
        }

        /* Feature grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .feature-card {
            background: var(--white);
            border: 1px solid var(--teal-bd);
            border-radius: 14px;
            padding: 1.6rem;
            transition: transform .2s, box-shadow .2s, border-color .2s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), transparent);
            opacity: 0;
            transition: opacity .2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 155, 122, .1);
            border-color: var(--teal);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--teal-lt);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            border: 1px solid var(--teal-bd);
        }

        .feature-title {
            font-weight: 700;
            font-size: .95rem;
            color: var(--ink);
            margin-bottom: .4rem;
        }

        .feature-desc {
            font-size: .83rem;
            color: var(--muted);
            line-height: 1.6;
        }

        .feature-tag {
            display: inline-block;
            margin-top: .75rem;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            background: var(--teal-lt);
            color: var(--teal);
            border: 1px solid var(--teal-bd);
        }

        /* ── MODUL SECTION ───────────────────────────────────── */
        .modules-section {
            background: var(--ink);
            padding: 6rem 2rem;
        }

        .modules-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .modules-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .modules-header .section-eyebrow {
            color: #6ee7c7;
        }

        .modules-header .section-title {
            color: #fff;
        }

        .modules-header .section-desc {
            color: rgba(255, 255, 255, .55);
            margin: 0 auto;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1rem;
        }

        .module-card {
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            padding: 1.4rem 1rem;
            text-align: center;
            transition: background .2s, border-color .2s, transform .2s;
            cursor: default;
        }

        .module-card:hover {
            background: rgba(15, 155, 122, .1);
            border-color: rgba(15, 155, 122, .3);
            transform: translateY(-3px);
        }

        .module-emoji {
            font-size: 1.8rem;
            display: block;
            margin-bottom: .6rem;
        }

        .module-name {
            font-size: .78rem;
            font-weight: 700;
            color: rgba(255, 255, 255, .85);
            line-height: 1.3;
        }

        .module-sub {
            font-size: .67rem;
            color: rgba(255, 255, 255, .35);
            margin-top: .25rem;
        }

        /* ── TECH STACK ─────────────────────────────────────── */
        .tech-section {
            padding: 6rem 2rem;
            background: var(--surface);
        }

        .tech-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .tech-list {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .tech-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: .9rem 1.1rem;
            background: var(--white);
            border: 1px solid var(--teal-bd);
            border-radius: 10px;
            transition: border-color .2s;
        }

        .tech-item:hover {
            border-color: var(--teal);
        }

        .tech-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--teal);
            flex-shrink: 0;
        }

        .tech-name {
            font-weight: 700;
            font-size: .875rem;
            color: var(--ink);
            min-width: 160px;
        }

        .tech-role {
            font-size: .8rem;
            color: var(--muted);
        }

        .tech-badge {
            margin-left: auto;
            font-size: .65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
            background: var(--teal-lt);
            color: var(--teal);
            border: 1px solid var(--teal-bd);
            flex-shrink: 0;
        }

        /* Code window */
        .code-window {
            background: var(--code-bg);
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .06);
            box-shadow: 0 24px 64px rgba(0, 0, 0, .3);
        }

        .code-topbar {
            background: rgba(255, 255, 255, .05);
            padding: .75rem 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
        }

        .code-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .code-dot.r {
            background: #ff5f57;
        }

        .code-dot.y {
            background: #ffbd2e;
        }

        .code-dot.g {
            background: #28c840;
        }

        .code-filename {
            font-family: 'JetBrains Mono', monospace;
            font-size: .72rem;
            color: rgba(255, 255, 255, .35);
            margin-left: .5rem;
        }

        .code-body {
            padding: 1.4rem 1.4rem 1.6rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: .78rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, .7);
            overflow-x: auto;
        }

        .c-comment {
            color: #4ade8066;
        }

        .c-keyword {
            color: #a78bfa;
        }

        .c-fn {
            color: #34d399;
        }

        .c-string {
            color: #fbbf24;
        }

        .c-var {
            color: #7dd3fc;
        }

        .c-num {
            color: #fb923c;
        }

        /* ── ROLE SECTION ───────────────────────────────────── */
        .roles-section {
            padding: 6rem 2rem;
        }

        .roles-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .roles-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .roles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .role-card {
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid var(--teal-bd);
            position: relative;
            overflow: hidden;
        }

        .role-card.admin {
            background: linear-gradient(135deg, #0d2b26 0%, #1a4035 100%);
            border-color: rgba(15, 155, 122, .3);
        }

        .role-card.petugas {
            background: var(--teal-lt);
        }

        .role-badge {
            display: inline-block;
            font-size: .7rem;
            font-weight: 700;
            padding: .3rem .9rem;
            border-radius: 20px;
            margin-bottom: 1.2rem;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .role-card.admin .role-badge {
            background: rgba(251, 191, 36, .15);
            color: var(--amber);
            border: 1px solid rgba(251, 191, 36, .25);
        }

        .role-card.petugas .role-badge {
            background: rgba(15, 155, 122, .15);
            color: var(--teal);
            border: 1px solid var(--teal-bd);
        }

        .role-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 900;
            margin-bottom: .5rem;
        }

        .role-card.admin .role-title {
            color: #fff;
        }

        .role-card.petugas .role-title {
            color: var(--ink);
        }

        .role-desc {
            font-size: .85rem;
            line-height: 1.6;
            margin-bottom: 1.2rem;
        }

        .role-card.admin .role-desc {
            color: rgba(255, 255, 255, .55);
        }

        .role-card.petugas .role-desc {
            color: var(--muted);
        }

        .role-perms {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .45rem;
        }

        .role-perms li {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .83rem;
            font-weight: 500;
        }

        .role-card.admin .role-perms li {
            color: rgba(255, 255, 255, .75);
        }

        .role-card.petugas .role-perms li {
            color: var(--ink);
        }

        .perm-check {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .65rem;
            flex-shrink: 0;
        }

        .role-card.admin .perm-check {
            background: rgba(15, 155, 122, .25);
            color: #6ee7c7;
        }

        .role-card.petugas .perm-check {
            background: var(--teal-lt);
            color: var(--teal);
            border: 1px solid var(--teal-bd);
        }

        /* ── CTA SECTION ─────────────────────────────────────── */
        .cta-section {
            background: linear-gradient(135deg, var(--ink) 0%, #0d4035 100%);
            padding: 6rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(15, 155, 122, .05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(15, 155, 122, .05) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .cta-inner {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -.02em;
            margin-bottom: 1rem;
        }

        .cta-title em {
            font-style: normal;
            color: var(--amber);
        }

        .cta-desc {
            color: rgba(255, 255, 255, .55);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 2.2rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-amber {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--amber);
            color: var(--ink);
            text-decoration: none;
            padding: .85rem 2rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 1rem;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 20px rgba(251, 191, 36, .3);
        }

        .btn-amber:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(251, 191, 36, .4);
        }

        /* ── FOOTER ─────────────────────────────────────────── */
        footer {
            background: #080f0e;
            padding: 2.5rem 2rem;
            border-top: 1px solid rgba(255, 255, 255, .05);
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .footer-logo {
            width: 28px;
            height: 28px;
            background: var(--teal);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
        }

        .footer-name {
            font-size: .85rem;
            font-weight: 700;
            color: rgba(255, 255, 255, .7);
        }

        .footer-copy {
            font-size: .78rem;
            color: rgba(255, 255, 255, .3);
        }

        .footer-stack {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .footer-tag {
            font-size: .68rem;
            padding: 2px 8px;
            border-radius: 4px;
            background: rgba(255, 255, 255, .05);
            color: rgba(255, 255, 255, .35);
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 900px) {
            .hero-inner {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero-desc {
                margin: 0 auto 2.2rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .book-scene {
                width: 280px;
                height: 320px;
            }

            .ui-card.sm1,
            .ui-card.sm2 {
                display: none;
            }

            .stats-bar-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid {
                grid-template-columns: 1fr 1fr;
            }

            .modules-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .tech-inner {
                grid-template-columns: 1fr;
            }

            .roles-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-bar-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .section {
                padding: 4rem 1.2rem;
            }

            .modules-section {
                padding: 4rem 1.2rem;
            }

            .tech-section {
                padding: 4rem 1.2rem;
            }

            .roles-section {
                padding: 4rem 1.2rem;
            }

            .cta-section {
                padding: 4rem 1.2rem;
            }
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: .1s;
        }

        .reveal-delay-2 {
            transition-delay: .2s;
        }

        .reveal-delay-3 {
            transition-delay: .3s;
        }

        .reveal-delay-4 {
            transition-delay: .4s;
        }

        .reveal-delay-5 {
            transition-delay: .5s;
        }

        @media (prefers-reduced-motion: reduce) {

            .reveal,
            .ui-card,
            .hero::after,
            .hero-eyebrow::before {
                animation: none !important;
                transition: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
</head>

<body>

    <!-- ── NAV ──────────────────────────────────────────────── -->
    <nav>
        <a href="#" class="nav-brand">
            <div class="nav-logo">📚</div>
            <span class="nav-name">Pustaka<span>Digital</span></span>
        </a>
        <ul class="nav-links">
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#modul">Modul</a></li>
            <li><a href="#teknologi">Teknologi</a></li>
            <li><a href="#role">Role</a></li>
            <li><a href="{{ route('login') }}" class="nav-cta">Masuk Sistem →</a></li>
        </ul>
    </nav>

    <!-- ── HERO ─────────────────────────────────────────────── -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-eyebrow">Sistem Informasi Perpustakaan</div>
                <h1 class="hero-title">
                    Kelola perpustakaan Anda secara <em>digital</em> dan efisien
                </h1>
                <p class="hero-desc">
                    Platform manajemen perpustakaan modern berbasis Laravel 13. Dari pencatatan buku hingga
                    laporan denda — semua dalam satu sistem yang rapi, cepat, dan mudah digunakan.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn-primary">
                        🚀 Masuk ke Sistem
                    </a>
                    <a href="#fitur" class="btn-secondary">
                        Lihat Fitur ↓
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="book-scene">

                    <!-- Main card: daftar buku -->
                    <div class="ui-card main">
                        <div class="card-header-mock">
                            <div class="dot green"></div>
                            <div class="dot yellow"></div>
                            <div class="dot red"></div>
                            <span class="card-title-mock">/ buku</span>
                        </div>
                        <div class="book-row">
                            <div class="book-cover-mini" style="background:linear-gradient(135deg,#0f9b7a,#065f46);">
                            </div>
                            <div class="book-info-mini">
                                <div class="book-title-mini">Bumi Manusia</div>
                                <div class="book-author-mini">Pramoedya Ananta Toer</div>
                            </div>
                            <span class="badge-mini green">Tersedia</span>
                        </div>
                        <div class="book-row">
                            <div class="book-cover-mini" style="background:linear-gradient(135deg,#7c3aed,#4c1d95);">
                            </div>
                            <div class="book-info-mini">
                                <div class="book-title-mini">Sapiens</div>
                                <div class="book-author-mini">Yuval Noah Harari</div>
                            </div>
                            <span class="badge-mini red">Dipinjam</span>
                        </div>
                        <div class="book-row">
                            <div class="book-cover-mini" style="background:linear-gradient(135deg,#d97706,#92400e);">
                            </div>
                            <div class="book-info-mini">
                                <div class="book-title-mini">Laskar Pelangi</div>
                                <div class="book-author-mini">Andrea Hirata</div>
                            </div>
                            <span class="badge-mini green">Tersedia</span>
                        </div>
                        <div class="book-row">
                            <div class="book-cover-mini" style="background:linear-gradient(135deg,#e11d48,#9f1239);">
                            </div>
                            <div class="book-info-mini">
                                <div class="book-title-mini">Perahu Kertas</div>
                                <div class="book-author-mini">Dewi Lestari</div>
                            </div>
                            <span class="badge-mini amber">Terlambat</span>
                        </div>
                    </div>

                    <!-- Card kecil: stat anggota -->
                    <div class="ui-card sm1">
                        <div
                            style="font-size:.62rem;color:rgba(255,255,255,.35);margin-bottom:.5rem;font-family:'JetBrains Mono',monospace;">
                            total anggota</div>
                        <div style="font-size:1.6rem;font-weight:900;color:#fff;font-family:'Playfair Display',serif;">
                            248</div>
                        <div style="font-size:.65rem;color:#4ade80;font-weight:600;margin-top:.2rem;">↑ 12 bulan ini
                        </div>
                    </div>

                    <!-- Card kecil: denda -->
                    <div class="ui-card sm2">
                        <div
                            style="font-size:.62rem;color:rgba(255,255,255,.35);margin-bottom:.5rem;font-family:'JetBrains Mono',monospace;">
                            denda hari ini</div>
                        <div
                            style="font-size:1.1rem;font-weight:900;color:#fbbf24;font-family:'Playfair Display',serif;">
                            Rp 48.000</div>
                        <div style="font-size:.65rem;color:rgba(255,255,255,.3);margin-top:.2rem;">4 transaksi</div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ── STATS BAR ─────────────────────────────────────────── -->
    <div class="stats-bar">
        <div class="stats-bar-inner">
            <div class="reveal">
                <div class="stat-item-num">6</div>
                <div class="stat-item-lbl">Modul CRUD Lengkap</div>
            </div>
            <div class="reveal reveal-delay-1">
                <div class="stat-item-num">2</div>
                <div class="stat-item-lbl">Role Pengguna</div>
            </div>
            <div class="reveal reveal-delay-2">
                <div class="stat-item-num">8</div>
                <div class="stat-item-lbl">Tabel Database</div>
            </div>
            <div class="reveal reveal-delay-3">
                <div class="stat-item-num">100%</div>
                <div class="stat-item-lbl">Berbasis Laravel 13</div>
            </div>
        </div>
    </div>

    <!-- ── FITUR ─────────────────────────────────────────────── -->
    <section class="section" id="fitur">
        <div class="section-inner">
            <div class="reveal">
                <div class="section-eyebrow">Fitur Unggulan</div>
                <h2 class="section-title">Semua yang dibutuhkan<br>perpustakaan modern</h2>
                <p class="section-desc">Dibangun dengan fitur lengkap sesuai standar sistem informasi perpustakaan
                    digital yang profesional.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal reveal-delay-1">
                    <div class="feature-icon">🔐</div>
                    <div class="feature-title">Autentikasi Multi-Role</div>
                    <div class="feature-desc">Sistem login dengan dua peran berbeda — Admin dan Petugas — dengan hak
                        akses yang terpisah dan terkontrol menggunakan middleware Laravel.</div>
                    <span class="feature-tag">Laravel Breeze</span>
                </div>
                <div class="feature-card reveal reveal-delay-2">
                    <div class="feature-icon">📊</div>
                    <div class="feature-title">Dashboard Statistik</div>
                    <div class="feature-desc">Tampilan ringkasan data real-time: total buku, anggota aktif, peminjaman
                        berjalan, denda belum lunas, dan grafik interaktif berbasis Chart.js.</div>
                    <span class="feature-tag">Chart.js</span>
                </div>
                <div class="feature-card reveal reveal-delay-3">
                    <div class="feature-icon">📤</div>
                    <div class="feature-title">Export Excel & PDF</div>
                    <div class="feature-desc">Ekspor data buku, anggota, peminjaman, dan denda ke format Excel (.xlsx)
                        maupun PDF dengan tampilan yang rapi dan profesional.</div>
                    <span class="feature-tag">Maatwebsite · DomPDF</span>
                </div>
                <div class="feature-card reveal reveal-delay-1">
                    <div class="feature-icon">🧮</div>
                    <div class="feature-title">Hitung Denda Otomatis</div>
                    <div class="feature-desc">Sistem menghitung denda keterlambatan secara otomatis (Rp 2.000/hari) saat
                        pengembalian dicatat, ditambah denda kondisi buku rusak atau hilang.</div>
                    <span class="feature-tag">Business Logic</span>
                </div>
                <div class="feature-card reveal reveal-delay-2">
                    <div class="feature-icon">🕵️</div>
                    <div class="feature-title">Activity Log</div>
                    <div class="feature-desc">Setiap aksi CRUD tercatat otomatis dalam log aktivitas. Admin dapat
                        memfilter berdasarkan modul, event, pengguna, dan rentang tanggal.</div>
                    <span class="feature-tag">Spatie Activity Log</span>
                </div>
                <div class="feature-card reveal reveal-delay-3">
                    <div class="feature-icon">🔍</div>
                    <div class="feature-title">Search & Pagination</div>
                    <div class="feature-desc">Fitur pencarian real-time di semua modul utama dengan pagination Bootstrap
                        5 yang mempertahankan parameter pencarian antar halaman.</div>
                    <span class="feature-tag">Eloquent Query</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ── MODUL ─────────────────────────────────────────────── -->
    <section class="modules-section" id="modul">
        <div class="modules-inner">
            <div class="modules-header reveal">
                <div class="section-eyebrow">Modul Sistem</div>
                <h2 class="section-title">6 Modul yang saling terintegrasi</h2>
                <p class="section-desc">Setiap modul terhubung satu sama lain membentuk alur bisnis perpustakaan yang
                    lengkap dan konsisten.</p>
            </div>

            <div class="modules-grid">
                <div class="module-card reveal reveal-delay-1">
                    <span class="module-emoji">📚</span>
                    <div class="module-name">Data Buku</div>
                    <div class="module-sub">CRUD · Upload Cover · Kategori</div>
                </div>
                <div class="module-card reveal reveal-delay-2">
                    <span class="module-emoji">🏷️</span>
                    <div class="module-name">Kategori Buku</div>
                    <div class="module-sub">Admin Only · Many-to-Many</div>
                </div>
                <div class="module-card reveal reveal-delay-3">
                    <span class="module-emoji">👥</span>
                    <div class="module-name">Anggota</div>
                    <div class="module-sub">CRUD · Status Aktif · Search</div>
                </div>
                <div class="module-card reveal reveal-delay-4">
                    <span class="module-emoji">🔄</span>
                    <div class="module-name">Peminjaman</div>
                    <div class="module-sub">Stok Otomatis · Filter Status</div>
                </div>
                <div class="module-card reveal reveal-delay-5">
                    <span class="module-emoji">↩️</span>
                    <div class="module-name">Pengembalian</div>
                    <div class="module-sub">Denda Otomatis · Kondisi Buku</div>
                </div>
                <div class="module-card reveal reveal-delay-1">
                    <span class="module-emoji">💰</span>
                    <div class="module-name">Denda</div>
                    <div class="module-sub">Bayar · Lunas · Riwayat</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TEKNOLOGI ──────────────────────────────────────────── -->
    <section class="tech-section" id="teknologi">
        <div class="tech-inner">
            <div>
                <div class="reveal">
                    <div class="section-eyebrow">Tech Stack</div>
                    <h2 class="section-title">Dibangun dengan teknologi terpercaya</h2>
                    <p class="section-desc">Kombinasi framework modern yang saling melengkapi untuk menghasilkan sistem
                        yang handal dan mudah dikembangkan.</p>
                </div>
                <div class="tech-list">
                    <div class="tech-item reveal reveal-delay-1">
                        <div class="tech-dot"></div>
                        <span class="tech-name">Laravel 13</span>
                        <span class="tech-role">PHP Framework Utama</span>
                        <span class="tech-badge">Backend</span>
                    </div>
                    <div class="tech-item reveal reveal-delay-2">
                        <div class="tech-dot"></div>
                        <span class="tech-name">Bootstrap 5</span>
                        <span class="tech-role">UI Framework & Komponen</span>
                        <span class="tech-badge">Frontend</span>
                    </div>
                    <div class="tech-item reveal reveal-delay-3">
                        <div class="tech-dot"></div>
                        <span class="tech-name">MySQL</span>
                        <span class="tech-role">Database Relasional</span>
                        <span class="tech-badge">Database</span>
                    </div>
                    <div class="tech-item reveal reveal-delay-4">
                        <div class="tech-dot"></div>
                        <span class="tech-name">Spatie Activity Log</span>
                        <span class="tech-role">Pencatatan Aktivitas</span>
                        <span class="tech-badge">Package</span>
                    </div>
                    <div class="tech-item reveal reveal-delay-5">
                        <div class="tech-dot"></div>
                        <span class="tech-name">Maatwebsite Excel</span>
                        <span class="tech-role">Export ke format .xlsx</span>
                        <span class="tech-badge">Package</span>
                    </div>
                    <div class="tech-item reveal reveal-delay-1">
                        <div class="tech-dot"></div>
                        <span class="tech-name">Chart.js 4</span>
                        <span class="tech-role">Grafik Dashboard Interaktif</span>
                        <span class="tech-badge">Frontend</span>
                    </div>
                </div>
            </div>

            <!-- Code window -->
            <div class="code-window reveal reveal-delay-2">
                <div class="code-topbar">
                    <div class="code-dot r"></div>
                    <div class="code-dot y"></div>
                    <div class="code-dot g"></div>
                    <span class="code-filename">PengembalianController.php</span>
                </div>
                <div class="code-body">
                    <span class="c-comment">// Hitung denda otomatis</span>
                    <span class="c-keyword">$hariTerlambat</span> = max(<span class="c-num">0</span>,
                    now()->parse(<span class="c-var">$request</span>->tanggal_kembali_aktual)
                    ->diffInDays(<span class="c-var">$peminjaman</span>->tanggal_kembali,
                    <span class="c-keyword">false</span>) * -<span class="c-num">1</span>
                    );

                    <span class="c-keyword">$jumlahDenda</span> = <span class="c-var">$hariTerlambat</span>
                    * self::<span class="c-fn">DENDA_PER_HARI</span>;

                    <span class="c-keyword">if</span> (<span class="c-var">$request</span>->kondisi_buku === <span
                        class="c-string">'rusak'</span>)
                    <span class="c-keyword">$jumlahDenda</span> += <span class="c-num">50000</span>;

                    <span class="c-keyword">if</span> (<span class="c-var">$request</span>->kondisi_buku === <span
                        class="c-string">'hilang'</span>)
                    <span class="c-keyword">$jumlahDenda</span> += <span class="c-num">200000</span>;

                    <span class="c-comment">// Buat denda otomatis</span>
                    <span class="c-keyword">if</span> (<span class="c-var">$jumlahDenda</span> > <span
                        class="c-num">0</span>) {
                    <span class="c-fn">Denda</span>::<span class="c-fn">create</span>([
                    <span class="c-string">'jumlah_denda'</span> => <span class="c-var">$jumlahDenda</span>,
                    <span class="c-string">'status_bayar'</span> => <span class="c-string">'belum_bayar'</span>,
                    ]);
                    }
                </div>
            </div>
        </div>
    </section>

    <!-- ── ROLE ───────────────────────────────────────────────── -->
    <section class="roles-section" id="role">
        <div class="roles-inner">
            <div class="roles-header reveal">
                <div class="section-eyebrow">Manajemen Akses</div>
                <h2 class="section-title">Dua role, satu sistem</h2>
                <p class="section-desc" style="margin:0 auto;">Hak akses yang terdefinisi jelas antara Admin dan Petugas
                    untuk menjaga keamanan dan konsistensi data.</p>
            </div>

            <div class="roles-grid">
                <div class="role-card admin reveal reveal-delay-1">
                    <div class="role-badge">👑 Admin</div>
                    <h3 class="role-title">Administrator</h3>
                    <p class="role-desc">Akses penuh ke seluruh sistem termasuk manajemen kategori, pengawasan activity
                        log, dan seluruh fitur operasional.</p>
                    <ul class="role-perms">
                        <li>
                            <div class="perm-check">✓</div>Kelola Kategori Buku
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Lihat Activity Log Sistem
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Hapus & Reset Log
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Akses Semua Modul Sirkulasi
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Export Data (Excel & PDF)
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Dashboard Statistik Penuh
                        </li>
                    </ul>
                </div>

                <div class="role-card petugas reveal reveal-delay-2">
                    <div class="role-badge">🗂️ Petugas</div>
                    <h3 class="role-title">Petugas Perpustakaan</h3>
                    <p class="role-desc">Akses ke semua modul operasional harian perpustakaan, dari koleksi buku hingga
                        pencatatan transaksi.</p>
                    <ul class="role-perms">
                        <li>
                            <div class="perm-check">✓</div>Kelola Data Buku
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Kelola Data Anggota
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Catat Peminjaman
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Catat Pengembalian
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Proses Pembayaran Denda
                        </li>
                        <li>
                            <div class="perm-check">✓</div>Export Data
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ────────────────────────────────────────────────── -->
    <section class="cta-section" id="login">
        <div class="cta-inner">
            <div class="reveal">
                <h2 class="cta-title">Siap mengelola perpustakaan<br>dengan cara <em>modern?</em></h2>
                <p class="cta-desc">Masuk ke sistem dan mulai kelola koleksi buku, anggota, dan transaksi perpustakaan
                    dalam satu platform yang terintegrasi.</p>
                <div class="cta-buttons">
                    {{-- Tombol Masuk --}}
                    <a href="{{ route('login') }}" class="btn-amber">
                        🚀 Masuk ke Sistem
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ──────────────────────────────────────────────── -->
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-logo">📚</div>
                <span class="footer-name">PustakaDigital</span>
            </div>
            <span class="footer-copy">Sistem Perpustakaan Digital · Tugas Besar UAS · Pemrograman Web 2</span>
            <div class="footer-stack">
                <span class="footer-tag">Laravel 13</span>
                <span class="footer-tag">Bootstrap 5</span>
                <span class="footer-tag">MySQL</span>
            </div>
            <div class="cta-buttons">
                <a href="https://github.com/syafaro1011/Sistem-Perpustakaan-Digital" class="btn-amber" target="_blank"
                    rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:.45rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 0C5.37 0 0 5.373 0 12c0 5.303 3.438 9.8 8.205 11.387.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222 0 1.606-.015 2.896-.015 3.286 0 .315.216.69.825.574C20.565 21.796 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                    </svg>
                    GitHub
                </a>
            </div>
        </div>
    </footer>

    <script>
        // ── Scroll Reveal ─────────────────────────────────────────
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // ── Nav scroll effect ─────────────────────────────────────
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 80) {
                nav.style.background = 'rgba(13,43,38,0.98)';
            } else {
                nav.style.background = 'rgba(13,43,38,0.92)';
            }
        });

        // ── Counter animation ─────────────────────────────────────
        const statNums = document.querySelectorAll('.stat-item-num');
        const statObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const el = e.target;
                    const target = el.textContent;
                    const num = parseFloat(target.replace('%', ''));
                    if (!isNaN(num)) {
                        let start = 0;
                        const step = num / 40;
                        const timer = setInterval(() => {
                            start += step;
                            if (start >= num) {
                                el.textContent = target;
                                clearInterval(timer);
                            } else {
                                el.textContent = target.includes('%')
                                    ? Math.floor(start) + '%'
                                    : Math.floor(start);
                            }
                        }, 30);
                    }
                    statObs.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        statNums.forEach(el => statObs.observe(el));
    </script>
</body>

</html>