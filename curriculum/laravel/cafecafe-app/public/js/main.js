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
      const href = backBtn.getAttribute('href');
      if (href) {
        e.preventDefault();
        window.location.href = href;
      }
    });
  }

});
