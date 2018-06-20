import $ from "jquery";

class HeroSlider {
  constructor() {
    this.els = $(".hero-slider");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      autoplay: false,
      arrows: false,
      dots: true
    });
  }
}

export default HeroSlider;
