class AppHomepageContent extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = "<div>New content for homepage !</div>";
    }
}

window.customElements.define('app-homepage-content', AppHomepageContent);
