@include('layouts.header')

<main class="page-main contact-page">
  <div class="contact-wrap">
    <div class="page-title-bar">
      <h1>お問い合わせ</h1>
    </div>

    <p>
      お問い合わせ頂きありがとうございます。<br>
      送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
      なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。
    </p>

    <a href="{{ url('/') }}" id="transition" style="display:inline-block; margin-top:1.5rem;">トップへ戻る</a>
  </div>
</main>

@include('layouts.footer')
