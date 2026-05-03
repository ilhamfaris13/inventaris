<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') — Inventaris Lab CBT FK UHT</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ══════════════════════════════════════════════════════
       DESIGN TOKENS — Lab CBT FK UHT
       Tema: Biru (sesuai logo Universitas Hang Tuah)
    ══════════════════════════════════════════════════════ */
    :root {
      --blue-dark:    #0A3D6B;
      --blue-main:    #1565A8;
      --blue-mid:     #1976D2;
      --blue-light:   #64B5F6;
      --blue-pale:    #E3F2FD;
      --gold:         #D4A017;
      --gold-light:   #F5D76E;
      --red-accent:   #C0392B;
      --green:        #2E7D32;

      --bg-body:      #EFF4FA;
      --bg-sidebar:   #0A3D6B;
      --bg-card:      #FFFFFF;
      --text-main:    #1E293B;
      --text-muted:   #64748B;
      --border:       #DBEAFE;
      --border-soft:  #E2E8F0;

      --success:      #1B5E37;
      --warning:      #B45309;
      --danger:       #991B1B;
      --info:         #0E6FAB;

      --sidebar-w:    262px;
      --topbar-h:     58px;
      --radius:       10px;
      --radius-sm:    7px;
      --shadow:       0 2px 12px rgba(10,61,107,0.08);
      --shadow-md:    0 4px 24px rgba(10,61,107,0.13);
      --font:         'Plus Jakarta Sans', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: var(--font) !important;
      background-color: var(--bg-body) !important;
      color: var(--text-main) !important;
      font-size: 14px;
    }

    /* ══ SIDEBAR ═══════════════════════════════════════════ */
    .main-sidebar {
      background: linear-gradient(180deg, #0A3D6B 0%, #0D4880 60%, #0F5298 100%) !important;
      width: var(--sidebar-w) !important;
      box-shadow: 3px 0 20px rgba(0,0,0,0.2) !important;
    }

    /* Brand */
    .brand-link {
      background: rgba(0,0,0,0.25) !important;
      border-bottom: 1px solid rgba(255,255,255,0.08) !important;
      padding: 10px 14px !important;
      height: var(--topbar-h);
      display: flex !important;
      align-items: center !important;
      gap: 10px;
      text-decoration: none !important;
    }
    .brand-link:hover { background: rgba(0,0,0,0.35) !important; }

    .brand-logo-img {
      width: 38px; height: 38px;
      border-radius: 50%;
      border: 2px solid rgba(245,215,110,0.5);
      object-fit: contain;
      background: rgba(255,255,255,0.1);
      flex-shrink: 0;
    }

    .brand-text-wrap { display: flex; flex-direction: column; min-width: 0; }
    .brand-name {
      font-size: 13px !important;
      font-weight: 800 !important;
      color: #fff !important;
      line-height: 1.2;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .brand-sub {
      font-size: 10px !important;
      font-weight: 400 !important;
      color: rgba(255,255,255,0.5) !important;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    /* User panel */
    .user-panel {
      border-bottom: 1px solid rgba(255,255,255,0.07) !important;
      padding: 12px 14px !important;
      margin: 0 !important;
    }
    .user-panel .image img {
      width: 34px !important; height: 34px !important;
      border: 2px solid rgba(245,215,110,0.4) !important;
      border-radius: 50% !important;
    }
    .user-panel .info a {
      color: #fff !important; font-size: 12.5px !important; font-weight: 600 !important;
    }
    .user-panel .info p {
      color: rgba(255,255,255,0.4) !important; font-size: 10.5px !important; margin: 0 !important;
    }

    /* Nav section header */
    .nav-sidebar .nav-header {
      color: rgba(255,255,255,0.28) !important;
      font-size: 9.5px !important;
      font-weight: 700 !important;
      letter-spacing: 0.14em !important;
      text-transform: uppercase !important;
      padding: 14px 16px 5px !important;
    }

    /* Nav item wrapper */
    .nav-sidebar .nav-item { margin: 1px 7px; }

    /* Nav link */
    .nav-sidebar .nav-link {
      color: rgba(255,255,255,0.58) !important;
      border-radius: var(--radius-sm) !important;
      padding: 8px 11px !important;
      font-size: 12.5px !important;
      font-weight: 500 !important;
      display: flex !important;
      align-items: center !important;
      gap: 9px !important;
      transition: all 0.16s ease !important;
    }
    .nav-sidebar .nav-link:hover {
      background: rgba(255,255,255,0.08) !important;
      color: #fff !important;
    }
    .nav-sidebar .nav-link.active,
    .nav-sidebar .nav-item.menu-open > .nav-link {
      background: linear-gradient(135deg, rgba(255,255,255,0.18), rgba(255,255,255,0.10)) !important;
      color: #fff !important;
      border-left: 3px solid var(--gold-light) !important;
      padding-left: 8px !important;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2) !important;
    }
    .nav-sidebar .nav-link .nav-icon {
      width: 18px !important; font-size: 13px !important;
      margin: 0 !important; text-align: center !important;
      color: inherit !important; flex-shrink: 0 !important;
    }
    .nav-sidebar .nav-link p {
      margin: 0 !important; flex: 1 !important; font-family: var(--font) !important;
    }
    .nav-sidebar .nav-link > p > .right {
      margin-left: auto !important; transition: transform 0.2s !important;
    }
    .nav-sidebar .nav-item.menu-open > .nav-link > p > .right {
      transform: rotate(-90deg) !important;
    }

    /* Submenu */
    .nav-treeview {
      background: rgba(0,0,0,0.15) !important;
      border-radius: var(--radius-sm);
      margin: 2px 0 4px;
    }
    .nav-treeview .nav-item { margin: 1px 4px !important; }
    .nav-treeview .nav-link {
      padding: 7px 11px 7px 28px !important;
      font-size: 12px !important;
      color: rgba(255,255,255,0.48) !important;
    }
    .nav-treeview .nav-link:hover {
      color: rgba(255,255,255,0.85) !important;
      background: rgba(255,255,255,0.06) !important;
    }
    .nav-treeview .nav-link.active {
      background: rgba(212,160,23,0.18) !important;
      color: var(--gold-light) !important;
      border-left: 3px solid var(--gold-light) !important;
      box-shadow: none !important;
    }
    .nav-treeview .nav-link .nav-icon { font-size: 5px !important; }

    /* Badge di nav */
    .nav-sidebar .badge { font-size: 9px !important; padding: 2px 6px !important; border-radius: 20px !important; }

    /* Scrollbar sidebar */
    .sidebar { scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.1) transparent; }
    .sidebar::-webkit-scrollbar { width: 3px; }
    .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }

    /* ══ TOPBAR ════════════════════════════════════════════ */
    .main-header.navbar {
      background: #fff !important;
      border-bottom: 1px solid var(--border-soft) !important;
      box-shadow: var(--shadow) !important;
      height: var(--topbar-h) !important;
      padding: 0 18px !important;
      min-height: var(--topbar-h) !important;
    }
    .main-header .navbar-nav .nav-link {
      color: var(--text-muted) !important;
      font-size: 13px !important;
      padding: 0 10px !important;
      height: var(--topbar-h) !important;
      display: flex !important; align-items: center !important;
    }
    .main-header .navbar-nav .nav-link:hover { color: var(--blue-main) !important; }

    /* Topbar user */
    .topbar-user {
      display: flex; align-items: center; gap: 8px;
      color: var(--text-main); font-size: 13px; font-weight: 600;
    }
    .topbar-user img { width: 30px; height: 30px; border-radius: 50%; border: 2px solid var(--border); }

    /* Logout btn */
    .btn-logout {
      display: flex; align-items: center; gap: 6px;
      background: none; border: 1.5px solid var(--border-soft);
      border-radius: var(--radius-sm); padding: 5px 12px;
      color: var(--text-muted); font-size: 12px; font-weight: 600;
      cursor: pointer; transition: all 0.15s; font-family: var(--font);
    }
    .btn-logout:hover { border-color: var(--blue-main); color: var(--blue-main); background: var(--blue-pale); }

    /* Notif dropdown */
    .notif-dropdown {
      min-width: 280px;
      border-radius: var(--radius) !important;
      border: 1px solid var(--border-soft) !important;
      box-shadow: var(--shadow-md) !important;
      padding: 0 !important;
      overflow: hidden;
    }
    .notif-header {
      padding: 10px 14px;
      border-bottom: 1px solid var(--border-soft);
      background: var(--blue-pale);
      font-size: 12px; font-weight: 700; color: var(--blue-main);
    }
    .notif-footer {
      border-top: 1px solid var(--border-soft);
      padding: 7px 14px;
    }
    .notif-footer a { font-size: 12px; color: var(--blue-main); font-weight: 600; text-decoration: none; }

    /* ══ CONTENT ═══════════════════════════════════════════ */
    .content-wrapper {
      background-color: var(--bg-body) !important;
      margin-left: var(--sidebar-w) !important;
    }

    .content-header { padding: 18px 22px 0 !important; }
    .content-header h1, .page-title {
      font-family: var(--font) !important; font-weight: 700 !important;
      color: var(--text-main) !important; font-size: 1.25rem !important; margin: 0 !important;
    }
    .breadcrumb {
      background: transparent !important; padding: 0 !important;
      margin: 3px 0 0 !important; font-size: 12px !important;
    }
    .breadcrumb-item a { color: var(--blue-main) !important; }
    .breadcrumb-item.active { color: var(--text-muted) !important; }
    .breadcrumb-item + .breadcrumb-item::before { color: var(--border) !important; }

    .content { padding: 14px 22px 24px !important; }

    /* ══ CARDS ═════════════════════════════════════════════ */
    .card {
      border: 1px solid var(--border-soft) !important;
      border-radius: var(--radius) !important;
      box-shadow: var(--shadow) !important;
      background: var(--bg-card) !important;
      font-family: var(--font) !important;
    }
    .card-header {
      background: transparent !important;
      border-bottom: 1px solid var(--border-soft) !important;
      padding: 13px 16px !important;
      font-weight: 600 !important; font-size: 13.5px !important;
    }
    .card-body { padding: 16px !important; }
    .card-footer { background: #FAFBFE !important; border-top: 1px solid var(--border-soft) !important; }

    /* Stat Cards */
    .stat-card {
      border: none !important; border-radius: var(--radius) !important;
      position: relative; overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md) !important; }
    .stat-card .card-body { padding: 18px 20px !important; }
    .stat-card .stat-icon {
      position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
      font-size: 44px; opacity: 0.13;
    }
    .stat-card.blue    { background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid)) !important; }
    .stat-card.success { background: linear-gradient(135deg, #1B5E37, #2E7D32) !important; }
    .stat-card.warning { background: linear-gradient(135deg, #854D0E, var(--warning)) !important; }
    .stat-card.danger  { background: linear-gradient(135deg, #7F1D1D, var(--danger)) !important; }
    .stat-card.gold    { background: linear-gradient(135deg, #92400E, var(--gold)) !important; }
    .stat-card * { color: #fff !important; }
    .stat-label  { font-size: 10.5px; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; opacity: 0.78; }
    .stat-value  { font-size: 2rem; font-weight: 800; line-height: 1.2; margin: 3px 0; }
    .stat-sub    { font-size: 11.5px; opacity: 0.72; }

    /* ══ TABLE ══════════════════════════════════════════════ */
    .table { font-family: var(--font) !important; font-size: 13px !important; color: var(--text-main) !important; }
    .table thead th {
      background: #F0F6FF !important;
      color: var(--text-muted) !important;
      font-size: 10.5px !important; font-weight: 700 !important;
      letter-spacing: 0.08em !important; text-transform: uppercase !important;
      border-bottom: 1px solid var(--border) !important;
      padding: 9px 13px !important;
    }
    .table td { padding: 10px 13px !important; border-color: var(--border-soft) !important; vertical-align: middle !important; }
    .table tbody tr:hover { background: rgba(21,101,168,0.03) !important; }

    /* ══ BADGES ════════════════════════════════════════════ */
    .badge {
      font-family: var(--font) !important; font-size: 10.5px !important;
      font-weight: 700 !important; padding: 3px 8px !important;
      border-radius: 20px !important; letter-spacing: 0.02em;
    }
    .badge-success   { background: #D1FAE5 !important; color: #065F46 !important; }
    .badge-danger    { background: #FEE2E2 !important; color: #991B1B !important; }
    .badge-warning   { background: #FEF3C7 !important; color: #92400E !important; }
    .badge-info      { background: #DBEAFE !important; color: #1E40AF !important; }
    .badge-primary   { background: #DBEAFE !important; color: var(--blue-main) !important; }
    .badge-secondary { background: #F1F5F9 !important; color: #475569 !important; }

    /* ══ BUTTONS ═══════════════════════════════════════════ */
    .btn {
      font-family: var(--font) !important; font-size: 12.5px !important;
      font-weight: 600 !important; border-radius: var(--radius-sm) !important;
      transition: all 0.16s !important;
    }
    .btn-primary { background: var(--blue-main) !important; border-color: var(--blue-main) !important; color: #fff !important; }
    .btn-primary:hover { background: var(--blue-dark) !important; border-color: var(--blue-dark) !important; box-shadow: 0 3px 10px rgba(21,101,168,0.35) !important; }
    .btn-warning { background: var(--warning) !important; border-color: var(--warning) !important; color: #fff !important; }
    .btn-success { background: var(--success) !important; border-color: var(--success) !important; color: #fff !important; }
    .btn-danger  { background: var(--danger) !important;  border-color: var(--danger) !important;  color: #fff !important; }
    .btn-outline-secondary { border-color: var(--border-soft) !important; color: var(--text-muted) !important; }
    .btn-outline-secondary:hover { background: var(--bg-body) !important; color: var(--blue-main) !important; border-color: var(--blue-light) !important; }

    /* ══ FORMS ══════════════════════════════════════════════ */
    .form-control, .custom-select {
      font-family: var(--font) !important; font-size: 13px !important;
      border: 1.5px solid var(--border-soft) !important;
      border-radius: var(--radius-sm) !important; color: var(--text-main) !important;
      transition: all 0.15s !important;
    }
    .form-control:focus, .custom-select:focus {
      border-color: var(--blue-main) !important;
      box-shadow: 0 0 0 3px rgba(21,101,168,0.1) !important;
    }
    label { font-weight: 600 !important; font-size: 12px !important; color: var(--text-muted) !important; margin-bottom: 4px !important; }

    /* ══ ALERTS ════════════════════════════════════════════ */
    .alert { font-family: var(--font) !important; font-size: 13px !important; border-radius: var(--radius) !important; border: none !important; padding: 11px 15px !important; }
    .alert-success { background: #D1FAE5 !important; color: #065F46 !important; }
    .alert-danger  { background: #FEE2E2 !important; color: #991B1B !important; }
    .alert-warning { background: #FEF3C7 !important; color: #92400E !important; }
    .alert-info    { background: #DBEAFE !important; color: #1E40AF !important; }

    /* ══ PAGINATION ════════════════════════════════════════ */
    .pagination .page-link { font-family: var(--font) !important; font-size: 12px !important; color: var(--blue-main) !important; border-color: var(--border-soft) !important; }
    .pagination .page-item.active .page-link { background: var(--blue-main) !important; border-color: var(--blue-main) !important; color: #fff !important; }

    /* ══ FOOTER ════════════════════════════════════════════ */
    .main-footer {
      background: #fff !important;
      border-top: 1px solid var(--border-soft) !important;
      color: var(--text-muted) !important;
      font-family: var(--font) !important; font-size: 11.5px !important;
      padding: 11px 22px !important;
      margin-left: var(--sidebar-w) !important;
    }
    .main-footer a { color: var(--blue-main) !important; }

    /* ══ PRINT ══════════════════════════════════════════════ */
    @media print {
      .main-sidebar, .main-header, .main-footer, .btn, form { display: none !important; }
      .content-wrapper { margin-left: 0 !important; }
    }
  </style>

  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- ══ TOPBAR ════════════════════════════════════════════ -->
  <nav class="main-header navbar navbar-expand">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars" style="color:var(--blue-main)"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center" style="gap:4px">

      {{-- Notifikasi --}}
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button">
          <i class="fas fa-bell" style="color:var(--text-muted)"></i>
          @php
            try {
              $notifCount = \App\Models\JadwalMaintenance::where('status','terjadwal')
                ->where('jadwal_tanggal','<=', now()->addDays(3)->toDateString())->count();
            } catch(\Exception $e) { $notifCount = 0; }
          @endphp
          @if($notifCount > 0)
            <span class="badge badge-danger navbar-badge" style="font-size:9px">{{ $notifCount }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right notif-dropdown">
          <div class="notif-header">
            <i class="fas fa-bell mr-1"></i> Notifikasi Maintenance
          </div>
          <div style="padding:10px 14px;font-size:12.5px;color:var(--text-main)">
            @if($notifCount > 0)
              <i class="fas fa-exclamation-triangle text-warning mr-1"></i>
              <strong>{{ $notifCount }}</strong> jadwal maintenance dalam 3 hari ke depan
            @else
              <div class="text-center py-1" style="color:var(--text-muted)">
                <i class="fas fa-check-circle text-success mr-1"></i> Tidak ada notifikasi mendesak
              </div>
            @endif
          </div>
          <div class="notif-footer">
            <a href="{{ route('jadwal-maintenance.index') }}">Lihat semua jadwal →</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <li style="width:1px;height:28px;background:var(--border-soft);margin:0 6px"></li>

      <!-- User & Logout -->
      <li class="nav-item">
        <div class="d-flex align-items-center" style="gap:10px">
          <div class="topbar-user">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="user">
            <div class="d-none d-md-block" style="line-height:1.2">
              <div style="font-size:12.5px;font-weight:700;color:var(--text-main)">{{ auth()->user()->name ?? 'Admin' }}</div>
              <div style="font-size:10.5px;color:var(--text-muted)">Administrator</div>
            </div>
          </div>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn-logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="d-none d-md-inline">Keluar</span>
            </button>
          </form>
        </div>
      </li>
    </ul>
  </nav>

  <!-- ══ SIDEBAR ═══════════════════════════════════════════ -->
  <aside class="main-sidebar sidebar-dark-primary elevation-0">

    <!-- Brand -->
    <a href="{{ route('dashboard.optimal') }}" class="brand-link">
      <img src="{{ asset('images/logo-uht.png') }}" alt="Logo FK UHT" class="brand-logo-img">
      <div class="brand-text-wrap">
        <span class="brand-name">Lab CBT FK UHT</span>
        <span class="brand-sub">Universitas Hang Tuah</span>
      </div>
    </a>

    <div class="sidebar">
      <!-- User panel -->
      <div class="user-panel d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name ?? 'Administrator' }}</a>
          <p>{{ auth()->user()->email ?? '' }}</p>
        </div>
      </div>

      <!-- Nav Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview" role="menu" data-accordion="false">

          {{-- ── UTAMA ─────────────────────────────────────── --}}
          <li class="nav-header">Utama</li>
          <li class="nav-item">
            <a href="{{ route('dashboard.optimal') }}"
               class="nav-link {{ request()->routeIs('dashboard.optimal') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          {{-- ── DATA MASTER ───────────────────────────────── --}}
          <li class="nav-header">Data Master</li>
          <li class="nav-item {{ request()->routeIs('kategori.*','divisi.*','karyawan.*','ruangan.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('kategori.*','divisi.*','karyawan.*','ruangan.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-database"></i>
              <p>Master Data <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('kategori.index') }}"
                   class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tag"></i><p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('divisi.index') }}"
                   class="nav-link {{ request()->routeIs('divisi.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-sitemap"></i><p>Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('karyawan.index') }}"
                   class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i><p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ruangan.index') }}"
                   class="nav-link {{ request()->routeIs('ruangan.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-door-open"></i><p>Ruangan</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- ── INVENTARIS ────────────────────────────────── --}}
          <li class="nav-header">Inventaris</li>
          <li class="nav-item">
            <a href="{{ route('barang.index') }}"
               class="nav-link {{ request()->routeIs('barang.index','barang.create','barang.edit','barang.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i><p>Data Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('peminjaman.index') }}"
               class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-hand-holding"></i><p>Peminjaman</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('barang.scan') }}"
               class="nav-link {{ request()->routeIs('barang.scan') ? 'active' : '' }}">
              <i class="nav-icon fas fa-qrcode"></i><p>Scan Barang</p>
            </a>
          </li>

          {{-- ── PEMELIHARAAN ──────────────────────────────── --}}
          <li class="nav-header">Pemeliharaan</li>
          <li class="nav-item">
            <a href="{{ route('jadwal-maintenance.index') }}"
               class="nav-link {{ request()->routeIs('jadwal-maintenance.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Jadwal Maintenance
                @if(isset($notifCount) && $notifCount > 0)
                  <span class="badge badge-warning right">{{ $notifCount }}</span>
                @endif
              </p>
            </a>
          </li>

          {{-- ── LAPORAN ───────────────────────────────────── --}}
          <li class="nav-header">Laporan</li>
          <li class="nav-item {{ request()->routeIs('laporan.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>Laporan <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('laporan.inventaris') }}"
                   class="nav-link {{ request()->routeIs('laporan.inventaris') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-clipboard-list"></i><p>Inventaris Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan.peminjaman') }}"
                   class="nav-link {{ request()->routeIs('laporan.peminjaman') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-file-alt"></i><p>Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan.maintenance') }}"
                   class="nav-link {{ request()->routeIs('laporan.maintenance') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tools"></i><p>Maintenance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan.stok') }}"
                   class="nav-link {{ request()->routeIs('laporan.stok') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-exchange-alt"></i><p>Transaksi Stok</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan.log-aktivitas') }}"
                   class="nav-link {{ request()->routeIs('laporan.log-aktivitas') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-history"></i><p>Log Aktivitas</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <!-- ══ CONTENT WRAPPER ═══════════════════════════════════ -->
  <div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap:8px">
          <div>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard.optimal') }}">
                  <i class="fas fa-home" style="font-size:11px"></i>
                </a>
              </li>
              @yield('breadcrumb-items')
            </ol>
          </div>
          <div class="pt-1">@yield('page-actions')</div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid px-0">

        {{-- Flash Messages --}}
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show mb-3">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show mb-3">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif
        @if(session('warning'))
          <div class="alert alert-warning alert-dismissible fade show mb-3">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif

        @yield('content')

      </div>
    </section>
  </div>

  <!-- ══ FOOTER ════════════════════════════════════════════ -->
  <footer class="main-footer">
    <span>
      © {{ date('Y') }}
      <strong style="color:var(--blue-main)">Lab CBT FK Universitas Hang Tuah</strong>
      — Sistem Inventaris v1.0
    </span>
    <span class="float-right" style="color:var(--text-muted)">
      <i class="fas fa-server mr-1"></i> Laravel {{ app()->version() }}
    </span>
  </footer>

</div><!-- /.wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<script>
  // Auto-dismiss success alerts setelah 4 detik
  setTimeout(function () {
    document.querySelectorAll('.alert-success').forEach(function(el) {
      el.classList.remove('show');
      setTimeout(function() { el.remove(); }, 300);
    });
  }, 4000);
</script>

@stack('scripts')
</body>
</html>
