document.addEventListener('DOMContentLoaded', () => {
  // Functions to open and close a modal
  function openModal($el, id) {
    $el.classList.add('is-active');
    $el.dataset.id = id;
  }

  function closeModal($el) {
    $el.classList.remove('is-active');
  }

  function closeAllModals() {
    (document.querySelectorAll('.modal') || []).forEach(($modal) => {
      closeModal($modal);
    });
  }

  // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);
    const id = $trigger.dataset.id;

    $trigger.addEventListener('click', () => {
      openModal($target, id);
    });
  });

  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
    const $target = $close.closest('.modal');

    $close.addEventListener('click', () => {
      closeModal($target);
    });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    const e = event || window.event;

    if (e.keyCode === 27) { // Escape key
      closeAllModals();
    }
  });
});


document.addEventListener('DOMContentLoaded', function () {
  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        const target = $el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

        $target.style.paddingLeft = "2%";
        $target.style.paddingTop = "60px";
        $target.style.backgroundColor = "#f7f7f7";
      });
    });
  }
});

function hideElement() {
  const menuItemsAction = document.querySelectorAll('.manage-content-menu .admin-content');
  menuItemsAction.forEach(item => {
    item.classList.add('is-hidden');
  });
}

// Get all the menu items
const menuItems = document.querySelectorAll('.menu-list a');

// Add a click event listener to each menu item
menuItems.forEach(item => {
  item.addEventListener('click', () => {
    // Remove the active class from all menu items
    menuItems.forEach(item => {
      item.classList.remove('is-active');
    });
    // Add the active class to the clicked menu item
    item.classList.add('is-active');

    // Get the ID of the clicked menu item
    const itemId = item.getAttribute('id');

    switch (itemId) {
      case "product-manage": 
        this.hideElement();
        const targetLoad = document.getElementById('loading-product-element');
        targetLoad.classList.remove('is-hidden');
        targetLoad.classList.add('is-visible');
        break;
      case "recommend-product": 
        this.hideElement();
        const targetRecommend = document.getElementById('recommend-product-element');
        targetRecommend.classList.remove('is-hidden');
        targetRecommend.classList.add('is-visible');
        break;
      case "all-product":
        this.hideElement();
        const targetAll = document.getElementById('all-product-element');
        targetAll.classList.remove('is-hidden');
        targetAll.classList.add('is-visible');
        break;
      case "setting-group-product": 
        this.hideElement();
        const targetGr = document.getElementById('setting-group-element');
        targetGr.classList.remove('is-hidden');
        targetGr.classList.add('is-visible');
        break;
      case "manage-history": 
      this.hideElement();
      const targetRestore = document.getElementById('setting-deleted-element');
      targetRestore.classList.remove('is-hidden');
      targetRestore.classList.add('is-visible');
        break;
      case "about-us-message": 
        this.hideElement();
        break
      case "user-setting": 
        this.hideElement();
        const targetUser = document.getElementById('setting-user-element');
        targetUser.classList.remove('is-hidden');
        targetUser.classList.add('is-visible');
        break
    }
  });

});