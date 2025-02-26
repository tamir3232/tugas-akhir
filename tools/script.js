/* admin.php */
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});


/* home.php */
document.addEventListener('DOMContentLoaded', function() {
  const dropdowns = document.querySelectorAll('.dropdown');

  dropdowns.forEach(dropdown => {
      const select = dropdown.querySelector('.select');
      const caret = dropdown.querySelector('.caret');
      const menu = dropdown.querySelector('.menu');
      const options = dropdown.querySelectorAll('.menu li');
      const selected = dropdown.querySelector('.selected');

      select.addEventListener('click', () => {
          select.classList.toggle('select-clicked');
          caret.classList.toggle('caret-rotate');
          menu.classList.toggle('menu-open'); // Tambahkan atau hapus kelas .menu-open
      });

      options.forEach(option => {
          option.addEventListener('click', () => {
              selected.innerText = option.innerText;
              select.classList.remove('select-clicked');
              caret.classList.remove('caret-rotate');
              menu.classList.remove('menu-open');
              options.forEach(option => {
                  option.classList.remove('active');
              });
              option.classList.add('active');
          });
      });
  });

  // Event listener untuk menutup dropdown saat mengklik di luar dropdown
  document.addEventListener('click', function(event) {
      dropdowns.forEach(dropdown => {
          if (!dropdown.contains(event.target)) {
              const select = dropdown.querySelector('.select');
              const caret = dropdown.querySelector('.caret');
              const menu = dropdown.querySelector('.menu');

              select.classList.remove('select-clicked');
              caret.classList.remove('caret-rotate');
              menu.classList.remove('menu-open');
          }
      });
  });
});