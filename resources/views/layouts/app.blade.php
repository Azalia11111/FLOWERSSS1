<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','LOWERS')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#fffaf9;
            --accent:#f7d9e0;
            --accent-2:#f3e8ff;
            --text:#3b3b3b;
            --muted:#7d7d7d;
            --button:#f08aa1;
        }
        *{box-sizing:border-box}
        body{margin:0;font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial;background:linear-gradient(180deg,var(--bg),#fff);color:var(--text);-webkit-font-smoothing:antialiased}
        .container{max-width:1100px;margin:0 auto;padding:0 20px}
        header{padding:18px 0}
        .topbar{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(0,0,0,0.04);gap:16px}
        .left{display:flex;align-items:center;gap:14px;min-width:140px}
        .center{flex:1;text-align:center}
        .right{display:flex;align-items:center;gap:12px;min-width:180px;justify-content:flex-end}
        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:54px;height:54px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;box-shadow:0 6px 18px rgba(240,138,161,0.12);font-family:"Playfair Display",serif;color:#fff;font-weight:700;font-size:22px}
        .site-title{font-family:"Playfair Display",serif;font-size:18px;color:var(--text)}
        .meta{font-size:15px;color:var(--muted);line-height:1.15}
        .meta strong{color:var(--text);display:block;font-weight:600}
        .actions{display:flex;gap:12px;align-items:center}
        .btn{background:var(--button);color:#fff;padding:9px 14px;border-radius:10px;text-decoration:none;font-weight:600;box-shadow:0 6px 16px rgba(240,138,161,0.14)}
        .btn.ghost{background:transparent;color:var(--text);border:1px solid rgba(0,0,0,0.06);padding:8px 12px}
        .cart{display:inline-flex;gap:8px;align-items:center;background:transparent;border-radius:10px;padding:8px 10px;color:var(--text)}
        .cart .count{background:#fff;border:1px solid rgba(0,0,0,0.06);padding:4px 8px;border-radius:999px;font-weight:700}
        main{padding:30px 0}
        footer{padding:30px 0;color:var(--muted);font-size:14px;border-top:1px solid rgba(0,0,0,0.04);margin-top:40px}
        @media(max-width:900px){ .center{display:none} }
         .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px;
            border-radius: 10px;
        }

        .user-info input { margin-bottom: 10px; padding: 8px; width: calc(100% - 16px); }
    </style>
    @stack('head')
    </style>
    @stack('head')
</head>
<body>
    <header>
        <div class="container">
            <div class="topbar">
                <div class="left">
                    <div class="brand">
                        <div class="logo">F</div>
                        <div class="site-title">LOWERS</div>
                    </div>
                </div>


                <div class="center">
                    <div class="meta">
                        <strong>Трактовая 14Б</strong>
                        <div>8(999)-09-98 87</div>
                    </div>
                </div>

             
                <div class="right">
  <div class="actions">
   

@auth
  @if(auth()->user()->is_admin)
    <div class="actions">
      
      <a href="{{ route('flowers.index') }}" class="btn">Добавить</a>
    </div>
  @endif
@endauth


@guest
    <a href="#" id="open-auth" class="btn ghost">Войти</a>
@endguest
@auth
                        <a href="{{ route('orders.index') }}" class="btn">Мои заказы</a>
                        
                    @endauth
    <a href="{{ route('cart.index') }}" class="cart" title="Корзина">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="opacity:.9">
        <path d="M6 6h15l-1.5 9h-12L6 6z" stroke="#333" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="10" cy="20" r="1" fill="#333"/><circle cx="18" cy="20" r="1" fill="#333"/>
      </svg>
      <span class="count">{{ session('cart.items') ? count(session('cart.items')) : 0 }}</span>
    </a>
  </div>
</div>
    </header>
 <div id="user-modal" class="modal">
    <div class="modal-content">
        <h2>Редактировать информацию</h2>
        <strong>{{ Auth::user()->name ?? '' }}</strong><br>
        <span>{{ Auth::user()->phone ?? '' }}</span><br>
        <input type="text" placeholder="Измените имя" value="{{ Auth::user()->name ?? '' }}" id="user-name">
        <input type="text" placeholder="Измените номер телефона" value="{{ Auth::user()->phone ?? '' }}" id="user-phone">
        <button id="save-user-info" class="btn">Сохранить</button>
        <button id="close-modal" class="btn ghost">Закрыть</button>
    </div>
</div>
    <main class="container">
        @yield('content')
    </main>

    <footer class="container">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;">
            <div>© {{ date('Y') }} LOWERS — Трактовая 14Б</div>
            <div style="color:var(--muted)">Телефон: 8(999)-09-98 87</div>
        </div>
    </footer>

    @stack('scripts')
</body>
<style>
/* Простой стиль модалки */
.auth-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);display:none;align-items:center;justify-content:center;z-index:9999}
.auth-modal{width:420px;max-width:92%;background:#fff;border-radius:12px;padding:18px;box-shadow:0 12px 40px rgba(0,0,0,.16);font-family:Inter,system-ui;}
.auth-tabs{display:flex;gap:8px;margin-bottom:12px}
.auth-tab{flex:1;padding:8px;border-radius:8px;text-align:center;cursor:pointer;background:#f6f6f6}
.auth-tab.active{background:#f08aa1;color:#fff;font-weight:700}
.auth-close{position:absolute;right:14px;top:10px;cursor:pointer;color:#999}
.auth-errors{background:#fff6f8;border:1px solid rgba(240,138,161,.12);padding:8px;border-radius:8px;margin-bottom:10px;color:#b03}
.auth-row{margin-bottom:8px}
.auth-row input{width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px}
.auth-actions{display:flex;justify-content:space-between;align-items:center;margin-top:10px}
</style>

<div class="auth-overlay" id="authOverlay" aria-hidden="true">
  <div class="auth-modal" role="dialog" aria-modal="true" aria-labelledby="authTitle" style="position:relative">
    <div class="auth-close" id="authClose">✕</div>

    <div class="auth-tabs">
      <div class="auth-tab" data-tab="login" id="tabLogin">Вход</div>
      <div class="auth-tab" data-tab="register" id="tabRegister">Регистрация</div>
    </div>

      <div id="authContent">
      <!-- Login -->
      <div class="auth-panel" data-panel="login" style="display:none">
        @if(session('auth_open')=='login' && session('auth_errors'))
          <div class="auth-errors">{{ session('auth_errors') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="auth-row">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')<div class="auth-errors">{{ $message }}</div>@enderror
          </div>
          <div class="auth-row">
            <input type="password" name="password" placeholder="Пароль">
            @error('password')<div class="auth-errors">{{ $message }}</div>@enderror
          </div>
          <div style="display:flex;align-items:center;gap:8px;">
            <label style="font-size:13px;color:#666"><input type="checkbox" name="remember"> Запомнить</label>
          </div>
          <div class="auth-actions">
            <button type="submit" class="btn">Войти</button>
            <a href="#" onclick="document.getElementById('tabRegister').click();return false" style="color:#7d7d7d;font-size:14px">Нет аккаунта?</a>
          </div>
        </form>
      </div>

      <!-- Register -->
      <div class="auth-panel" data-panel="register" style="display:none">
        @if(session('auth_open')=='register' && session('auth_errors'))
          <div class="auth-errors">{{ session('auth_errors') }}</div>
        @endif
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="auth-row">
            <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}">
            @error('name')<div class="auth-errors">{{ $message }}</div>@enderror
          </div>
          <div class="auth-row">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')<div class="auth-errors">{{ $message }}</div>@enderror
          </div>
          <div class="auth-row">
            <input type="password" name="password" placeholder="Пароль">
            @error('password')<div class="auth-errors">{{ $message }}</div>@enderror
          </div>
          <div class="auth-row">
            <input type="password" name="password_confirmation" placeholder="Повтор пароля">
          </div>
          <div class="auth-actions">
            <button type="submit" class="btn">Зарегистрироваться</button>
            <a href="#" onclick="document.getElementById('tabLogin').click();return false" style="color:#7d7d7d;font-size:14px">Уже есть аккаунт?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="auth-overlay" id="authOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.35);align-items:center;justify-content:center;z-index:9999">
  <div class="auth-modal" role="dialog" aria-modal="true" style="background:#fff;border-radius:12px;padding:18px;max-width:480px;width:94%;position:relative">
    <button id="authClose" style="position:absolute;right:12px;top:8px;background:none;border:0;font-size:18px;cursor:pointer">✕</button>

    <div style="display:flex;gap:8px;margin-bottom:12px">
      <div class="auth-tab" data-tab="login" style="flex:1;padding:8px;border-radius:8px;text-align:center;cursor:pointer;background:#f6f6f6">Вход</div>
      <div class="auth-tab active" data-tab="register" style="flex:1;padding:8px;border-radius:8px;text-align:center;cursor:pointer;background:#f08aa1;color:#fff;font-weight:700">Регистрация</div>
    </div>

    <div id="authPanels">
      <!-- Login -->
      <div class="auth-panel" data-panel="login" style="display:none">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div style="margin-bottom:8px"><input name="email" type="email" placeholder="Email" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px"></div>
          <div style="margin-bottom:8px"><input name="password" type="password" placeholder="Пароль" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px"></div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px">
            <button type="submit" class="btn">Войти</button>
            <a href="#" class="ghost-link" data-switch="register" style="color:#7d7d7d">Нет аккаунта?</a>
          </div>
        </form> </div>

      <!-- Register -->
      <div class="auth-panel" data-panel="register" style="display:block">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div style="margin-bottom:8px"><input name="name" type="text" placeholder="Имя" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px" value="{{ old('name') }}"></div>
          <div style="margin-bottom:8px"><input name="email" type="email" placeholder="Email" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px" value="{{ old('email') }}"></div>
          <div style="margin-bottom:8px"><input name="password" type="password" placeholder="Пароль" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px"></div>
          <div style="margin-bottom:8px"><input name="password_confirmation" type="password" placeholder="Повтор пароля" style="width:100%;padding:9px;border:1px solid rgba(0,0,0,.07);border-radius:8px"></div>

          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px">
            <button type="submit" class="btn">Зарегистрироваться</button>
            <a href="#" class="ghost-link" data-switch="login" style="color:#7d7d7d">Войти</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const openBtn = document.getElementById('open-auth');
  const overlay = document.getElementById('authOverlay');
  const closeBtn = document.getElementById('authClose');
  const tabs = document.querySelectorAll('.auth-tab');
  const panels = document.querySelectorAll('.auth-panel');
  const switches = document.querySelectorAll('.ghost-link[data-switch]');

  function open(defaultTab='register'){
    overlay.style.display='flex';
    selectTab(defaultTab);
  }
  function close(){ overlay.style.display='none'; }
  function selectTab(name){
    tabs.forEach(t=>t.classList.toggle('active', t.dataset.tab===name));
    tabs.forEach(t=> t.style.background = (t.dataset.tab===name ? '#f08aa1' : '#f6f6f6'));
    tabs.forEach(t=> t.style.color = (t.dataset.tab===name ? '#fff' : '#000'));
    panels.forEach(p=> p.style.display = (p.dataset.panel===name ? 'block' : 'none'));
  }

  openBtn && openBtn.addEventListener('click', function(e){ e.preventDefault(); open('register'); });
  closeBtn && closeBtn.addEventListener('click', close);
  overlay && overlay.addEventListener('click', function(e){ if(e.target===overlay) close(); });
  tabs.forEach(t=>t.addEventListener('click', ()=>selectTab(t.dataset.tab)));
  switches.forEach(s=>s.addEventListener('click', function(e){ e.preventDefault(); selectTab(this.dataset.switch); }));

  // Открыть модал по серверному флагу или ошибкам валидации:
  @if(session('auth_open'))
    open('{{ session('auth_open') }}');
  @elseif($errors->any())
    @if($errors->has('name'))
      open('register');
    @else
      open('login');
    @endif
  @endif
})();
</script>
</html>
