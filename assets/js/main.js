const windowEl = window;
const documentEl = document;
const htmlEl = document.documentElement;
const bodyEl = document.body;

const disableScroll = () => {
  const fixBlocks = document?.querySelectorAll('.fixed-block');
  const pagePosition = window.scrollY;
  const paddingOffset = `${(window.innerWidth - bodyEl.offsetWidth)}px`;

  htmlEl.style.scrollBehavior = 'none';
  fixBlocks.forEach(el => { el.style.paddingRight = paddingOffset; });
  bodyEl.style.paddingRight = paddingOffset;
  bodyEl.classList.add('dis-scroll');
  bodyEl.dataset.position = pagePosition;
  bodyEl.style.top = `-${pagePosition}px`;
}
const enableScroll = () => {
  const fixBlocks = document?.querySelectorAll('.fixed-block');
  const body = document.body;
  const pagePosition = parseInt(bodyEl.dataset.position, 10);
  fixBlocks.forEach(el => { el.style.paddingRight = '0px'; });
  bodyEl.style.paddingRight = '0px';

  bodyEl.style.top = 'auto';
  bodyEl.classList.remove('dis-scroll');
  window.scroll({
    top: pagePosition,
    left: 0
  });
  bodyEl.removeAttribute('data-position');
  htmlEl.style.scrollBehavior = 'smooth';
}

// Swiper
var swiper = new Swiper(".catalog-swiper", {
  breakpoints: {
    0: {
      slidesPerView: 1,
      grid: {
        rows: 1,
        fill: 'row'
      }
    },
    769: {
      slidesPerView: 2,
      grid: {
        rows: 1,
        fill: 'row'
      }
    },
    1025: {
      slidesPerView: 2,
      grid: {
        rows: 2,
        fill: 'row'
      }
    }
  },
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  on: {
    init: function () {
      updateSlidesOpacity(this);
    },
    slideChange: function () {
      updateSlidesOpacity(this);
    },
  },
});
var swiper2 = new Swiper(".coffee-combo-swiper", {
  breakpoints: {
    0: {
      slidesPerView: 1
    },
    769: {
      slidesPerView: 2
    },
    1025: {
      slidesPerView: 3
    }
  },
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  on: {
    init: function () {
      updateSlidesOpacityCoffeeComboSwiper(this);
    },
    slideChange: function () {
      updateSlidesOpacityCoffeeComboSwiper(this);
    },
  },
});
function updateSlidesOpacity(swiperInstance) {
  var slides = swiperInstance.slides;
  var centerSlideIndex = swiperInstance.activeIndex;
  var visibleSlideIndexes = [];
  var slidesLength = slides.length;

  for (var i = centerSlideIndex - 0; i <= centerSlideIndex + 1; i++) {
    visibleSlideIndexes.push(i);
    visibleSlideIndexes.push(slidesLength / 2 + i);
  }

  slides.forEach(function (slide, index) {
    if (visibleSlideIndexes.includes(index)) {
      slide.classList.remove("translucent");
    } else {
      slide.classList.add("translucent");
    }
  });
}
function updateSlidesOpacityCoffeeComboSwiper(swiperInstance) {
  var slides = swiperInstance.slides;
  var centerSlideIndex = swiperInstance.activeIndex;
  var visibleSlideIndexes = [];

  for (var i = centerSlideIndex - 0; i <= centerSlideIndex + 2; i++) {
    visibleSlideIndexes.push(i);
  }

  slides.forEach(function (slide, index) {
    if (visibleSlideIndexes.includes(index)) {
      slide.classList.remove("translucent");
    } else {
      slide.classList.add("translucent");
    }
  });
}

// Tabs
class ItcTabs {
  constructor(target, config) {
    const defaultConfig = {};
    this._config = Object.assign(defaultConfig, config);
    this._elTabs = typeof target === 'string' ? document.querySelector(target) : target;
    this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
    this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');
    this._eventShow = new Event('tab.itc.change');
    this._init();
    this._events();
  }
  _init() {
    this._elButtons.forEach((el, index) => {
      el.dataset.index = index;
    });
  }
  show(elLinkTarget) {
    const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
    const elLinkActive = this._elTabs.querySelector('.tabs__btn_active');
    const elPaneShow = this._elTabs.querySelector('.tabs__pane_show');
    if (elLinkTarget === elLinkActive) {
      return;
    }
    elLinkActive ? elLinkActive.classList.remove('tabs__btn_active') : null;
    elPaneShow ? elPaneShow.classList.remove('tabs__pane_show') : null;
    elLinkTarget.classList.add('tabs__btn_active');
    elPaneTarget.classList.add('tabs__pane_show');
    this._elTabs.dispatchEvent(this._eventShow);
    // elLinkTarget.focus();
  }
  showByIndex(index) {
    const elLinkTarget = this._elButtons[index];
    elLinkTarget ? this.show(elLinkTarget) : null;
  };
  _events() {
    this._elTabs.addEventListener('click', (e) => {
      const target = e.target.closest('.tabs__btn');
      if (target) {
        e.preventDefault();
        this.show(target);
      }
    });
  }
}
if (document.querySelector('.gift-set__tabs')) {
  var tabs = new ItcTabs('.gift-set__tabs');
  tabs.showByIndex(0);
}

// Burger
(function () {
  const burger = document?.querySelector('[data-burger]');
  const menu = document?.querySelector('[data-menu]');
  const menuItems = document?.querySelectorAll('[data-menu-item]');
  const overlay = document?.querySelector('[data-menu-overlay]');

  burger?.addEventListener('click', (e) => {
    burger?.classList.toggle('burger--active');
    menu?.classList.toggle('menu--active');

    if (menu?.classList.contains('menu--active')) {
      burger?.setAttribute('aria-expanded', 'true');
      burger?.setAttribute('aria-label', 'Закрыть меню');
      disableScroll();
    } else {
      burger?.setAttribute('aria-expanded', 'false');
      burger?.setAttribute('aria-label', 'Открыть меню');
      enableScroll();
    }
  });

  overlay?.addEventListener('click', () => {
    burger?.setAttribute('aria-expanded', 'false');
    burger?.setAttribute('aria-label', 'Открыть меню');
    burger.classList.remove('burger--active');
    menu.classList.remove('menu--active');
    enableScroll();
  });

  menuItems?.forEach(el => {
    el.addEventListener('click', () => {
      burger?.setAttribute('aria-expanded', 'false');
      burger?.setAttribute('aria-label', 'Открыть меню');
      burger.classList.remove('burger--active');
      menu.classList.remove('menu--active');
      enableScroll();
    });
  });
})();