(function () {
	'use strict';

	function initPasswordToggle() {
		var passField = document.getElementById('user_pass');
		if (!passField || passField.dataset.annavToggle) {
			return;
		}

		passField.dataset.annavToggle = '1';

		var wrap = passField.closest('.user-pass-wrap') || passField.parentElement;
		if (!wrap) {
			return;
		}

		var toggle = document.createElement('button');
		toggle.type = 'button';
		toggle.className = 'annav_password-toggle';
		toggle.setAttribute('aria-label', 'Zobrazit heslo');
		toggle.textContent = 'Zobrazit heslo';

		toggle.addEventListener('click', function () {
			var isHidden = passField.type === 'password';
			passField.type = isHidden ? 'text' : 'password';
			toggle.setAttribute(
				'aria-label',
				isHidden ? 'Skrýt heslo' : 'Zobrazit heslo'
			);
		});

		wrap.appendChild(toggle);
	}

	document.addEventListener('DOMContentLoaded', function () {
		initPasswordToggle();
	});
})();
