@include('layouts.header')

<main class="page-main contact-page">
  <div class="contact-wrap">
    <div class="page-title-bar">
      <h1>お問い合わせ</h1>
    </div>

    <div class="form-instruction">
      <p>下記の内容をご確認の上送信ボタンを押してください<br>内容を訂正する場合は戻るを押してください。</p>
    </div>

    <form action="{{ url('/complete') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label">氏名</label>
        <div class="confirm-value">{{ session('contact_input.name') }}</div>
      </div>

      <div class="form-group">
        <label class="form-label">フリガナ</label>
        <div class="confirm-value">{{ session('contact_input.kana') }}</div>
      </div>

      <div class="form-group">
        <label class="form-label">電話番号</label>
        <div class="confirm-value">{{ session('contact_input.tel') }}</div>
      </div>

      <div class="form-group">
        <label class="form-label">メールアドレス</label>
        <div class="confirm-value">{{ session('contact_input.mail') }}</div>
      </div>

      <div class="form-group">
        <label class="form-label">お問い合わせ内容</label>
        <div class="confirm-value" style="white-space:pre-wrap; min-height:120px;">{{ session('contact_input.contact_text') }}</div>
      </div>

      <div class="form-actions" style="display:flex; gap:16px;">
        <button type="submit" id="confirm_send" class="btn-primary" style="flex:1;">送　信</button>
        <a href="{{ url('/contact') }}" class="btn-secondary" id="back" style="flex:1; text-align:center; text-decoration:none; padding:0.7rem 2rem; display:flex; align-items:center; justify-content:center;">戻　る</a>
      </div>
    </form>
  </div>
</main>

@include('layouts.footer')

