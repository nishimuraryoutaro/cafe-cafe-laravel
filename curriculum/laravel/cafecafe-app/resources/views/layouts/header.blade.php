<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe Cafe</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@if(request()->is('contact') || request()->is('confirm') || request()->is('complete') || request()->is('edit'))
<header class="contact">
  <nav class="motion">
    <div class="logo">
      <a href="{{ url('/index') }}"><img src="{{ asset('img/logo.png') }}" alt="Cafe-Cafe"></a>
    </div>
    <div class="g_nav">
      <div class="menu">
        <a href="{{ url('/index') }}#introduction" id="introduction">はじめに</a>
      </div>
      <div class="menu">
        <a href="{{ url('/index') }}#cafe_exp" id="experience">体験</a>
      </div>
      <div class="menu">
        <a href="{{ url('/contact') }}" id="contact_transition">お問い合わせ</a>
      </div>
    </div>
    <div class="sign">
      <div class="sigmin_click" id="sign_in">サインイン</div>
    </div>
    <div class="sp _click">
      <img src="{{ asset('img/menu.png') }}" alt="スマホメニュー">
    </div>
  </nav>
</header>

@else
<div class="alert">
  <a href="#">新型コロナウイルスに対する取り組みの最新情報をご案内</a>
</div>

<header>
  <h1 class="concept">あなたの<br>好きな空間を作る。</h1>
  <nav>
    <div class="logo">
      <a href="{{ url('/index') }}"><img src="{{ asset('img/logo.png') }}" alt="Cafe-Cafe"></a>
    </div>
    <div class="g_nav">
      <div class="menu _click">
        <a href="{{ url('/index') }}#introduction">はじめに</a>
      </div>
      <div class="menu _click">
        <a href="{{ url('/index') }}#cafe_exp">体験</a>
      </div>
      <div class="menu">
        <a href="{{ url('/contact') }}" id="contact_transition">お問い合わせ</a>
      </div>
    </div>
    <div class="sign">
      <div class="sigmin_click" id="sign_in">サインイン</div>
    </div>
    <div class="sp _click">
      <img src="{{ asset('img/menu.png') }}" alt="スマホメニュー">
    </div>
  </nav>
</header>
@endif

<div id="signin-modal" class="modal-overlay" style="display:none;">
  <div class="modal-box">
    <button class="modal-close" id="modal-close-btn">&times;</button>
    <h2 class="modal-title">ログイン</h2>
    <form id="signin-form" onsubmit="document.getElementById('signin-modal').style.display='none'; document.body.style.overflow=''; return false;">
      <div class="modal-field">
        <input type="email" name="login_email" placeholder="メールアドレス">
      </div>
      <div class="modal-field">
        <input type="password" name="login_password" placeholder="パスワード">
      </div>
      <button type="submit" class="btn-signin-submit">送　信</button>
    </form>
    <div class="social-login">
      <button class="btn-social">
        <img src="{{ asset('img/twitter.png') }}" alt="Twitter">
      </button>
      <button class="btn-social">
        <img src="{{ asset('img/fb.png') }}" alt="Facebook">
      </button>
      <button class="btn-social">
        <img src="{{ asset('img/google.png') }}" alt="Google">
      </button>
      <button class="btn-social">
        <img src="{{ asset('img/apple.png') }}" alt="Apple">
      </button>
    </div>
  </div>
</div>