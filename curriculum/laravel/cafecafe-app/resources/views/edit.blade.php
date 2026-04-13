@include('layouts.header')

<main class="page-main contact-page">

  <div class="contact-wrap">
    <div class="page-title-bar">
      <h1>お問い合わせ</h1>
    </div>
    <div class="form-instruction">
      <p>下記の項目をご記入の上送信ボタンを押してください。</p>
    </div>
    <p class="contact-notice">
      送受信の件につきましては、当社よりご連絡までに数週間を要する場合があります。<br>
      なお、ご確認までにご時間をいただいているためご了承ください。<br>
      <span style="color:#c0194c;">*</span>は必須項目となります。
    </p>

    <form id="contact-form" action="{{ url('/edit') }}" method="POST" novalidate>
      @csrf
      <input type="hidden" name="edit_id" value="{{ $contact->id }}">

      <div class="form-group">
        <label class="form-label" for="name">氏名<span class="req">*</span></label>
        @if(!empty($errors['name']))
          <span class="vali-error" id="vali_name">{{ $errors['name'] }}</span>
        @endif
        <input class="form-input" type="text" id="name" name="name"
               placeholder="山田太郎"
               value="{{ $old['name'] ?? $contact->name }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="kana">フリガナ<span class="req">*</span></label>
        @if(!empty($errors['kana']))
          <span class="vali-error" id="vali_kana">{{ $errors['kana'] }}</span>
        @endif
        <input class="form-input" type="text" id="kana" name="kana"
               placeholder="ヤマダタロウ"
               value="{{ $old['kana'] ?? $contact->kana }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="tel">電話番号</label>
        @if(!empty($errors['tel']))
          <span class="vali-error" id="vali_tel">{{ $errors['tel'] }}</span>
        @endif
        <input class="form-input" type="text" id="tel" name="tel"
               placeholder="09012345678"
               value="{{ $old['tel'] ?? $contact->tel }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="mail">メールアドレス<span class="req">*</span></label>
        @if(!empty($errors['mail']))
          <span class="vali-error" id="vali_email">{{ $errors['mail'] }}</span>
        @endif
        <input class="form-input" type="text" id="mail" name="mail"
               placeholder="test@test.co.jp"
               value="{{ $old['mail'] ?? $contact->email }}">
      </div>

      <div class="form-group">
        <div class="form-instruction">
          <p>お問い合わせ内容をご記入ください<span class="req">*</span></p>
        </div>
        @if(!empty($errors['contact_text']))
          <span class="vali-error" id="vali_contact">{{ $errors['contact_text'] }}</span>
        @endif
        <textarea class="form-textarea" id="contact_text" name="contact_text">{{ $old['contact_text'] ?? $contact->body }}</textarea>
      </div>

      <div class="form-actions">
        <button type="submit" id="send" class="btn-primary" style="width:100%;">送　信</button>
      </div>
    </form>

  </div>
</main>

@include('layouts.footer')
