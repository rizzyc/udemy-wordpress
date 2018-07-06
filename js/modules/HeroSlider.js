import $ from "jquery";

class HeroSlider {
  constructor() {
    this.els = $(".hero-slider");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      autoplay: true,
      arrows: false,
      fade: true,
      dots: true
    });
  }
}

export default HeroSlider;
