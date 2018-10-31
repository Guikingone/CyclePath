class AppNotification extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = "<div><p>Hello from notification element !</p></div>";
    }
}

 window.customElements.define('app-notification', AppNotification);
