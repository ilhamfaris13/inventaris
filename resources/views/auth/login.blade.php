<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login — Sistem Inventaris Lab CBT FK UHT</title>
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue-dark:   #0A3D6B;
      --blue-main:   #1565A8;
      --blue-mid:    #2196D3;
      --blue-light:  #64B5F6;
      --blue-pale:   #E3F2FD;
      --gold:        #D4A017;
      --gold-light:  #F5D76E;
      --red-accent:  #C0392B;
      --green:       #2E7D32;
      --white:       #FFFFFF;
      --gray-50:     #F8FAFC;
      --gray-200:    #E2E8F0;
      --gray-400:    #94A3B8;
      --gray-700:    #334155;
      --text:        #1E293B;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--blue-dark);
      min-height: 100vh;
      display: flex;
      align-items: stretch;
      overflow: hidden;
    }

    /* ── Panel kiri — dekoratif ──────────────────────────── */
    .left-panel {
      flex: 1;
      background: linear-gradient(160deg, var(--blue-dark) 0%, var(--blue-main) 50%, var(--blue-mid) 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 60px 48px;
      position: relative;
      overflow: hidden;
    }

    /* Dekorasi geometris latar */
    .left-panel::before {
      content: '';
      position: absolute;
      width: 500px; height: 500px;
      border-radius: 50%;
      border: 80px solid rgba(255,255,255,0.04);
      top: -120px; right: -120px;
    }
    .left-panel::after {
      content: '';
      position: absolute;
      width: 320px; height: 320px;
      border-radius: 50%;
      border: 50px solid rgba(255,255,255,0.04);
      bottom: -80px; left: -80px;
    }

    .left-dots {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-image:
        radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
      background-size: 32px 32px;
      pointer-events: none;
    }

    /* Konten kiri */
    .left-content { position: relative; z-index: 1; text-align: center; max-width: 380px; }

    .logo-wrap {
      width: 140px; height: 140px;
      margin: 0 auto 28px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      padding: 10px;
      backdrop-filter: blur(8px);
      border: 2px solid rgba(255,255,255,0.2);
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
    }
    .logo-wrap img { width: 100%; height: 100%; object-fit: contain; border-radius: 50%; }

    .left-title {
      font-size: 1.5rem;
      font-weight: 800;
      color: #fff;
      line-height: 1.3;
      margin-bottom: 8px;
      letter-spacing: -0.01em;
    }
    .left-title span { color: var(--gold-light); }

    .left-sub {
      font-size: 13px;
      color: rgba(255,255,255,0.6);
      line-height: 1.6;
      margin-bottom: 36px;
    }

    /* Fitur chips */
    .feature-list { display: flex; flex-direction: column; gap: 12px; text-align: left; }
    .feature-item {
      display: flex; align-items: center; gap: 12px;
      background: rgba(255,255,255,0.07);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px;
      padding: 10px 14px;
      backdrop-filter: blur(4px);
    }
    .feature-item .icon {
      width: 34px; height: 34px;
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      font-size: 14px;
    }
    .feature-item .icon.blue  { background: rgba(33,150,211,0.3); color: var(--blue-light); }
    .feature-item .icon.gold  { background: rgba(212,160,23,0.3); color: var(--gold-light); }
    .feature-item .icon.green { background: rgba(46,125,50,0.3);  color: #81C784; }
    .feature-item .icon.red   { background: rgba(192,57,43,0.3);  color: #EF9A9A; }
    .feature-item .text { font-size: 12.5px; color: rgba(255,255,255,0.85); font-weight: 500; }

    /* ── Panel kanan — form login ────────────────────────── */
    .right-panel {
      width: 440px;
      background: var(--white);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 48px 44px;
      box-shadow: -20px 0 60px rgba(0,0,0,0.2);
      position: relative;
      z-index: 10;
    }

    /* Strip aksen atas */
    .right-panel::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--blue-dark), var(--blue-mid), var(--gold));
    }

    .login-header { margin-bottom: 32px; }
    .login-badge {
      display: inline-flex; align-items: center; gap: 6px;
      background: var(--blue-pale);
      color: var(--blue-main);
      font-size: 11px; font-weight: 700;
      letter-spacing: 0.06em; text-transform: uppercase;
      padding: 4px 10px; border-radius: 20px;
      margin-bottom: 12px;
    }
    .login-title {
      font-size: 1.55rem;
      font-weight: 800;
      color: var(--text);
      line-height: 1.25;
      margin-bottom: 6px;
    }
    .login-subtitle {
      font-size: 13px;
      color: var(--gray-400);
    }

    /* Form */
    .form-group { margin-bottom: 18px; }
    .form-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      color: var(--gray-700);
      margin-bottom: 6px;
      letter-spacing: 0.03em;
    }
    .input-wrap { position: relative; }
    .input-icon {
      position: absolute;
      left: 13px; top: 50%; transform: translateY(-50%);
      color: var(--gray-400);
      font-size: 13px;
      pointer-events: none;
    }
    .form-input {
      width: 100%;
      padding: 11px 14px 11px 38px;
      border: 1.5px solid var(--gray-200);
      border-radius: 9px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13.5px;
      color: var(--text);
      background: var(--gray-50);
      transition: all 0.2s;
      outline: none;
    }
    .form-input:focus {
      border-color: var(--blue-main);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(21,101,168,0.1);
    }
    .form-input.is-invalid { border-color: var(--red-accent); background: #FFF5F5; }
    .error-msg {
      display: flex; align-items: center; gap: 5px;
      font-size: 11.5px; color: var(--red-accent);
      margin-top: 5px; font-weight: 500;
    }

    /* Password toggle */
    .toggle-pass {
      position: absolute;
      right: 12px; top: 50%; transform: translateY(-50%);
      color: var(--gray-400);
      cursor: pointer; font-size: 13px;
      background: none; border: none; padding: 2px;
      transition: color 0.15s;
    }
    .toggle-pass:hover { color: var(--blue-main); }

    /* Remember me */
    .form-options {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 20px;
    }
    .remember-wrap { display: flex; align-items: center; gap: 7px; cursor: pointer; }
    .remember-wrap input[type="checkbox"] { display: none; }
    .checkbox-custom {
      width: 17px; height: 17px;
      border: 1.5px solid var(--gray-200);
      border-radius: 4px;
      display: flex; align-items: center; justify-content: center;
      transition: all 0.15s;
      flex-shrink: 0;
    }
    .remember-wrap input:checked ~ .checkbox-custom {
      background: var(--blue-main);
      border-color: var(--blue-main);
    }
    .remember-wrap input:checked ~ .checkbox-custom::after {
      content: '✓'; font-size: 11px; color: #fff; font-weight: 700;
    }
    .remember-label { font-size: 12.5px; color: var(--gray-700); user-select: none; }

    .forgot-link {
      font-size: 12.5px; color: var(--blue-main); font-weight: 600;
      text-decoration: none;
    }
    .forgot-link:hover { text-decoration: underline; }

    /* Submit button */
    .btn-login {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, var(--blue-dark), var(--blue-main));
      color: #fff;
      border: none;
      border-radius: 9px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      letter-spacing: 0.01em;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      box-shadow: 0 4px 16px rgba(10,61,107,0.3);
    }
    .btn-login:hover {
      background: linear-gradient(135deg, #062B4E, var(--blue-dark));
      box-shadow: 0 6px 20px rgba(10,61,107,0.4);
      transform: translateY(-1px);
    }
    .btn-login:active { transform: translateY(0); }

    /* Alert error */
    .alert-error {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      border-radius: 9px;
      padding: 11px 14px;
      font-size: 12.5px;
      color: #991B1B;
      margin-bottom: 20px;
      display: flex; gap: 8px; align-items: flex-start;
    }

    /* Footer kanan */
    .login-footer {
      margin-top: 28px;
      padding-top: 20px;
      border-top: 1px solid var(--gray-200);
      text-align: center;
      font-size: 11.5px;
      color: var(--gray-400);
      line-height: 1.6;
    }
    .login-footer strong { color: var(--gray-700); }

    /* Responsive */
    @media (max-width: 768px) {
      .left-panel { display: none; }
      .right-panel { width: 100%; padding: 40px 28px; box-shadow: none; }
    }
  </style>
</head>
<body>

  <!-- Panel Kiri -->
  <div class="left-panel">
    <div class="left-dots"></div>
    <div class="left-content">

      <div class="logo-wrap">
        <img src="{{ asset('images/logo-uht.png') }}" alt="Logo FK UHT">
      </div>

      <div class="left-title">
        Sistem Inventaris<br><span>Lab CBT FK UHT</span>
      </div>
      <div class="left-sub">
        Pengelolaan aset laboratorium Computer Based Test<br>
        Fakultas Kedokteran Universitas Hang Tuah
      </div>

      <div class="feature-list">
        <div class="feature-item">
          <div class="icon blue"><i class="fas fa-boxes"></i></div>
          <div class="text">Manajemen inventaris barang & peralatan lab</div>
        </div>
        <div class="feature-item">
          <div class="icon gold"><i class="fas fa-hand-holding"></i></div>
          <div class="text">Peminjaman & pengembalian barang tercatat</div>
        </div>
        <div class="feature-item">
          <div class="icon green"><i class="fas fa-calendar-check"></i></div>
          <div class="text">Jadwal maintenance berkala & terjadwal</div>
        </div>
        <div class="feature-item">
          <div class="icon red"><i class="fas fa-chart-bar"></i></div>
          <div class="text">Laporan & log aktivitas sistem lengkap</div>
        </div>
      </div>

    </div>
  </div>

  <!-- Panel Kanan -->
  <div class="right-panel">

    <div class="login-header">
      <div class="login-badge">
        <i class="fas fa-shield-alt"></i> Akses Terbatas
      </div>
      <div class="login-title">Masuk ke Sistem</div>
      <div class="login-subtitle">Gunakan akun yang telah diberikan oleh administrator</div>
    </div>

    {{-- Session error --}}
    @if($errors->any())
      <div class="alert-error">
        <i class="fas fa-exclamation-circle" style="margin-top:1px;flex-shrink:0"></i>
        <div>{{ $errors->first() }}</div>
      </div>
    @endif

    @if(session('status'))
      <div class="alert-error" style="background:#F0FDF4;border-color:#BBF7D0;color:#166534">
        <i class="fas fa-check-circle" style="color:#16A34A;margin-top:1px"></i>
        <div>{{ session('status') }}</div>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="form-group">
        <label class="form-label" for="email">Alamat Email</label>
        <div class="input-wrap">
          <i class="fas fa-envelope input-icon"></i>
          <input
            type="email"
            id="email"
            name="email"
            class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
            value="{{ old('email') }}"
            placeholder="nama@hangtuah.ac.id"
            required
            autofocus
            autocomplete="email"
          >
        </div>
        @error('email')
          <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
      </div>

      <!-- Password -->
      <div class="form-group">
        <label class="form-label" for="password">Kata Sandi</label>
        <div class="input-wrap">
          <i class="fas fa-lock input-icon"></i>
          <input
            type="password"
            id="password"
            name="password"
            class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
            placeholder="Masukkan kata sandi"
            required
            autocomplete="current-password"
          >
          <button type="button" class="toggle-pass" onclick="togglePassword()" id="toggleBtn">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
        @error('password')
          <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
      </div>

      <!-- Remember + Forgot -->
      <div class="form-options">
        <label class="remember-wrap">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <div class="checkbox-custom"></div>
          <span class="remember-label">Ingat saya</span>
        </label>
        @if(Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="forgot-link">Lupa kata sandi?</a>
        @endif
      </div>

      <!-- Submit -->
      <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt"></i>
        Masuk ke Sistem
      </button>
    </form>

    <div class="login-footer">
      <strong>Sistem Inventaris Lab CBT</strong><br>
      Fakultas Kedokteran · Universitas Hang Tuah Surabaya<br>
      © {{ date('Y') }} — Hak cipta dilindungi
    </div>

  </div>

</body>
<script>
function togglePassword() {
  const input   = document.getElementById('password');
  const icon    = document.getElementById('eyeIcon');
  const visible = input.type === 'password';
  input.type    = visible ? 'text' : 'password';
  icon.className = visible ? 'fas fa-eye-slash' : 'fas fa-eye';
}

// Animasi checkbox custom
document.getElementById('remember').addEventListener('change', function() {
  const box = this.nextElementSibling;
  box.style.transform = this.checked ? 'scale(0.85)' : 'scale(1)';
  setTimeout(() => box.style.transform = 'scale(1)', 150);
});
</script>
</html>
