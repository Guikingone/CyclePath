import { MDCTopAppBar } from '@material/top-app-bar/index';
import { MDCDrawer } from "@material/drawer";

new MDCTopAppBar(document.querySelector('.mdc-top-app-bar'));
let navigationBtn = document.querySelector('#aside_menu');
let drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));

navigationBtn.addEventListener('click', function (event) {
   event.preventDefault();
   drawer.open = true;
});
