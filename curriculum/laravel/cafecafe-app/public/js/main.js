'use strict';

document.addEventListener('DOMContentLoaded', function () {

  const nav = document.querySelector('header nav');
  const alertBar = document.querySelector('.alert');

  if (nav) {
    function updateHeader() {
      const alertH = alertBar ? alertBar.offsetHeight : 0;
      if (window.scrollY >= alertH) {
        nav.classList.add('fixed');
      } else {
        nav.classList.remove('fixed');
      }
    }
    window.addEventListener('scroll', updateHeader);
    updateHeader();
  }

  const signInBtn = document.getElementById('sign_in');
  const modal     = document.getElementById('signin-modal');
  const closeBtn  = document.getElementById('modal-close-btn');

  if (signInBtn && modal) {
    signInBtn.addEventListener('click', function (e) {
      e.preventDefault();
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    });
  }

  if (closeBtn && modal) {
    closeBtn.addEventListener('click', function () {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    });
  }

  if (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.style.display === 'flex') {
        modal.style.display = 'none';
        document.body.style.overflow = '';
      }
    });
  }

  const introLink = document.getElementById('introduction');
  if (introLink) {
    introLink.addEventListener('click', function (e) {
      const target = document.querySelector('section#introduction');
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  const expLink = document.getElementById('experience');
  if (expLink) {
    expLink.addEventListener('click', function (e) {
      const target = document.getElementById('cafe_exp');
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  const jumpBtn = document.getElementById('jump_to_top');
  if (jumpBtn) {
    jumpBtn.style.display = 'none';

    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) {
        jumpBtn.style.display = 'block';
      } else {
        jumpBtn.style.display = 'none';
      }
    });

    jumpBtn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  const hash = window.location.hash;
  if (hash) {
    const target = document.querySelector(hash);
    if (target) {
      setTimeout(function () {
        target.scrollIntoView({ behavior: 'smooth' });
      }, 100);
    }
  }

  const backBtn = document.getElementById('back');
  if (backBtn) {
    backBtn.addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = backBtn.getAttribute('href');
    });
  }

  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      const msgs = [];

      const nameEl = document.getElementById('name');
      const kanaEl = document.getElementById('kana');
      const telEl  = document.getElementById('tel');
      const mailEl = document.getElementById('mail');
      const bodyEl = document.getElementById('contact_text');

      const name = nameEl ? nameEl.value.trim() : '';
      const kana = kanaEl ? kanaEl.value.trim() : '';
      const tel  = telEl  ? telEl.value.trim()  : '';
      const mail = mailEl ? mailEl.value.trim()  : '';
      const body = bodyEl ? bodyEl.value.trim()  : '';

      if (name === '') {
        msgs.push('氏名は必須入力です');
      } else if (name.length > 10) {
        msgs.push('氏名は10文字以内で入力してください');
      }

      if (kana === '') {
        msgs.push('フリガナは必須入力です');
      } else if (kana.length > 10) {
        msgs.push('フリガナは10文字以内で入力してください');
      }

      if (tel !== '' && !/^[0-9]+$/.test(tel)) {
        msgs.push('電話番号には半角数字しか入力できません');
      }

      if (mail === '') {
        msgs.push('メールアドレスは必須入力です');
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(mail)) {
        msgs.push('メールアドレスにはメール形式(xxx@xxx.xxx)でしか入力出来ません');
      }

      if (body === '') {
        msgs.push('お問い合わせ内容は必須入力です');
      }

      if (msgs.length > 0) {
        e.preventDefault();
        alert(msgs.join('\n'));
      }
    });
  }

});
