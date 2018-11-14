class AppNotification extends HTMLElement {
    constructor() {
        super();
    }

    getUser() {
        return this.getAttribute('user');
    }

    connectedCallback() {

        let user = this.getAttribute('user');

        this.innerHTML = "";
    }
}

 window.customElements.define('app-notification', AppNotification);
