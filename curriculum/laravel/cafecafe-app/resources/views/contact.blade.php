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

    <form id="contact-form" action="{{ url('/confirm') }}" method="POST" novalidate>
      @csrf

      <div class="form-group">
        <label class="form-label" for="name">氏名<span class="req">*</span></label>
        <span class="vali-error" id="vali_name"@if(empty($errors['name'])) style="display:none"@endif>{{ $errors['name'] ?? '' }}</span>
        <input class="form-input" type="text" id="name" name="name"
               placeholder="山田太郎"
               value="{{ old('name', $old['name'] ?? '') }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="kana">フリガナ<span class="req">*</span></label>
        <span class="vali-error" id="vali_kana"@if(empty($errors['kana'])) style="display:none"@endif>{{ $errors['kana'] ?? '' }}</span>
        <input class="form-input" type="text" id="kana" name="kana"
               placeholder="ヤマダタロウ"
               value="{{ old('kana', $old['kana'] ?? '') }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="tel">電話番号</label>
        <span class="vali-error" id="vali_tel"@if(empty($errors['tel'])) style="display:none"@endif>{{ $errors['tel'] ?? '' }}</span>
        <input class="form-input" type="text" id="tel" name="tel"
               placeholder="09012345678"
               value="{{ old('tel', $old['tel'] ?? '') }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="mail">メールアドレス<span class="req">*</span></label>
        <span class="vali-error" id="vali_email"@if(empty($errors['mail'])) style="display:none"@endif>{{ $errors['mail'] ?? '' }}</span>
        <input class="form-input" type="text" id="mail" name="mail"
               placeholder="test@test.co.jp"
               value="{{ old('mail', $old['mail'] ?? '') }}">
      </div>

      <div class="form-group">
        <div class="form-instruction">
          <p>お問い合わせ内容をご記入ください<span class="req">*</span></p>
        </div>
        <span class="vali-error" id="vali_contact"@if(empty($errors['contact_text'])) style="display:none"@endif>{{ $errors['contact_text'] ?? '' }}</span>
        <textarea class="form-textarea" id="contact_text" name="contact_text">{{ old('contact_text', $old['contact_text'] ?? '') }}</textarea>
      </div>

      <div class="form-actions">
        <button type="submit" id="send" class="btn-primary" style="width:100%;">送　信</button>
      </div>
    </form>

    @if(!empty($contacts))
    <div class="contact-list">
      <h2>お問い合わせ一覧</h2>
      <table class="contact-list-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>フリガナ</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
						<th>お問い合わせ内容</th>
            <th></th>
						<th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->kana }}</td>
            <td>{{ $contact->tel }}</td>
            <td>{{ $contact->email }}</td>
            <td class="overflow-cell">{{ $contact->body }}</td>
            <td style="white-space:nowrap;">
              <a href="{{ url('/go-edit') }}?id={{ $contact->id }}" id="edit_link" class="link-edit">編集</a>
						</td>
						<td>
              <a href="{{ url('/delete') }}?id={{ $contact->id }}"
                 id="delete_link"
                 class="link-delete"
                 onclick="return confirm('削除しますか？')">削除</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif

  </div>
</main>

@include('layouts.footer')

<script>
(function () {
  const fieldMap = {
    name:         'vali_name',
    kana:         'vali_kana',
    tel:          'vali_tel',
    mail:         'vali_email',
    contact_text: 'vali_contact'
  };

  function validateForm() {
    const errors = {};
    const name        = document.getElementById('name').value.trim();
    const kana        = document.getElementById('kana').value.trim();
    const tel         = document.getElementById('tel').value.trim();
    const mail        = document.getElementById('mail').value.trim();
    const contactText = document.getElementById('contact_text').value.trim();

    if (!name) {
      errors.name = '氏名は必須入力です';
    } else if ([...name].length > 10) {
      errors.name = '10文字以内で入力してください';
    }

    if (!kana) {
      errors.kana = 'フリガナは必須入力です';
    } else if ([...kana].length > 10) {
      errors.kana = '10文字以内で入力してください';
    }

    if (tel && !/^[0-9]+$/.test(tel)) {
      errors.tel = '電話番号には半角数字しか入力できません';
    }

    if (!mail) {
      errors.mail = 'メールアドレスは必須入力です';
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(mail)) {
      errors.mail = 'メールアドレスにはメール形式(xxx@xxx.xxx)でしか入力出来ません';
    }

    if (!contactText) {
      errors.contact_text = 'お問い合わせ内容は必須入力です';
    }

    return errors;
  }

  function showInlineErrors(errors) {
    Object.values(fieldMap).forEach(function (spanId) {
      const el = document.getElementById(spanId);
      if (el) {
        el.textContent = '';
        el.style.display = 'none';
      }
    });
    Object.keys(errors).forEach(function (field) {
      const spanId = fieldMap[field];
      if (spanId) {
        const el = document.getElementById(spanId);
        if (el) {
          el.textContent = errors[field];
          el.style.display = 'block';
        }
      }
    });
  }

  // フォーム送信時：alertで表示後にインライン表示
  document.getElementById('contact-form').addEventListener('submit', function (e) {
    const errors = validateForm();
    if (Object.keys(errors).length > 0) {
      e.preventDefault();
      alert(Object.values(errors).join('\n'));
      showInlineErrors(errors);
    }
  });
})();
</script>
