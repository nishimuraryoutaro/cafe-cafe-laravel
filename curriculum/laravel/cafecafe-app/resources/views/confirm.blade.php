@include('layouts.header')

<main class="page-main contact-page">
  <div class="contact-wrap">
    <div class="page-title-bar">
      <h1>お問い合わせ</h1>
    </div>

    <div class="form-instruction">
      <p>下記の内容をご確認の上送信ボタンを押してください<br>内容を訂正する場合は戻るを押してください。</p>
    </div>

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
        <form action="{{ url('/complete') }}" method="POST" style="flex:1;">
          @csrf
          <button type="submit" id="confirm_send" class="btn-primary" style="width:100%;">送　信</button>
        </form>
        <form action="{{ url('/back') }}" method="POST" style="flex:1;">
          @csrf
          <button type="submit" class="btn-secondary" id="back"
          style="width:100%; text-align:center; padding:0.7rem 2rem; cursor:pointer;">戻　る</button>
        </form>
      </div>
  </div>
</main>

@include('layouts.footer')

