class AppHomepageHero extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = "<div>App hero !</div>";
    }
}

window.customElements.define('app-homepage-hero', AppHomepageHero);
