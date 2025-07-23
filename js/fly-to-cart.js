document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll('.add-to-cart');
  const cartIcon = document.querySelector('#cart-icon');

  buttons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const imgSrc = this.getAttribute('data-img');
      const img = document.createElement('img');
      img.src = imgSrc;
      img.classList.add('flying-img');

      const rect = this.getBoundingClientRect();
      img.style.top = rect.top + "px";
      img.style.left = rect.left + "px";
      img.style.position = "fixed";
      img.style.zIndex = "9999";
      img.style.width = "100px";
      img.style.height = "100px";
      img.style.transition = "all 1s ease-in-out";

      document.body.appendChild(img);

      const cartRect = cartIcon.getBoundingClientRect();

      setTimeout(() => {
        img.style.top = cartRect.top + "px";
        img.style.left = cartRect.left + "px";
        img.style.width = "30px";
        img.style.height = "30px";
        img.style.opacity = "0";
        img.style.transform = "scale(0.3)";
      }, 10);

      setTimeout(() => {
        img.remove();
      }, 1000);
    });
  });
});